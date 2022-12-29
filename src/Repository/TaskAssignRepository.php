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
class TaskAssignRepository extends ServiceEntityRepository {

    public function __construct(ManagerRegistry $registry) {
        parent::__construct($registry, TaskAssign::class);
    }

    public function findPerformerTaskEdit($id) {

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

    public function findTaskUsers($value) {
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

    public function getTaskStatusAssigned($id, $office, $quarter) {
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

    public function findPerformerTaskUsers($value) {
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

    public function findPerformerTaskCount($value) {
        return $this->createQueryBuilder('t')
                        // ->leftJoin('ta.performerTask','p')
                        ->andWhere('t.assignedTo = :val')
                        ->andWhere('t.status < 5  ')
                        ->setParameter('val', $value)
                        ->select('count(t.id)')
                        //  ->setParameter('status', 5)
                        ->orderBy('t.id', 'ASC')
                        ->getQuery()->getSingleScalarResult();
    }

    public function findTaskUsersList($value) {
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

    public function findTaskOperattionalList($principalOfficeId) {
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

    public function getTaskList($principalOfficeId) {
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

    public function getTaskListOperational($operationalOfficeId) {
        return $this->createQueryBuilder('t')
                        ->leftJoin('t.PerformerTask', 'p')
                        ->leftJoin('p.taskCategory', 'ta')
                        ->leftJoin('p.operationalOffice', 'off')
                        ->select('count(t.id)')
                        ->andWhere('off.id = :val')
                        ->andWhere('t.type < 3 ')
                        ->andWhere('t.status > 4 ')
                       // ->andWhere('ta.isCore  = 0 ')
                        ->setParameter('val', $operationalOfficeId)
                        ->orderBy('t.id', 'ASC')
                        // ->setMaxResults(10)
                        ->getQuery()->getSingleScalarResult();
    }

    public function findByPrincipal($principalOffice, $quarter, $taskCategory) {

        return $this->createQueryBuilder('ta')
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
                        ->orderBy('ta.id', 'ASC')
                        ->getQuery()
                        ->getResult();
    }

    public function search($search = []) {

        $qb = $this->createQueryBuilder('TaskA')
                ->innerJoin('TaskA.PerformerTask', 'performTask')
                    ->innerJoin('performTask.operationalPlanningAcc', 'OPA')
                    ->innerJoin('OPA.operationalSuitable', 'OS')
                    ->innerJoin('OS.suitableInitiative', 'SI');
        
        if (isset($search['goal']) && sizeof($search['goal']) > 0) {
            $qb
                    ->innerJoin('SI.initiative', 'i')
                    ->innerJoin('i.keyPerformanceIndicator', 'kk')
                    ->innerJoin('kk.objective', 'o')
                    ->where('TaskA.challenge is not null')
                    ->andwhere('TaskA.challenge!=:none')
                    ->andwhere('TaskA.challenge!=:useless1')
                    ->andWhere('o.goal in (:goal)')
                    ->setParameter('goal', $search['goal'])
                    ->setParameter('none', 'none')
                    ->setParameter('useless1', 'N/A');
                   
        }
       else if (isset($search['objective']) && sizeof($search['objective']) > 0) {
            $qb
                  ->innerJoin('SI.initiative', 'i')
                    ->innerJoin('i.keyPerformanceIndicator', 'kk')
                    ->innerJoin('kk.objective', 'o')
                    ->where('TaskA.challenge is not null')
                    ->andwhere('TaskA.challenge!=:none')
                    ->andwhere('TaskA.challenge!=:useless1')
                    ->andWhere('o in (:objective)')
                    ->setParameter('objective', $search['objective'])
                    ->setParameter('none', 'none')
                    ->setParameter('useless1', 'N/A');
        }
       else if (isset($search['kpi']) && sizeof($search['kpi']) > 0) {
            $qb
                  ->innerJoin('SI.initiative', 'i')
                    ->where('TaskA.challenge is not null')
                    ->andwhere('TaskA.challenge!=:none')
                    ->andwhere('TaskA.challenge!=:useless1')
                    ->andWhere('i.keyPerformanceIndicator in (:kpi)')
                    ->setParameter('kpi', $search['kpi'])
                    ->setParameter('none', 'none')
                    ->setParameter('useless1', 'N/A');
        }
       else if (isset($search['initiative']) && sizeof($search['initiative']) > 0) {
          
          $qb
                  ->innerJoin('SI.initiative', 'i')
                    ->where('TaskA.challenge is not null')
                    ->andwhere('TaskA.challenge!=:none')
                    ->andwhere('TaskA.challenge!=:useless1')
                    ->andWhere('SI.initiative in (:initiat)')
                    ->setParameter('initiat', $search['initiative'])
                    ->setParameter('none', 'none')
                    ->setParameter('useless1', 'N/A');
        }
       else if (isset($search['principaloffice']) && sizeof($search['principaloffice']) > 0) {
           $qb
                  ->innerJoin('SI.principalOffice', 'po')
                    ->innerJoin('SI.initiative', 'i')
                    ->where('TaskA.challenge is not null')
                    ->andwhere('TaskA.challenge!=:none')
                    ->andwhere('TaskA.challenge!=:useless1')
                    ->andWhere('po in (:prinipal)')
                    ->setParameter('prinipal', $search['principaloffice'])
                    ->setParameter('none', 'none')
                    ->setParameter('useless1', 'N/A');
        }
       else if (isset($search['planyear']) && sizeof($search['planyear']) > 0) {
           $qb
                  ->innerJoin('SI.planningYear', 'py')
                    ->innerJoin('SI.initiative', 'i')
                    ->where('TaskA.challenge is not null')
                    ->andwhere('TaskA.challenge!=:none')
                    ->andwhere('TaskA.challenge!=:useless1')
                    ->andWhere('py in (:planningYear)')
                    ->setParameter('planningYear', $search['planyear'])
                    ->setParameter('none', 'none')
                    ->setParameter('useless1', 'N/A');
        }
        
        
         $qb->orderBy('SI.initiative')  ->getQuery() ->getResult();
         
        if (isset($search['perspective']) && sizeof($search['perspective']) > 0) {
            $qb->andWhere('o.perspective in (:perspective)')
                    ->setParameter('perspective', $search['perspective']);
        }
        if (isset($search['objective']) && sizeof($search['objective']) > 0) {

            $qb
                    ->Join('i.keyPerformanceIndicator', 'k')
                    ->andWhere('k.objective in (:objective)')
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
        if (isset($search['principaloffice']) && sizeof($search['principaloffice']) > 0) {
            $qb
                    ->leftJoin('i.principalOffice', 'p')
                    ->andWhere('p.id in (:principalOffice)')
                    ->setParameter('principalOffice', $search['principaloffice']);
        }
        if (isset($search['category']) && sizeof($search['category']) > 0) {
            $qb
                    ->leftJoin('i.category', 'c')
                    ->andWhere('c.id in (:category)')
                    ->setParameter('category', $search['category']);
        }
        if (isset($search['task']) && sizeof($search['task']) > 0) {
            $qb
                    ->leftJoin('i.coreTask', 'c')
                    ->andWhere('c.id in (:task)')
                    ->setParameter('task', $search['task']);
        }
        if (isset($search['coreTask'])) {
            if ($search['coreTask'] == 0) {
                $qb
                        ->andWhere('i.coreTask is NULL');
            } else {
                $qb
                        ->andWhere('i.coreTask IS NOT NULL');
            }
        }
        if (isset($search['name'])) {

            $qb
                    ->leftJoin('i.translations', 't')
                    ->andWhere("t.name  LIKE '%" . $search['name'] . "%' ");
        }


        return $qb->orderBy('i.initiativeNumber', 'ASC')->getQuery();
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
