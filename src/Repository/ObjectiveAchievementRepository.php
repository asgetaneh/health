<?php

namespace App\Repository;

use App\Entity\ObjectiveAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ObjectiveAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method ObjectiveAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method ObjectiveAchievement[]    findAll()
 * @method ObjectiveAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectiveAchievementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ObjectiveAchievement::class);
    }

    // /**
    //  * @return ObjectiveAchievement[] Returns an array of ObjectiveAchievement objects
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
    public function findOneBySomeField($value): ?ObjectiveAchievement
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function getByObjectiveAndYear($objective,$year)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.objective = :init')
            ->andWhere('i.year = :year')
            ->setParameter('init', $objective)
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
        
        ->join('ka.objective','o')
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
            $qb->andWhere('ka.objective in (:objective)')
            ->setParameter('objective',$search['objective']);
            
        }
       
        if(isset($search['name']) ){
              
            $qb
            ->join('k.translations','t')
            ->andWhere("t.name  LIKE '%" . $search['name']. "%' ");
        

            
        }

        return $qb->orderBy('o.id','ASC')->getQuery();
    }


}
