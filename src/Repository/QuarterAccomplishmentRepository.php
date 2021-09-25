<?php

namespace App\Repository;

use App\Entity\QuarterAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Self_;

/**
 * @method QuarterAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuarterAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuarterAccomplishment[]    findAll()
 * @method QuarterAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuarterAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuarterAccomplishment::class);
    }

    // /**
    //  * @return QuarterAccomplishment[] Returns an array of QuarterAccomplishment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuarterAccomplishment
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByAchievement($achievement,$quarter)
    {
        $qb=$this->createQueryBuilder('q')
        ->andWhere('q.yearPlan = :plan')
        ->andWhere('q.quarter = :quarter')
        ->setParameter('plan',$achievement)
         ->setParameter('quarter',$quarter);
       return $qb->getQuery()->getOneOrNullResult();
        
      
         
     

    }
     public function getSumByObjkpi($objective, $year,$quarter)
    {
        $qb = $this->createQueryBuilder('p')
          ->select('sum(p.achievementValue)')
           ->join('p.yearPlan','y')
            ->join('y.kpi','k')
            ->join('k.strategy','s')
          
            
            ->andWhere('s.objective =:objective')
            ->andWhere('y.year =:year')
            ->andWhere('p.quarter =:quarter')
            ->setParameter('quarter', $quarter)
            ->setParameter('objective', $objective)
            ->setParameter('year', $year);
            return $qb->getQuery()->getSingleScalarResult();
          
        
    }
     public function getSumOfObjGoal($goal, $year,$quarter)
    {
        $qb = $this->createQueryBuilder('p')
          ->select('sum(p.achievementValue)')
           ->join('p.yearPlan','y')
            ->join('y.Objective','o')
            // ->join('k.strategy','s')
          
            
            ->andWhere('o.goal =:goal')
            ->andWhere('y.year =:year')
            ->andWhere('p.quarter =:quarter')
            ->setParameter('quarter', $quarter)
            ->setParameter('goal', $goal)
            ->setParameter('year', $year);
            return $qb->getQuery()->getSingleScalarResult();
          
        
    }
}
