<?php

namespace mz\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use mz\InventarioBundle\Entity\Estado;
use mz\InventarioBundle\Form\EstadoType;
use mz\InventarioBundle\Form\SimpleSearchType;

/**
 * Estado controller.
 *
 */
class EstadoController extends Controller
{
    /**
     * Lists all Estado entities.
     *
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return $this->render('mzInventarioBundle:Estado:index.html.twig', array(
            'entities' => $entities,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        ));
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter()
    {
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
                $session->set('EstadoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('EstadoControllerFilter')) {
                $filterData = $session->get('EstadoControllerFilter');
                $filterForm = $this->createForm(new SimpleSearchType(), $filterData);
            } else {
                $filterData = array('q' => '');
            }
        }

        $queryBuilder = $em->getRepository('mzInventarioBundle:Estado')
                ->getSearchQuery($filterData['q']);

        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('estado', array('page' => $page));
        };
    
        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => 'Anterior',
            'next_message' => 'Siguiente',
        ));
    
        return array($entities, $pagerHtml);
    }
    
    /**
     * Finds and displays a Estado entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:Estado:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Estado entity.
     *
     */
    public function newAction()
    {
        $entity = new Estado();
        $form   = $this->createForm(new EstadoType(), $entity);

        return $this->render('mzInventarioBundle:Estado:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Estado entity.
     *
     */
    public function createAction()
    {
        $entity  = new Estado();
        $request = $this->getRequest();
        $form    = $this->createForm(new EstadoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('estado_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Estado:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Estado entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm = $this->createForm(new EstadoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:Estado:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Estado entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm   = $this->createForm(new EstadoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('estado_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Estado:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Estado entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('mzInventarioBundle:Estado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se encuentra el registro.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->redirect($this->generateUrl('estado'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }

    public function getDeleteFormAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Estado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle::simpleDeleteForm.html.twig', array(
            'route' => 'estado_delete',
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
            ));
    }
}
