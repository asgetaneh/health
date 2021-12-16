<?php

namespace App\Repository;

use App\Entity\KPiAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KPiAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method KPiAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method KPiAchievement[]    findAll()
 * @method KPiAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KPiAchievementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KPiAchievement::class);
    }

    // /**
    //  * @return KPiAchievement[] Returns an array of KPiAchievement objects
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
    public function findOneBySomeField($value): ?KPiAchievement
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function getByKpiAndYear($kpi,$year)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.kpi = :init')
            ->andWhere('i.year = :year')
            ->setParameter('init', $kpi)
            ->setParameter('year', $year)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
     public function findAlls()
    {
        return $this->createQueryBuilder('g')
         
            ->orderBy('g.id', 'ASC')






            ->getQuery();
    }

    public function search($search=[]){

        $qb=$this->createQueryBuilder('ka')
        ->join('ka.kpi','k')
        ->join('k.strategy','s')
        ->join('s.objective','o')
        ;
         if (isset($search['year']) && sizeof($search['year']) > 0) {
            $qb->andWhere('ka.year in (:year)')
                ->setParameter('year', $search['year']);
        }
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
            ->setParameter('sstrategy',$search['strategy']);
            
        }
        if(isset($search['name']) ){
              
            $qb
            ->join('k.translations','t')
            ->andWhere("t.name  LIKE '%" . $search['name']. "%' ");
        

            
        }

        return $qb->orderBy('k.id','ASC')->getQuery();
    }
}
