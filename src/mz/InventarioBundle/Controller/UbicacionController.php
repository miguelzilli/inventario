<?php

namespace mz\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use mz\InventarioBundle\Entity\Ubicacion;
use mz\InventarioBundle\Form\UbicacionType;
use mz\InventarioBundle\Form\UbicacionFilterType;

/**
 * Ubicacion controller.
 *
 */
class UbicacionController extends Controller
{
    /**
     * Lists all Ubicacion entities.
     *
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return $this->render('mzInventarioBundle:Ubicacion:index.html.twig', array(
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
        $filterForm = $this->createForm(new UbicacionFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('mzInventarioBundle:Ubicacion')->createQueryBuilder('e');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('UbicacionControllerFilter');
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
                $session->set('UbicacionControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('UbicacionControllerFilter')) {
                $filterData = $session->get('UbicacionControllerFilter');
                $filterForm = $this->createForm(new UbicacionFilterType(), $filterData);
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
            return $me->generateUrl('ubicacion', array('page' => $page));
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
     * Finds and displays a Ubicacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Ubicacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:Ubicacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to create a new Ubicacion entity.
     *
     */
    public function newAction()
    {
        $entity = new Ubicacion();
        $form   = $this->createForm(new UbicacionType(), $entity);

        return $this->render('mzInventarioBundle:Ubicacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new Ubicacion entity.
     *
     */
    public function createAction()
    {
        $entity  = new Ubicacion();
        $request = $this->getRequest();
        $form    = $this->createForm(new UbicacionType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('ubicacion_show', array('id' => $entity->getId())));        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Ubicacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
    /**
     * Displays a form to edit an existing Ubicacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Ubicacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm = $this->createForm(new UbicacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventarioBundle:Ubicacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Ubicacion entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Ubicacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        $editForm   = $this->createForm(new UbicacionType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('ubicacion_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Ubicacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Ubicacion entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('mzInventarioBundle:Ubicacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('No se encuentra el registro.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->redirect($this->generateUrl('ubicacion'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
