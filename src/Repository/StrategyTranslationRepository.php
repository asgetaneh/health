<?php

namespace App\Repository;

use App\Entity\StrategyTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\BrowserKit\Request;

/**
 * @method StrategyTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method StrategyTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method StrategyTranslation[]    findAll()
 * @method StrategyTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrategyTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StrategyTranslation::class);
    }

    // /**
    //  * @return StrategyTranslation[] Returns an array of StrategyTranslation objects
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
    public function findOneBySomeField($value): ?StrategyTranslation
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function search($search=[],$request){

        $qb=$this->createQueryBuilder('s')
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
        if(isset($search['name']) ){
            
           $qb->leftJoin('App:StrategyTranslation','translation')
           ->addSelect('translation')
            ->andWhere("translation.name  LIKE '%" . $search['name']. "%' ");
        

            
        }

        return $qb->orderBy('s.id','ASC')->getQuery();
    }
}
