<?php

namespace MMBundle\Repository;

/**
 * DocumentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DocumentRepository extends \Doctrine\ORM\EntityRepository
{
    public function search($form) {
        $qb = $this->createQueryBuilder('e');


        if(!empty($form->get('page')->getData())) {
            $qb->orWhere('e.page = :num')
                ->setParameter('num', $form->get('page')->getData());
        }


        return $qb->getQuery()->getResult();
    }


    public function filter($form) {
        $qb = $this->createQueryBuilder('d');
        if(!empty($form->get('date')->getData())) {
            $qb->orWhere('d.date = :date')
                ->setParameter('date', $form->get('date')->getData());
        }
        return $qb->getQuery();
    }
}