<?php

namespace App\Repository;

use App\Entity\PlanningAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningAccomplishment[]    findAll()
 * @method PlanningAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningAccomplishment::class);
    }

    // /**
    //  * @return PlanningAccomplishment[] Returns an array of PlanningAccomplishment objects
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
    public function findOneBySomeField($value): ?PlanningAccomplishment
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function findDuplication($suitableinitiative,$attrib=null,$quarter){
      $qb=$this->createQueryBuilder('pa');
      $qb
      ->andWhere('pa.suitableInitiative = :plan')
        ->andWhere('pa.quarter = :quarter')
        ->setParameter('plan',$suitableinitiative)
      ->setParameter('quarter',$quarter);
      if ($attrib) {
         $qb->andWhere('pa.socialAttribute = :attrib')
    
    
          ->setParameter('attrib',$attrib);
      }

      
      return $qb->getQuery()->getOneOrNullResult();
      
    }
    
    
     public function findBySuitable($suitable){
      $qb=$this->createQueryBuilder('pa');
      $qb->join('pa.plan','pl')
      ->andwhere('pl.suitableInitiative in (:suitin)')
      ->setParameter('suitin',$suitable);
      return $qb->getQuery()->getResult();
      
    }

}
