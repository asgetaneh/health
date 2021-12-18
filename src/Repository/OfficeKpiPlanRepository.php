<?php

namespace App\Repository;

use App\Entity\OfficeKpiPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OfficeKpiPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method OfficeKpiPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method OfficeKpiPlan[]    findAll()
 * @method OfficeKpiPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OfficeKpiPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OfficeKpiPlan::class);
    }

    // /**
    //  * @return OfficeKpiPlan[] Returns an array of OfficeKpiPlan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OfficeKpiPlan
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    // public function findO($value)
    // {
    //     return $this->createQueryBuilder('o')
    //         ->andWhere('o.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult();
    // }

}
