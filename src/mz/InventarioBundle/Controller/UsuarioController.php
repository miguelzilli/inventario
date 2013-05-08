<?php

namespace mz\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
//use Pagerfanta\Pagerfanta;
//use Pagerfanta\Adapter\DoctrineORMAdapter;
//use Pagerfanta\View\TwitterBootstrapView;
//use mz\InventarioBundle\Entity\Usuario;
use mz\InventarioBundle\Form\UsuarioType;
use mz\InventarioBundle\Form\UsuarioChangePassType;
use \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

//use mz\InventarioBundle\Form\UsuarioFilterType;
//use mz\InventarioBundle\Utils\Utils as Utils;

/**
 * Usuario controller.
 *
 */
class UsuarioController extends Controller {

    public function profileAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }
        
        if ($id != $this->getUser()->getId()) {
            throw new AccessDeniedHttpException('No tiene permisos para ver este perfil');
        }

        return $this->render('mzInventarioBundle:Usuario:show.html.twig', array(
            'entity' => $entity));
    }

    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        if ($id != $this->getUser()->getId()) {
            throw new AccessDeniedHttpException('No tiene permisos para ver este perfil');
        }

        $editForm = $this->createEditForm($entity);

        return $this->render('mzInventarioBundle:Usuario:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            ));
    }

    public function updateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        if ($id != $this->getUser()->getId()) {
            throw new AccessDeniedHttpException('No tiene permisos para ver este perfil');
        }

        $editForm = $this->createEditForm($entity);

        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('profile', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Usuario:edit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            ));
    }

    public function passEditAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        if ($id != $this->getUser()->getId()) {
            throw new AccessDeniedHttpException('No tiene permisos para ver este perfil');
        }

        $editForm = $this->createForm(new UsuarioChangePassType(), $entity);

        return $this->render('mzInventarioBundle:Usuario:passEdit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            ));
    }

    public function passUpdateAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('No se encuentra el registro.');
        }

        if ($id != $this->getUser()->getId()) {
            throw new AccessDeniedHttpException('No tiene permisos para ver este perfil');
        }

        $editForm = $this->createForm(new UsuarioChangePassType(), $entity);

        $request = $this->getRequest();
        $editForm->bind($request);

        if ($editForm->isValid()) {

            $entity->setSecurePassword();

            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Operación realizada con éxito.');

            return $this->redirect($this->generateUrl('profile', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'No se pudo realizar la operación.');
        }

        return $this->render('mzInventarioBundle:Usuario:passEdit.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            ));
    }

    private function createEditForm($entity) {
        $form = $this->createForm(new UsuarioType(), $entity);
        $form
        ->remove('password')
        ->remove('rol')
        ->remove('isEnabled')
        ;
        return $form;
    }

}
