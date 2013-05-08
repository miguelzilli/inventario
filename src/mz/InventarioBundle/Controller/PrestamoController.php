<?php

namespace mz\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use mz\InventarioBundle\Entity\Prestamo;
use mz\InventarioBundle\Form\PrestamoType;
use mz\InventarioBundle\Form\PrestamoFilterType;

/**
 * Prestamo controller.
 *
 */
class PrestamoController extends Controller
{
    /**
     * Lists all Prestamo entities.
     *
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return $this->render('mzInventarioBundle:Prestamo:index.html.twig', array(
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
        $filterForm = $this->createForm(new PrestamoFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('mzInventarioBundle:Prestamo')->createQueryBuilder('e');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('PrestamoControllerFilter');
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
                $session->set('PrestamoControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('PrestamoControllerFilter')) {
                $filterData = $session->get('PrestamoControllerFilter');
                $filterForm = $this->createForm(new PrestamoFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
    
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
            return $me->generateUrl('prestamo', array('page' => $page));
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
     * Finds and displays a Prestamo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Prestamo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:Prestamo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Prestamo entity.
     *
     */
    public function newAction()
    {
        $entity = new Prestamo();
        $form   = $this->createForm(new PrestamoType(), $entity);

        return $this->render('mzInventarioBundle:Prestamo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Prestamo entity.
     *
     */
    public function createAction()
    {
        $entity  = new Prestamo();
        $request = $this->getRequest();
        $form    = $this->createForm(new PrestamoType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('prestamo_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Prestamo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Prestamo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Prestamo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm = $this->createForm(new PrestamoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:Prestamo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Prestamo entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Prestamo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm   = $this->createForm(new PrestamoType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('prestamo_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Prestamo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Prestamo entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('mzInventarioBundle:Prestamo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se encuentra el registro.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->redirect($this->generateUrl('prestamo'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
