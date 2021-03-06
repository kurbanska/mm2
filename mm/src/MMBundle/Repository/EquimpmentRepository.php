<?php

namespace MMBundle\Repository;

/**
 * EquimpmentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EquimpmentRepository extends \Doctrine\ORM\EntityRepository
{
    public function search($form) {
        $qb = $this->createQueryBuilder('e');



        if(!empty($form->get('serialnumber')->getData())) {
            $qb->orWhere('e.serialnumber = :ctr')
                ->setParameter('ctr', $form->get('serialnumber')->getData());
        }

        if(!empty($form->get('number')->getData())) {
            $qb->orWhere('e.number = :num')
                ->setParameter('num', $form->get('number')->getData());
        }

        return $qb->getQuery()->getResult();
    }

}
