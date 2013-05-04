<?php

namespace mz\InventarioBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use mz\InventarioBundle\Entity\Usuario;
use mz\InventarioBundle\Utils\Utils as Utils;

class LoadUsuarioData extends AbstractFixture implements OrderedFixtureInterface {

    public function load(ObjectManager $em) {
        $admin = new Usuario();
        $admin->setApellido('Zilli');
        $admin->setNombre('Miguel');
        $admin->setEmail('miguelzilli@mail.com');
        $admin->setUsername('admin');
        $admin->setSalt(md5(time()));
        $password=Utils::encodePassword('adminpass', $admin->getSalt());
        $admin->setPassword($password);
        $admin->setRol('ROLE_ADMIN');
        $admin->setIsEnabled(true);

        $user = new Usuario();
        $user->setApellido('Perez');
        $user->setNombre('Juan');
        $user->setEmail('juanperez@mail.com');
        $user->setUsername('user');
        $user->setSalt(md5(time()));
        $password=Utils::encodePassword('userpass', $user->getSalt());
        $user->setPassword($password);
        $user->setRol('ROLE_USER');
        $user->setIsEnabled(true);

        $em->persist($admin);
        $em->persist($user);
        $em->flush();
    }

    public function getOrder() {
        return 8; // the order in which fixtures will be loaded
    }

}