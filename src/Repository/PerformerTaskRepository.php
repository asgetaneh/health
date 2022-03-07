<?php

namespace App\Repository;

use App\Entity\PerformerTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PerformerTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerformerTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerformerTask[]    findAll()
 * @method PerformerTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformerTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformerTask::class);
    }

    public function getTaskStatus($id, $office, $quarter)
    {
        // dd($id,$office,$quarter);

        return $this->createQueryBuilder('s')
            ->leftJoin('s.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'su')
            ->select('count(s.id)')
            ->andWhere('su.id =  :id')
            ->andWhere('s.operationalOffice =  :office')
            ->andWhere('s.quarter =  :quarter')
            ->setParameter('office', $office)
            ->setParameter('quarter', $quarter)

            ->setParameter('id', $id)

            ->getQuery()->getSingleScalarResult();
    }
    public function getTaskStatusSend($id, $office, $quarter)
    {
        // dd($id);

        return $this->createQueryBuilder('s')
            ->leftJoin('s.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable ', 'su')
            ->select('count(s.id)')->andWhere('su.id =  :id')
            ->andWhere('s.status =  0')
            ->andWhere('s.operationalOffice =  :office')
            ->andWhere('s.quarter =  :quarter')
            ->setParameter('quarter', $quarter)

            ->setParameter('office', $office)
            ->setParameter('id', $id)

            ->getQuery()->getSingleScalarResult();
    }

    public function filterDeliverByIsCore($plan, $user, $quarter)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')
            ->leftJoin('s.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'su')
            ->leftJoin('s.taskCategory', 'ta')



            ->Select('s.name')

            ->addSelect('s.id')
            // ->addSelect('s.user')

            ->orderBy('s.id', 'ASC')->andWhere('su.id = :plan')
            ->setParameter('plan', $plan)
            ->andWhere('s.quarter = :quarter')
            ->setParameter('quarter', $quarter)
            ->andWhere('s.createdBy = :user')
            ->andWhere('ta.isCore = 1')
            ->andWhere('s.status = 1')
            ->setParameter('user', $user)
            ->getQuery()

            ->getResult();
    }
    public function filterDeliverBy($plan, $user, $quarter)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')
            ->leftJoin('s.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'su')
            ->leftJoin('s.taskCategory', 'ta')
            ->Select('s.name')
            ->addSelect('s.id')
            // ->addSelect('s.user')
            ->orderBy('s.id', 'ASC')->andWhere('su.id = :plan')
            ->setParameter('plan', $plan)
            ->andWhere('s.quarter = :quarter')
            ->setParameter('quarter', $quarter)
            ->andWhere('s.createdBy = :user')
            ->andWhere('ta.isCore = 0')
            ->andWhere('s.status = 1')
            ->setParameter('user', $user)
            ->getQuery()

            ->getResult();
    }
    public function findPerformerInitiativeTask($user, $initiative)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')

            ->leftJoin('s.operationalPlanningAcc', 'pl')
            ->andWhere('pl.operationalSuitable = :initiative')
            ->andWhere('s.createdBy = :user')
            ->andWhere('s.status = 1')



            ->setParameter('initiative', $initiative)
            ->setParameter('user', $user)

            ->orderBy('s.id', 'ASC')
            ->getQuery()

            ->getResult();
    }
    public function findInitiativeBy($suitableinitiative, $user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')

            ->leftJoin('s.PlanAcomplishment', 'pl')
            ->andWhere('pl.suitableInitiative = :initiative')
            ->andWhere('s.createdBy = :user')
            ->setParameter('user', $user)
            ->setParameter('initiative', $suitableinitiative)

            ->orderBy('s.id', 'ASC')
            ->getQuery()

            ->getResult();
    }
    public function findInitiativeBySocial($suitableOperational, $user, $quarter)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')

            ->leftJoin('s.operationalPlanningAcc', 'pl')
            ->leftJoin('s.taskCategory', 'tc')
            ->andWhere('pl.operationalSuitable = :initiative')
            ->andWhere('s.createdBy = :user')
            ->andWhere('s.quarter = :quarter')
            ->andWhere('tc.isCore = 0')
            ->setParameter('user', $user)
            ->setParameter('quarter', $quarter)
            ->setParameter('initiative', $suitableOperational)

            ->orderBy('s.id', 'ASC')
            ->getQuery()

            ->getResult();
    }
    public function findCores($suitableOperational, $user, $quarter)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')

            ->leftJoin('s.operationalPlanningAcc', 'pl')
            ->leftJoin('s.taskCategory', 'tc')
            ->andWhere('pl.operationalSuitable = :initiative')
            ->andWhere('s.createdBy = :user')
            ->andWhere('s.quarter = :quarter')
            ->andWhere('tc.isCore = 1')
            ->setParameter('user', $user)
            ->setParameter('quarter', $quarter)
            ->setParameter('initiative', $suitableOperational)

            ->orderBy('s.id', 'ASC')
            ->getQuery()

            ->getResult();
    }



    public function findsendToprincipal($user, $suitableinitiative)
    {

        // dd($user);
        return $this->createQueryBuilder('s')

            ->leftJoin('s.PlanAcomplishment', 'pl')
            ->andWhere('pl.suitableInitiative = :initiative')
            ->andWhere('s.createdBy = :user')
            ->setParameter('user', $user)
            ->setParameter('initiative', $suitableinitiative)
            ->orderBy('s.id', 'ASC')
            ->getQuery()

            ->getResult();
    }
    public function findsendToprincipalSocial($user, $suitableinitiative)
    {

        // dd($user);
        return $this->createQueryBuilder('s')

            ->leftJoin('s.operationalPlanningAcc', 'pl')
            ->andWhere('pl.operationalSuitable = :initiative')
            ->andWhere('s.createdBy = :user')
            ->setParameter('user', $user)
            ->setParameter('initiative', $suitableinitiative)
            ->orderBy('s.id', 'ASC')
            ->getQuery()

            ->getResult();
    }
    public function findPerformerTaskEdit($id)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')



            ->Select('s.name')

            ->addSelect('s.id')
            ->addSelect('s.weight')

            ->orderBy('s.id', 'ASC')->andWhere('s.id = :id')
            ->setParameter('id', $id)

            ->getQuery()

            ->getResult();
    }
    public function findProgress($quarter, $currentYear, $operationalOffice)
    {
        return $this->createQueryBuilder('pt')

            ->leftJoin('pt.PlanAcomplishment', 'pa')
            ->leftJoin('pa.suitableInitiative', 's')
            ->leftJoin('s.planningYear', 'y')
            ->andWhere('pt.operationalOffice = :operationalOffice')
            ->andWhere('y.ethYear = :currentYear')
            ->setParameter('currentYear', $currentYear)
            ->setParameter('operationalOffice', $operationalOffice)
            ->andWhere('pt.quarter = :quarter')
            ->setParameter('quarter', $quarter)
            ->orderBy('pt.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

    public function findByPrincipal($principalOffice)
    {

        return $this->createQueryBuilder('ps')
            ->leftJoin('ps.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'op')
            ->leftJoin('op.suitableInitiative', 'su')
            ->andWhere('ps.quarter = 3')
            ->andWhere('su.principalOffice = :principalOffice')
            ->setParameter('principalOffice', $principalOffice)
            ->orderBy('ps.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    // /**
    //  * @return PerformerTask[] Returns an array of PerformerTask objects
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
    public function findOneBySomeField($value): ?PerformerTask
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
