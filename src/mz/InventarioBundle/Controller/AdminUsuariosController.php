<?php

namespace mz\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;
use mz\InventarioBundle\Entity\Usuario;
use mz\InventarioBundle\Form\UsuarioType;
use mz\InventarioBundle\Form\UsuarioFilterType;
use mz\InventarioBundle\Utils\Utils as Utils;

/**
 * AdminUsuarios controller.
 *
 */
class AdminUsuariosController extends Controller {

    /**
     * Lists all Usuario entities.
     *
     */
    public function indexAction() {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);


        return $this->render('mzInventarioBundle:AdminUsuarios:index.html.twig', array(
                    'entities' => $entities,
                    'pagerHtml' => $pagerHtml,
                    'filterForm' => $filterForm->createView(),
        ));
    }

    /**
     * Create filter form and process filter request.
     *
     */
    protected function filter() {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new UsuarioFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('mzInventarioBundle:Usuario')->createQueryBuilder('e');

        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('AdminUsuariosControllerFilter');
        }

        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('AdminUsuariosControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('AdminUsuariosControllerFilter')) {
                $filterData = $session->get('AdminUsuariosControllerFilter');
                $filterForm = $this->createForm(new UsuarioFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }

        return array($filterForm, $queryBuilder);
    }

    /**
     * Get results from paginator and get paginator view.
     *
     */
    protected function paginator($queryBuilder) {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();

        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me) {
                    return $me->generateUrl('usuario', array('page' => $page));
                };

        // Paginator - view
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => 'Anterior',
            'next_message' => 'Siguiente',
        ));

        return array($entities, $pagerHtml);
    }

    /**
     * Finds and displays a Usuario entity.
     *
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:AdminUsuarios:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     */
    public function newAction() {
        $entity = new Usuario();
        $entity->setRoles('ROLE_USER');
        $form = $this->createForm(new UsuarioType(), $entity);

        return $this->render('mzInventarioBundle:AdminUsuarios:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Creates a new Usuario entity.
     *
     */
    public function createAction() {
        $entity = new Usuario();
        $request = $this->getRequest();
        $form = $this->createForm(new UsuarioType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $this->setSecurePassword($entity);

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');
            return $this->redirect($this->generateUrl('usuario_show', array('id' => $entity->getId())));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
        }

        return $this->render('mzInventarioBundle:AdminUsuarios:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Usuario entity.
     *
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createForm(new UsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:AdminUsuarios:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Usuario entity.
     *
     */
    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        $editForm = $this->createForm(new UsuarioType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $current_pass = $entity->getPassword();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            if ($current_pass != $entity->getPassword()) {
                $this->setSecurePassword($entity);
            }
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('usuario_show', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return $this->render('mzInventarioBundle:AdminUsuarios:edit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Usuario entity.
     *
     */
    public function deleteAction($id) {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Usuario entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('usuario'));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    /**
     * encodePass
     *
     * @return string 
     */
    private function setSecurePassword(&$entity) {
        $entity->setSalt(md5(time()));
        $password = Utils::encodePassword($entity->getPassword(), $entity->getSalt());
        $entity->setPassword($password);
    }
}