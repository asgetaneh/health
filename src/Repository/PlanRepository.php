<?php

namespace App\Repository;

use App\Entity\Plan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Plan|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plan|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plan[]    findAll()
 * @method Plan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plan::class);
    }

    // /**
    //  * @return Plan[] Returns an array of Plan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Plan
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function checkForDuplicationOfPlan($principaloffice,$initiative,$planphase,$quarter){
   $qb=$this->createQueryBuilder('p')
   ->andWhere('p.office = :office')
   ->andWhere('p.initiative = :intiative')
   ->andwhere('p.planningPhase = :planphase')
    ->andwhere('p.quarter = :quarter')
   ->setParameter('office',$principaloffice)
   ->setParameter('intiative',$initiative)
   ->setParameter('quarter',$quarter)
   
   ->setParameter('planphase',$planphase);
   return $qb->getQuery()->getResult();

    }
}
