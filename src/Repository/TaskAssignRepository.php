<?php

namespace App\Repository;

use App\Entity\TaskAssign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskAssign|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskAssign|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskAssign[]    findAll()
 * @method TaskAssign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskAssignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskAssign::class);
    }
    public function findPerformerTaskEdit($id)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')



            ->Select('s.id')
            ->addSelect('s.startDate')
            ->addSelect('s.endDate')
            ->addSelect('s.expectedValue')
            ->orderBy('s.id', 'ASC')->andWhere('s.id = :id')
            ->setParameter('id', $id)

            ->getQuery()

            ->getResult();
    }
    public function findTaskUsers($value)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.PerformerTask', 'p')
            ->andWhere('p.createdBy = :val')
            //  ->andWhere('t.type = 1 or t.type = 2 ')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    public function getTaskStatusAssigned($id, $office, $quarter)
    {
        // dd($id);

        return $this->createQueryBuilder('ta')
            ->leftJoin('ta.PerformerTask', 's')
            ->leftJoin('s.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'su')
            ->select('count(ta.id)')->andWhere('su.id =  :id')
            ->andWhere('s.operationalOffice =  :office')
            ->andWhere('s.quarter = :quarter')
            ->setParameter('office', $office)
            ->setParameter('quarter', $quarter)
            ->setParameter('id', $id)

            ->getQuery()->getSingleScalarResult();
    }
    public function findPerformerTaskUsers($value)
    {
        return $this->createQueryBuilder('t')
            // ->leftJoin('ta.performerTask','p')
            ->andWhere('t.assignedTo = :val')
            ->andWhere('t.status < 5  ')
            ->setParameter('val', $value)
            //  ->setParameter('status', 5)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    public function findTaskUsersList($value)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.PerformerTask', 'p')
            ->leftJoin('p.taskCategory', 'ta')
            ->andWhere('p.createdBy = :val')
            ->andWhere('t.type < 3 ')
            ->andWhere('t.status > 4 ')
            ->andWhere('ta.isCore = 0')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    public function findTaskOperattionalList($principalOfficeId)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.PerformerTask', 'p')
            ->leftJoin('p.taskCategory', 'ta')
            ->leftJoin('p.operationalOffice', 'of')
            ->leftJoin('of.principalOffice', 'pf')
            ->andWhere('pf.id = :val')
            ->andWhere('t.type < 3 ')
            ->andWhere('t.status > 4 ')
            ->andWhere('ta.isCore  = 1 ')
            ->setParameter('val', $principalOfficeId)
            ->orderBy('t.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    public function getTaskList($principalOfficeId)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.PerformerTask', 'p')
            ->leftJoin('p.taskCategory', 'ta')
            ->leftJoin('p.operationalOffice', 'of')
            ->leftJoin('of.principalOffice', 'pf')
            ->select('count(t.id)')
            ->andWhere('pf.id = :val')

            ->andWhere('t.type < 3 ')
            ->andWhere('t.status > 4 ')
            ->andWhere('ta.isCore  = 1 ')
            ->setParameter('val', $principalOfficeId)
            ->orderBy('t.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()->getSingleScalarResult();
    }
     public function getTaskListOperational($operationalOfficeId)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.PerformerTask', 'p')
            ->leftJoin('p.taskCategory', 'ta')
            ->leftJoin('p.operationalOffice', 'off')
            ->select('count(t.id)')
            ->andWhere('off.id = :val')
            ->andWhere('t.type < 3 ')
            ->andWhere('t.status > 4 ')
            ->andWhere('ta.isCore  = 0 ')
            ->setParameter('val', $operationalOfficeId)
            ->orderBy('t.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()->getSingleScalarResult();
    }
    public function findByPrincipal($principalOffice)
    {

        return $this->createQueryBuilder('ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'op')
            ->leftJoin('op.suitableInitiative', 'su')
            ->andWhere('su.principalOffice = :principalOffice')
            ->setParameter('principalOffice', $principalOffice)
            ->orderBy('ta.id', 'ASC')

            ->getQuery()

            ->getResult();
    }

    // /**
    //  * @return TaskAssign[] Returns an array of TaskAssign objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TaskAssign
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
