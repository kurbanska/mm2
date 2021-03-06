<?php

namespace MMBundle\Repository;

/**
 * LicenseRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LicenseRepository extends \Doctrine\ORM\EntityRepository
{
    public function search($form) {
        $qb = $this->createQueryBuilder('e');



        if(!empty($form->get('serialkey')->getData())) {
            $qb->orWhere('e.serialkey = :ctr')
                ->setParameter('ctr', $form->get('serialkey')->getData());
        }

        if(!empty($form->get('number')->getData())) {
            $qb->orWhere('e.number = :num')
                ->setParameter('num', $form->get('number')->getData());
        }

        return $qb->getQuery()->getResult();
    }
    public function filter($form) {
        $qb = $this->createQueryBuilder('d');
        if(!empty($form->get('data')->getData())) {
            $qb->orWhere('d.data = :data')
                ->setParameter('data', $form->get('data')->getData());
        }
        return $qb->getQuery();
    }
}
