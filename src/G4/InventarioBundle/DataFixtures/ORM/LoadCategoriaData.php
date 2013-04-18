<?php
namespace G4\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use G4\InventarioBundle\Entity\Categoria;

class LoadCategoriaData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $em)
    {
        $monitores = new Categoria();
        $monitores->setNombre('Monitores');

        $teclados = new Categoria();
        $teclados->setNombre('Teclados');

        $notebooks = new Categoria();
        $notebooks->setNombre('Notebooks');

        $em->persist($monitores);
        $em->persist($teclados);
        $em->persist($notebooks);

        $em->flush();

        $this->addReference('monitor', $monitores);
        $this->addReference('teclado', $teclados);
        $this->addReference('notebook', $notebooks);
    }

    public function getOrder()
    {
        return 1; // the order in which fixtures will be loaded
    }
}