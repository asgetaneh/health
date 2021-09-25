<?php

namespace App\Repository;

use App\Entity\StaffEvaluationBehaviorCriteria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StaffEvaluationBehaviorCriteria|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaffEvaluationBehaviorCriteria|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaffEvaluationBehaviorCriteria[]    findAll()
 * @method StaffEvaluationBehaviorCriteria[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffEvaluationBehaviorCriteriaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StaffEvaluationBehaviorCriteria::class);
    }

    // /**
    //  * @return StaffEvaluationBehaviorCriteria[] Returns an array of StaffEvaluationBehaviorCriteria objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StaffEvaluationBehaviorCriteria
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
