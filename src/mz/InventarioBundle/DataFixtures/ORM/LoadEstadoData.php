<?php

namespace mz\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventarioBundle\Entity\Estado;

class LoadEstadoData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {

        $estado1 = new Estado();
        $estado1->setNombre('Archivado');
        
        $estado2 = new Estado();
        $estado2->setNombre('En Uso');

        $estado3 = new Estado();
        $estado3->setNombre('En Reparacion');
        
        $em->persist($estado1);
        $em->persist($estado2);
        $em->persist($estado3);

        $em->flush();

        $this->addReference('estado1', $estado1);
        $this->addReference('estado2', $estado2);
        $this->addReference('estado3', $estado3);
    }

    public function getOrder() {
        return 3; // the order in which fixtures will be loaded
    }

}