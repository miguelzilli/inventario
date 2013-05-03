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
 * Usuario controller.
 *
 */
class UsuarioController extends Controller
{
    public function profileAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mzInventarioBundle:Usuario')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Usuario entity.');
        }

        return $this->render('mzInventarioBundle:Usuario:show.html.twig', array(
            'entity' => $entity));
    }

    public function editAction($id)
    {
        return '';
    }

    public function updateAction($id)
    {
        return '';
    }

    public function changePassAction($id)
    {
        return '';
    }

    public function updatePassAction($id)
    {
        return '';
    }
}
