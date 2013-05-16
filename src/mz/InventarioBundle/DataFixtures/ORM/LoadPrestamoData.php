<?php

namespace mz\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventarioBundle\Entity\Prestamo;

class LoadPrestamoData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        $min = strtotime('2013-01-01');
        $max = strtotime(date('Y-m-d'));
        $apellidos[]='Perez';
        $apellidos[]='Garcia';
        $apellidos[]='Rojas';
        $nombres[]='Juan';
        $nombres[]='Luis';
        $nombres[]='Roberto';

        for ($i = 1; $i <= 5; $i++) {
            $fecha=date('Y-m-d',rand($min, $max));
            $prestamo = new Prestamo();
            $prestamo->setApellido($apellidos[rand(0,2)]);
            $prestamo->setDni(rand(1234567, 55555555));
            $prestamo->setFecha(new \DateTime($fecha));
            $prestamo->setNombre($nombres[rand(0,2)]);
            $prestamo->setObservaciones('Observaciones del prestamo #'.$i);
            //$prestamo->setItem($em->merge($this->getReference('item'.$i)));

            $em->persist($prestamo);
        }
        $em->flush();
    }

    public function getOrder() {
        return 9; // the order in which fixtures will be loaded
    }

}