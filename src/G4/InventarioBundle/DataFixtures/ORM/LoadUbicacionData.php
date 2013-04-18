<?php

namespace G4\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use G4\InventarioBundle\Entity\Ubicacion;

class LoadUbicacionData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        $ubicacion1=new Ubicacion();
        $ubicacion1->setNombre('Oficina 1');
        
        $ubicacion2=new Ubicacion();
        $ubicacion2->setNombre('Oficina 2');
        
        $ubicacion3=new Ubicacion();
        $ubicacion3->setNombre('Oficina 3');
        
        $em->persist($ubicacion1);
        $em->persist($ubicacion2);
        $em->persist($ubicacion3);
        
        $em->flush();
        
        $this->addReference('ubicacion1', $ubicacion1);
        $this->addReference('ubicacion2', $ubicacion2);
        $this->addReference('ubicacion3', $ubicacion3);
    }

    public function getOrder() {
        return 4; // the order in which fixtures will be loaded
    }

}