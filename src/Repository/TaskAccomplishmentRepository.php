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

    public function findTask($user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.taskUser', 'ts')

            ->andWhere('ts.assignedTo = :val')
            ->setParameter('val', $user)
            ->orderBy('s.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    public function findDetailAccomplish($suitableInitiative, $user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.taskUser', 'ts')
            ->leftJoin('ts.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.PlanAcomplishment', 'pa')
            ->andWhere('pa.suitableInitiative = :val')
            ->andWhere('ps.createdBy = :user')
            ->setParameter('user', $user)
            ->setParameter('val', $suitableInitiative)
            ->orderBy('ps.name', 'ASC')

            ->getQuery()

            ->getResult();
    }
    public function findDetailAccomplishSocial($suitableInitiative, $user, $social)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.taskUser', 'ts')
            ->leftJoin('ts.taskAssign', 'ta')
            ->leftJoin('ta.PerformerTask', 'ps')
            ->leftJoin('ps.PlanAcomplishment', 'pa')
            ->andWhere('pa.suitableInitiative = :val')
            ->andWhere('ps.createdBy = :user')
            ->andWhere('ps.social = :social')
            ->setParameter('user', $user)
            ->setParameter('val', $suitableInitiative)
            ->setParameter('social', $social)
            ->orderBy('ps.name', 'ASC')

            ->getQuery()

            ->getResult();
    }

    public function search($search = [])
    {
        //   $user=$this->getUser();
        $qb = $this->createQueryBuilder('taa')
            ->innerJoin('taa.taskUser', 'tu')
            ->innerJoin('tu.taskAssign', 'ta')
            ->innerJoin('ta.PerformerTask', 'p');

        if (isset($search['performerName'])) {
            $qb
                ->innerJoin('tu.assignedTo', 'u')
                ->innerJoin('u.userInfo', 'ui')
                   ->andWhere('ui.id = :performerName')
                ->setParameter('performerName', $search['performerName']);
        }
        //   if(isset($search['taskName']) && sizeof($search['taskName'])>0 ){
        //     $qb->andWhere('o.perspective in (:perspective)')
        //     ->setParameter('perspective',$search['perspective']);

        // }
        //  if(isset($search['operationalOffice']) && sizeof($search['operationalOffice'])>0 ){

        //     $qb 
        //      ->Join('i.keyPerformanceIndicator','k')
        //     ->Join('k.strategy','s')
        //     ->andWhere('s.objective in (:objective)')
        //     ->setParameter('objective',$search['objective']);

        // }
        //  if(isset($search['initiative']) && sizeof($search['initiative'])>0 ){

        //     $qb 
        //     ->Join('i.keyPerformanceIndicator','k')
        //     ->andWhere('k.strategy in (:strategy)')
        //     ->setParameter('strategy',$search['strategy']);

        // }
        //   if(isset($search['quarter']) && sizeof($search['quarter'])>0 ){
        //     $qb->andWhere('i.keyPerformanceIndicator in (:kpi)')
        //     ->setParameter('kpi',$search['kpi']);

        // }
        //  if(isset($search['planningYear']) && sizeof($search['planningYear'])>0 ){
        //     $qb
        //       ->leftJoin('i.principalOffice','p')
        //     ->andWhere('p.id in (:principalOffice)')
        //     ->setParameter('principalOffice',$search['principaloffice']);

        // }


        return $qb->orderBy('taa.id', 'ASC')->getQuery();
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
