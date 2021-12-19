<?php

namespace App\Repository;

use App\Entity\QuarterPlanAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QuarterPlanAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuarterPlanAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuarterPlanAchievement[]    findAll()
 * @method QuarterPlanAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuarterPlanAchievementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuarterPlanAchievement::class);
    }

    // /**
    //  * @return QuarterPlanAchievement[] Returns an array of QuarterPlanAchievement objects
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
    public function findOneBySomeField($value): ?QuarterPlanAchievement
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByInitiativeAchievementAndQuarter($initiativeAchievement, $quarter)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.initiativeAchievement = :val')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $initiativeAchievement)
            ->setParameter('val2', $quarter)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getByInitiativeAndQuarter($initiative, $quarter, $year)
    {
        return $this->createQueryBuilder('q')

            ->join('q.initiativeAchievement', 'a')
            ->andWhere('a.initiative = :val')
            ->andWhere('a.year = :year')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $initiative)
            ->setParameter('val2', $quarter)
            ->setParameter('year', $year)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getByKpiAndQuarter($kpi, $quarter, $year)
    {
        return $this->createQueryBuilder('q')

            ->join('q.kPiAchievement', 'k')
            ->andWhere('k.kpi = :val')
            ->andWhere('k.year = :year')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $kpi)
            ->setParameter('val2', $quarter)
            ->setParameter('year', $year)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getByObjectiveAndQuarter($objective, $quarter, $year)
    {
        return $this->createQueryBuilder('q')

            ->join('q.objectiveAchievement', 'o')
            ->andWhere('o.objective = :val')
            ->andWhere('o.year = :year')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $objective)
            ->setParameter('val2', $quarter)
            ->setParameter('year', $year)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getByKpiAchievementAndQuarter($kpiAchievement, $quarter)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.kPiAchievement = :val')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $kpiAchievement)
            ->setParameter('val2', $quarter)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getByObjectiveAchievementAndQuarter($objectiveAchievement, $quarter)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.objectiveAchievement = :val')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $objectiveAchievement)
            ->setParameter('val2', $quarter)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getByGoalAchievementAndQuarter($goalAchievement, $quarter)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.goalAchievement = :val')
            ->andWhere('q.quarter = :val2')
            ->setParameter('val', $goalAchievement)
            ->setParameter('val2', $quarter)
            ->getQuery()
            ->getOneOrNullResult();
    }
    public function getSumByKpiAndYear($kpi, $year, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('sum(pa.plan) as plan')
            // ->leftjoin('pa.socialAttribute', 'sa')
            ->Join('pa.initiativeAchievement', 'ic')
            ->Join('ic.initiative', 'i')
            // ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('pa.quarter = :quarter')
            ->andwhere('i.keyPerformanceIndicator = :kpi')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)
            ->setParameter('quarter', $quarter)
            ->setParameter('kpi', $kpi)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getSumByObjectiveAndYear($objective, $year, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('sum(pa.plan) as plan')
            // ->leftjoin('pa.socialAttribute', 'sa')
            ->Join('pa.kPiAchievement', 'kc')
            ->Join('kc.kpi', 'k')
            ->join('k.strategy', 's')
            // ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('pa.quarter = :quarter')
            ->andwhere('s.objective = :obj')
            ->andwhere('kc.year = :year')

            ->setParameter('year',  $year)
            ->setParameter('quarter', $quarter)
            ->setParameter('obj', $objective)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getSumByGoalAndYear($goal, $year, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('sum(pa.plan) as plan')
            // ->leftjoin('pa.socialAttribute', 'sa')
            ->Join('pa.objectiveAchievement', 'oc')
            ->join('oc.objective', 'o')
            // ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('pa.quarter = :quarter')
            ->andwhere('o.goal = :goal')
            ->andwhere('oc.year = :year')

            ->setParameter('year',  $year)
            ->setParameter('quarter', $quarter)
            ->setParameter('goal', $goal)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getYearlyPlanByInitiative($initiative, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.plan) as plan')

            ->Join('pa.initiativeAchievement', 'ic')

            ->andwhere('ic.initiative = :initiative')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)

            ->setParameter('initiative', $initiative)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getYearlyPlanAccompByInitiative($initiative, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.accomp) as accomp')

            ->Join('pa.initiativeAchievement', 'ic')



            ->andwhere('ic.initiative = :initiative')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)

            ->setParameter('initiative', $initiative)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getYearlyPlanByKpi($kpi, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.plan) as plan')

            ->Join('pa.kPiAchievement', 'ic')

            ->andwhere('ic.kpi = :kpi')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)

            ->setParameter('kpi', $kpi)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getYearlyPlanAccompByKpi($kpi, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.accomp) as accomp')

            ->Join('pa.kPiAchievement', 'ic')



            ->andwhere('ic.kpi = :kpi')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)

            ->setParameter('kpi', $kpi)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getYearlyPlanByObjective($objective, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.plan) as plan')

            ->Join('pa.objectiveAchievement', 'ic')

            ->andwhere('ic.objective = :objective')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)

            ->setParameter('objective', $objective)
           
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getYearlyPlanAccompByObjective($objective, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.accomp) as accomp')

            ->Join('pa.objectiveAchievement', 'ic')

            ->andwhere('ic.objective = :objective')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)

            ->setParameter('objective', $objective)
          
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getYearlyPlanByGoal($goal, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.plan) as plan')

            ->Join('pa.goalAchievement', 'ic')

            ->andwhere('ic.goal = :goal')
            ->andwhere('ic.year = :year')

            ->setParameter('year',  $year)

            ->setParameter('goal', $goal);

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function getYearlyPlanAccompByGoal($goal, $year)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('avg(pa.accomp) as accomp')

        ->Join('pa.goalAchievement', 'ic')

        ->andwhere('ic.goal = :goal')
        ->andwhere('ic.year = :year')

        ->setParameter('year',  $year)

            ->setParameter('goal', $goal);

        return $qb->getQuery()->getSingleScalarResult();
    }
}
