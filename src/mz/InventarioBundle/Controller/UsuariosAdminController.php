<?php

namespace mz\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use mz\InventarioBundle\Entity\Usuario;
use mz\InventarioBundle\Form\UsuarioType;
use mz\InventarioBundle\Form\UsuarioChangePassType;
use mz\InventarioBundle\Form\SimpleSearchType;

/**
 * UsuariosAdmin controller.
 *
 */
class UsuariosAdminController extends Controller {

    public function loginAction()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }
        return $this->render('mzInventarioBundle:UsuariosAdmin:login.html.twig', array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error,
        ));
    }

    /**
     * Lists all Usuario entities.
     *
     */
    public function indexAction() {
        list($filterForm, $queryBuilder) = $this->filter();
        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

        return $this->render('mzInventarioBundle:UsuariosAdmin:index.html.twig', array(
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
        $filterForm = $this->createForm(new SimpleSearchType());
        $em = $this->getDoctrine()->getManager();

        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'search') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('UsuarioControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('UsuarioControllerFilter')) {
                $filterData = $session->get('UsuarioControllerFilter');
                $filterForm = $this->createForm(new SimpleSearchType(), $filterData);
            } else {
                $filterData = array('q' => '');
            }
        }

        $queryBuilder = $em->getRepository('mzInventarioBundle:Usuario')
                ->getSearchQuery($filterData['q']);

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
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:UsuariosAdmin:show.html.twig', array(
                    'entity' => $entity,
                    'delete_form' => $deleteForm->createView(),));
    }

    /**
     * Displays a form to create a new Usuario entity.
     *
     */
    public function newAction() {
        $entity = new Usuario();
        $form = $this->createForm(new UsuarioType(), $entity);
                
        return $this->render('mzInventarioBundle:UsuariosAdmin:new.html.twig', array(
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

            $entity->setSecurePassword();

            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');
            return $this->redirect($this->generateUrl('usuario_show', array('id' => $entity->getId())));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:UsuariosAdmin:new.html.twig', array(
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
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        //$editForm = $this->createForm(new UsuarioType(), $entity);
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:UsuariosAdmin:edit.html.twig', array(
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
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('usuario_show', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:UsuariosAdmin:edit.html.twig', array(
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
                throw $this->createNotFoundException('No se encuentra el registro.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->redirect($this->generateUrl('usuario'));
    }

    public function passEditAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm = $this->createChangePassForm($entity);

        return $this->render('mzInventarioBundle:UsuariosAdmin:passEdit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    public function passUpdateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm = $this->createChangePassForm($entity);

        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {

            $entity->setSecurePassword();

            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('usuario_show', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:UsuariosAdmin:passEdit.html.twig', array(
                    'entity' => $entity,
                    'edit_form' => $editForm->createView(),
        ));
    }

    private function createDeleteForm($id) {
        return $this->createFormBuilder(array('id' => $id))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

    private function createEditForm($entity) {
        $form = $this->createForm(new UsuarioType(), $entity);
        $form->remove('password');
        return $form;
    }

    private function createChangePassForm($entity) {
        $form = $this->createForm(new UsuarioChangePassType(), $entity);
        $form->remove('currentPass');
        return $form;
    }

    public function getDeleteFormAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle::simpleDeleteForm.html.twig', array(
            'route' => 'usuario_delete',
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            ));
    }
}
