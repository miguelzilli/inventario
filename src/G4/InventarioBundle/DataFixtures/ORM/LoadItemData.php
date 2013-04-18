<?php

namespace G4\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use G4\InventarioBundle\Entity\Item;

class LoadItemData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        $min = strtotime('2012-01-01');
        $max = strtotime('2012-12-31');

        for ($i = 1; $i <= 10; $i++) {
            $x = $i % 3 + 1;
            $fecha=date('Y-m-d',rand($min, $max));

            $item = new Item();
            $item->setCategoria($em->merge($this->getReference('monitor')));
            $item->setCodigoInventario('MNT001-0000' . $i);
            $item->setCondicion($em->merge($this->getReference('condicion' . $x)));
            $item->setCosto(rand(800, 3000));
            $item->setDescripcion('Descripcion del item #' . $i);
            $item->setEstado($em->merge($this->getReference('estado' . $x)));
            $item->setFechaCompra(new \DateTime($fecha));
            $item->setGarantia($i);
            $item->setMarca('Genérico');
            $item->setModelo('Genérico');
            $item->setNombre('Monitor' . $i);
            $item->setSn('abc' . $i);
            $item->setUbicacion($em->merge($this->getReference('ubicacion' . $x)));
            
            $em->persist($item);
            $em->flush();
            $this->addReference('item'.$i, $item);
        }

        for ($i = 11; $i <= 20; $i++) {
            $x = $i % 3 + 1;
            $fecha=date('Y-m-d',rand($min, $max));

            $item = new Item();
            $item->setCategoria($em->merge($this->getReference('teclado')));
            $item->setCodigoInventario('KBR001-0000' . $i);
            $item->setCondicion($em->merge($this->getReference('condicion' . $x)));
            $item->setCosto(rand(20, 300));
            $item->setDescripcion('Descripcion del item #' . $i);
            $item->setEstado($em->merge($this->getReference('estado' . $x)));
            $item->setFechaCompra(new \DateTime($fecha));
            $item->setGarantia($i);
            $item->setMarca('Genérico');
            $item->setModelo('Genérico');
            $item->setNombre('Teclado' . $i);
            $item->setSn('def' . $i);
            $item->setUbicacion($em->merge($this->getReference('ubicacion' . $x)));

            $em->persist($item);
            $em->flush();
            $this->addReference('item'.$i, $item);
        }

        for ($i = 21; $i <= 30; $i++) {
            $x = $i % 3 + 1;
            $fecha=date('Y-m-d',rand($min, $max));
            
            $item = new Item();
            $item->setCategoria($em->merge($this->getReference('notebook')));
            $item->setCodigoInventario('NBK001-0000' . $i);
            $item->setCondicion($em->merge($this->getReference('condicion' . $x)));
            $item->setCosto(rand(3000, 15000));
            $item->setDescripcion('Descripcion del item #' . $i);
            $item->setEstado($em->merge($this->getReference('estado' . $x)));
            $item->setFechaCompra(new \DateTime($fecha));
            $item->setGarantia($i);
            $item->setMarca('Genérico');
            $item->setModelo('Genérico');
            $item->setNombre('Notebook' . $i);
            $item->setSn('ghi' . $i);
            $item->setUbicacion($em->merge($this->getReference('ubicacion' . $x)));
            
            $em->persist($item);
            $em->flush();
            $this->addReference('item'.$i, $item);
        }
    }

    public function getOrder() {
        return 5; // the order in which fixtures will be loaded
    }

}