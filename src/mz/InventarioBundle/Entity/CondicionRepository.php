<?php

namespace mz\InventarioBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CondicionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CondicionRepository extends EntityRepository
{
    public function getSearchQuery($qParameter = ''){
        $qb=$this->createQueryBuilder('e');
        $qb->select('e')
                ->where('e.nombre LIKE :q')
                ->setParameter('q', '%'.$qParameter.'%');
            ;
        return $qb;
    }
}
