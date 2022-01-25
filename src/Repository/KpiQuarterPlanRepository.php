<?php

namespace App\Repository;

use App\Entity\KpiQuarterPlan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KpiQuarterPlan|null find($id, $lockMode = null, $lockVersion = null)
 * @method KpiQuarterPlan|null findOneBy(array $criteria, array $orderBy = null)
 * @method KpiQuarterPlan[]    findAll()
 * @method KpiQuarterPlan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KpiQuarterPlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KpiQuarterPlan::class);
    }

    // /**
    //  * @return KpiQuarterPlan[] Returns an array of KpiQuarterPlan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KpiQuarterPlan
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
