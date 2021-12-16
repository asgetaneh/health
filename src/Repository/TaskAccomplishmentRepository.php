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

  
    // public function findTask($user)
    // {

    //     //dd($productNmae);
    //     return $this->createQueryBuilder('s')->leftJoin('s.taskUser', 'ts')

    //         ->andWhere('ts.assignedTo = :val')
    //         ->setParameter('val', $user)
    //         ->orderBy('s.id', 'ASC')

    //         ->getQuery()

    //         ->getResult();
    // }
    // public function findDetailAccomplish($suitableInitiative, $user)
    // {

    //     //dd($productNmae);
    //     return $this->createQueryBuilder('s')->leftJoin('s.taskUser', 'ts')
    //         ->leftJoin('ts.taskAssign', 'ta')
    //         ->leftJoin('ta.PerformerTask', 'ps')
    //         ->leftJoin('ps.PlanAcomplishment', 'pa')
    //         ->andWhere('pa.suitableInitiative = :val')
    //         ->andWhere('ps.createdBy = :user')
    //         ->setParameter('user', $user)
    //         ->setParameter('val', $suitableInitiative)
    //         ->orderBy('ps.name', 'ASC')

    //         ->getQuery()

    //         ->getResult();
    // }
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

    // public function search($search = [])
    // {
    //     //   $user=$this->getUser();
    //     $qb = $this->createQueryBuilder('taa')
    //         ->innerJoin('taa.taskUser', 'tu')
    //         ->innerJoin('tu.taskAssign', 'ta')
    //         ->innerJoin('ta.PerformerTask', 'p');

    //     if (isset($search['performerName'])) {
    //         $qb
    //             ->innerJoin('tu.assignedTo', 'u')
    //             ->innerJoin('u.userInfo', 'ui')
    //                ->andWhere('ui.id = :performerName')
    //             ->setParameter('performerName', $search['performerName']);
    //     }
    //       if(isset($search['taskName']) ){
    //         $qb->andWhere('p.id = :taskName')
    //         ->setParameter('taskName',$search['taskName']);

    //     }
      
    //      if(isset($search['initiative']) ){

    //         $qb 
    //         ->Join('p.PlanAcomplishment','pl')
    //         ->Join('pl.suitableInitiative','si')
    //         ->Join('si.initiative','i')
    //         // ->Join('i.translations','t')
    //         ->andWhere('i.id = :initiative')
    //         ->setParameter('initiative',$search['initiative']);

    //     }
    //       if(isset($search['quarter'])){
    //         $qb->Join('p.quarter','q')
    //         ->andWhere('q.id = :quarter')
    //         ->setParameter('quarter',$search['quarter']);

    //     }
    //      if(isset($search['planningYear']) ){
    //         $qb->Join('p.PlanAcomplishment','pl')
    //         ->Join('pl.suitableInitiative','si')
    //           ->leftJoin('si.planningYear','py')
    //         ->andWhere('py.id = :planningYear')
    //         ->setParameter('planningYear',$search['planningYear']);

    //     }


    //     return $qb->orderBy('taa.id', 'ASC')->getQuery();
    // }

 public function findPrintTasks($taskAssignedTo)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')
            ->leftJoin('s.taskAssign', 'ta')
           
            ->andWhere('ta.assignedTo = :taskAssignedTo')
            ->setParameter('taskAssignedTo', $taskAssignedTo)

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
