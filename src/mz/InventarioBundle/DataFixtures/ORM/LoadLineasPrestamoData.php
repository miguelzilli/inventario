<?php

namespace mz\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventarioBundle\Entity\LineasPrestamo;

class LoadLineasPrestamoData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        for ($i = 1; $i <= 5; $i++) {
            for ($j=1; $j <=5; $j++) { 
                $x=$i*$j;
                $lineaPrestamo = new LineasPrestamo();
                $lineaPrestamo->setPrestamo($em->merge($this->getReference('prestamo'.$i)));
                $lineaPrestamo->setItem($em->merge($this->getReference('item'.$x)));
                if (($i % 2) == 1) { $lineaPrestamo->setFechaDevolucion(new \Datetime()); }
                $lineaPrestamo->setObservaciones('Observaciones de Linea de Prestamo #'.$j);
                $em->persist($lineaPrestamo);
            }
        }
        $em->flush();
    }

    public function getOrder() {
        return 10; // the order in which fixtures will be loaded
    }

}