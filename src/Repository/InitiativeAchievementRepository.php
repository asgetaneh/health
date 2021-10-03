<?php

namespace App\Repository;

use App\Entity\InitiativeAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeAchievement[]    findAll()
 * @method InitiativeAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeAchievementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeAchievement::class);
    }

    // /**
    //  * @return InitiativeAchievement[] Returns an array of InitiativeAchievement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InitiativeAchievement
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function getByInitiativeAndYear($initiative,$year)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.initiative = :init')
            ->andWhere('i.year = :year')
            ->setParameter('init', $initiative)
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
     public function search($search = [])
    {
            
        $qb = $this->createQueryBuilder('a')
        ->join('a.initiative','i');
         if (isset($search['year']) && sizeof($search['year']) > 0) {
            $qb->andWhere('a.year in (:year)')
                ->setParameter('year', $search['year']);
        }
        if (isset($search['goal']) && sizeof($search['goal']) > 0) {
            $qb
                ->innerJoin('i.keyPerformanceIndicator', 'k')
                ->innerJoin('k.strategy', 's')
                ->innerJoin('s.objective', 'o')
                ->andWhere('o.goal in (:goal)')
                ->setParameter('goal', $search['goal']);
        }
        if (isset($search['perspective']) && sizeof($search['perspective']) > 0) {
            $qb ->innerJoin('i.keyPerformanceIndicator', 'k')
                ->innerJoin('k.strategy', 's')
                ->innerJoin('s.objective', 'o')
            ->andWhere('o.perspective in (:perspective)')
                ->setParameter('perspective', $search['perspective']);
        }
        if (isset($search['objective']) && sizeof($search['objective']) > 0) {

            $qb
                ->Join('i.keyPerformanceIndicator', 'k')
                ->Join('k.strategy', 's')
                ->andWhere('s.objective in (:objective)')
                ->setParameter('objective', $search['objective']);
        }
        if (isset($search['strategy']) && sizeof($search['strategy']) > 0) {

            $qb
                ->Join('i.keyPerformanceIndicator', 'k')
                ->andWhere('k.strategy in (:strategy)')
                ->setParameter('strategy', $search['strategy']);
        }
        if (isset($search['kpi']) && sizeof($search['kpi']) > 0) {
           
            $qb->andWhere('i.keyPerformanceIndicator in (:kpi)')
                ->setParameter('kpi', $search['kpi']);
        }
        if (isset($search['initiative']) && sizeof($search['initiative']) > 0) {
            $qb
               
                ->andWhere('a.initiative in (:initiative)')
                ->setParameter('initiative', $search['initiative']);
        }
        if (isset($search['category']) && sizeof($search['category']) > 0) {
            $qb
                ->leftJoin('i.category', 'c')
                ->andWhere('c.id in (:category)')
                ->setParameter('category', $search['category']);
        }
        if (isset($search['name'])) {

            $qb
                ->leftJoin('i.translations', 't')
                ->andWhere("t.name  LIKE '%" . $search['name'] . "%' ");
        }


        return $qb->orderBy('i.initiativeNumber','ASC')->getQuery();

    }
    
  

}
