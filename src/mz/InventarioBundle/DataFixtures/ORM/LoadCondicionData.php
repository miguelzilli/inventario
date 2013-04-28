<?php
namespace mz\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventarioBundle\Entity\Condicion;

class LoadCondicionData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $condicion1 = new Condicion();
        $condicion1->setNombre('Buena');

        $condicion2 = new Condicion();
        $condicion2->setNombre('Regular');
        
        $condicion3 = new Condicion();
        $condicion3->setNombre('Mala');
        
        $em->persist($condicion1);
        $em->persist($condicion2);
        $em->persist($condicion3);
        
        $em->flush();
        
        $this->addReference('condicion1', $condicion1);
        $this->addReference('condicion2', $condicion2);
        $this->addReference('condicion3', $condicion3);
    }

    public function getOrder()
    {
        return 2; // the order in which fixtures will be loaded
    }
}