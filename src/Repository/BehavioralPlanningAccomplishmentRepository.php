<?php

namespace App\Repository;

use App\Entity\BehavioralPlanningAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BehavioralPlanningAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method BehavioralPlanningAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method BehavioralPlanningAccomplishment[]    findAll()
 * @method BehavioralPlanningAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BehavioralPlanningAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BehavioralPlanningAccomplishment::class);
    }

    // /**
    //  * @return BehavioralPlanningAccomplishment[] Returns an array of BehavioralPlanningAccomplishment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BehavioralPlanningAccomplishment
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function findDuplication($suitableinitiative,$attrib,$quarter){
      $qb=$this->createQueryBuilder('pa');
      $qb
      ->andWhere('pa.suitableInitiative = :plan')
      ->andWhere('pa.initiativeAttribute = :attrib')
      ->andWhere('pa.quarter = :quarter')
      ->setParameter('plan',$suitableinitiative)
      ->setParameter('quarter',$quarter)
       ->setParameter('attrib',$attrib);
      return $qb->getQuery()->getSingleScalarResult();
      
    }
}
