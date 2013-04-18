<?php

namespace G4\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use G4\InventarioBundle\Entity\Imagen;

class LoadImagenData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        
    }

    public function getOrder() {
        return 6; // the order in which fixtures will be loaded
    }

}