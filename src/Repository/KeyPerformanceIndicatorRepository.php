<?php

namespace App\Repository;

use App\Entity\KeyPerformanceIndicator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KeyPerformanceIndicator|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeyPerformanceIndicator|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeyPerformanceIndicator[]    findAll()
 * @method KeyPerformanceIndicator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyPerformanceIndicatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeyPerformanceIndicator::class);
    }
    public function findAlls()
    {
        return $this->createQueryBuilder('g')
            
            ->getQuery();
        
    }

    // /**
    //  * @return KeyPerformanceIndicator[] Returns an array of KeyPerformanceIndicator objects
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
    public function findOneBySomeField($value): ?KeyPerformanceIndicator
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function search($search=[]){

        $qb=$this->createQueryBuilder('k')
        ->join('k.strategy','s')
        ->join('s.objective','o')
        ;
        if(isset($search['goal']) && sizeof($search['goal'])>0){
            $qb->andWhere('o.goal in (:goal)')
            ->setParameter('goal',$search['goal']);

        }
          if(isset($search['perspective']) && sizeof($search['perspective'])>0 ){
            $qb->andWhere('o.perspective in (:perspective)')
            ->setParameter('perspective',$search['perspective']);
            
        }
         if(isset($search['objective']) && sizeof($search['objective'])>0 ){
            $qb->andWhere('s.objective in (:objective)')
            ->setParameter('objective',$search['objective']);
            
        }
         if(isset($search['strategy']) && sizeof($search['strategy'])>0 ){
            $qb->andWhere('k.strategy in (:strategy)')
            ->setParameter('strategy',$search['strategy']);
            
        }
        if(isset($search['name']) ){
              
            $qb
            ->join('k.translations','t')
            ->andWhere("t.name  LIKE '%" . $search['name']. "%' ");
        

            
        }

        return $qb->orderBy('k.id','ASC')->getQuery();
    }
}
