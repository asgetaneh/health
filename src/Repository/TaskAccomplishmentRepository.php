<?php

namespace App\Repository;

use App\Entity\TaskAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskAccomplishment[]    findAll()
 * @method TaskAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskAccomplishment::class);
    }


    public function findTasksInReport($suitableInitiativeId)
    {

        return $this->createQueryBuilder('ts')
            ->leftJoin('ts.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.quarter', 'q')
            ->leftJoin('ta.assignedTo', 'u')
            ->leftJoin('ps.operationalOffice','opf')
            ->leftJoin('u.userInfo', 'ui')
            ->leftJoin('ps.taskCategory', 'tc')
            ->leftJoin('ps.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'op')
            ->leftJoin('op.suitableInitiative', 'su')
            ->select('ps.name')
            ->addSelect('q.name as quarterName')
            ->addSelect('tc.name as taskCategory')
            ->addSelect('ui.fullName')
            ->addSelect('opf.name as operationalOffice')
            ->addSelect('ts.expectedValue')

            ->addSelect('ts.accomplishmentValue')
            ->addSelect('ta.id as taskAssinedId')

            // ->andWhere('ps.status = 1')
            // ->andWhere('ta.status = 5')
            ->andWhere('su.id = :suitableInitiativeId')
            ->setParameter('suitableInitiativeId', $suitableInitiativeId)
            ->orderBy('tc.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    
    

    public function findTasksInReportAccomplesed($suitableInitiativeId)
    {

        $qb = $this->createQueryBuilder('ts');
        return  $qb->Where($qb->expr()->isNotNull('ts.accomplishmentValue'))
            ->leftJoin('ts.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.quarter', 'q')
            ->leftJoin('ta.assignedTo', 'u')
            ->leftJoin('ps.operationalOffice', 'opf')
            ->leftJoin('u.userInfo', 'ui')
            ->leftJoin('ps.taskCategory', 'tc')
            ->leftJoin('ps.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'op')
            ->leftJoin('op.suitableInitiative', 'su')
            ->select('ps.name')
            ->addSelect('ts.id taskAccomplisedId')
            ->addSelect('q.name as quarterName')
            ->addSelect('tc.name as taskCategory')
            ->addSelect('ui.fullName')
            ->addSelect('opf.name as operationalOffice')
            ->addSelect('ts.expectedValue')

            ->addSelect('ts.accomplishmentValue')
            ->addSelect('ta.id as taskAssinedId')

            // ->andWhere('ps.status = 1')suitableInitiativeId
            // ->andWhere('ta.status = 5')
            ->andWhere('su.id = :suitableInitiativeId')
            ->setParameter('suitableInitiativeId', $suitableInitiativeId)
            ->orderBy('tc.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    public function findOperationalAccomplishment($suitableInitiative, $quarter)
    {

        return $this->createQueryBuilder('ts')
            ->leftJoin('ts.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.taskCategory', 'tc')
            ->leftJoin('ps.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'op')
            ->leftJoin('op.suitableInitiative', 'su')
            ->andWhere('ps.status = 1')
            ->andWhere('ta.status = 5')
            ->andWhere('tc.isCore = 1')
            ->andWhere('op.status = 1')
            ->andWhere('ps.quarter = :quarter')
            ->andWhere('su.id = :suitableInitiative')
            ->setParameter('suitableInitiative', $suitableInitiative)
            ->setParameter('quarter', $quarter)
            ->orderBy('ts.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    public function findByPrincipal($principalOffice, $quarter, $taskCategory)
    {

        return $this->createQueryBuilder('ts')
            ->leftJoin('ts.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.operationalPlanningAcc', 'pa')
            ->leftJoin('pa.operationalSuitable', 'op')
            ->leftJoin('op.suitableInitiative', 'su')
            ->leftJoin('ps.taskCategory', 'tc')
            ->andWhere('tc.id = :taskCategory')
            ->setParameter('taskCategory', $taskCategory)
            ->andWhere('ps.quarter = :quarter')
            ->setParameter('quarter', $quarter)
            ->andWhere('su.principalOffice = :principalOffice')
            ->setParameter('principalOffice', $principalOffice)
            ->orderBy('ts.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    public function findDetailAccomplishSocial($suitableInitiative, $user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')
            ->leftJoin('s.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.operationalPlanningAcc', 'pa')
            ->andWhere('pa.operationalSuitable = :val')
            ->andWhere('ps.createdBy = :user')
            ->setParameter('user', $user)
            ->setParameter('val', $suitableInitiative)
            ->orderBy('ps.name', 'ASC')

            ->getQuery()

            ->getResult();
    }



    public function findPrintTasks($taskAssignedTo)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')
            ->leftJoin('s.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.taskCategory', 'tc')
            ->andWhere('tc.isCore = 0')
            ->andWhere('ta.assignedTo = :taskAssignedTo')
            ->setParameter('taskAssignedTo', $taskAssignedTo)

            ->getQuery()

            ->getResult();
    }
    
    public function findTaskUsersListByAssiner($value,$quarter,$year)
    {
        return $this->createQueryBuilder('taskacc')
            ->leftJoin('taskacc.taskAssign', 'tasign')
            ->leftJoin('tasign.PerformerTask', 'pt')
            ->innerJoin('pt.operationalPlanningAcc', 'OPA')
            ->innerJoin('OPA.operationalSuitable', 'OS')
            ->innerJoin('OS.suitableInitiative', 'SI')
                
             ->andWhere('pt.createdBy = :val')
            ->andWhere('pt.quarter = :quarter')
            ->andWhere('SI.planningYear = :planningYear')
             ->andWhere('tasign.type < 3 ')
            ->andWhere('tasign.status > 4 ')
             ->setParameter('val', $value)
            ->setParameter('quarter', $quarter)
            ->setParameter('planningYear', $year)
            ->orderBy('tasign.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return TaskAccomplishment[] Returns an array of TaskAccomplishment objects
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
    public function findOneBySomeField($value): ?TaskAccomplishment
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
