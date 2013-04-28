<?php

namespace mz\InventarioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('mzInventarioBundle:Default:index.html.twig', array('name' => 'InventarioBundle'));
    }
}
