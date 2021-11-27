<?php

namespace App\Repository;

use App\Entity\InistuitionPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InistuitionPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method InistuitionPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method InistuitionPlan[]    findAll()
 * @method InistuitionPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InistuitionPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InistuitionPlan::class);
    }

    // /**
    //  * @return InistuitionPlan[] Returns an array of InistuitionPlan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InistuitionPlan
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function getByOrganizationSuitableAndQuarter($organSuitable, $quarter, $attrib = null)
    {
        $qb =  $this->createQueryBuilder('q');


        $qb->andWhere('q.instuitionSuitable = :val')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $organSuitable)
            ->setParameter('val2', $quarter);
        if ($attrib) {
            $qb->andWhere('q.socialAttribute = :attr')
                ->setParameter('attr', $attrib);
        }
        return $qb->getQuery()
            ->getOneOrNullResult();
    }
}
