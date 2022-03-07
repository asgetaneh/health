<?php

namespace App\Repository;

use App\Entity\Evaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evaluation[]    findAll()
 * @method Evaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvaluationRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, Evaluation::class);
  }

  public function findEvaluationTasks($user, $quarter, $year)
  {

    return $this->createQueryBuilder('s')->leftJoin('s.taskAccomplishment', 'taa')->leftJoin('taa.taskUser', 'ts')
      ->leftJoin('ts.taskAssign', 'ta')
      ->leftJoin('ta.PerformerTask', 'ps')
      ->leftJoin('ps.PlanAcomplishment', 'pa')
      ->leftJoin('pa.suitableInitiative', 'su')
      ->Select('count(s.evaluateUser) as countTask')
      ->addSelect('sum(s.quantity) as totalQuanity')
      ->addSelect('sum(s.time) as totalTime')
      ->addSelect('sum(s.quality) as totalQuality')
      ->addSelect('sum(s.behavior) as totalBehavior')
      ->addSelect('sum(s.selfEvaluation) as totalSelfEvaluation')
      ->andWhere('ps.quarter = :quarter')
      ->andWhere('su.planningYear = :year')
      ->andWhere('s.evaluateUser = :user')
      ->setParameter('quarter', $quarter)
      ->setParameter('year', $year)
      ->setParameter('user', $user)
      ->orderBy('ps.name', 'ASC')

      ->getQuery()

      ->getResult();
  }
  public function findEvaluatinCriteia($user, $quarter, $year)
  {

    return $this->createQueryBuilder('s')->leftJoin('s.taskAccomplishment', 'taa')->leftJoin('taa.taskUser', 'ts')
      ->leftJoin('ts.taskAssign', 'ta')
      ->leftJoin('ta.PerformerTask', 'ps')
      ->leftJoin('ps.PlanAcomplishment', 'pa')
      ->leftJoin('pa.suitableInitiative', 'su')
      ->andWhere('ps.quarter = :quarter')
      ->andWhere('su.planningYear = :year')
      ->andWhere('s.evaluateUser = :user')
      ->setParameter('quarter', $quarter)
      ->setParameter('year', $year)
      ->setParameter('user', $user)
      ->orderBy('ps.name', 'ASC')

      ->getQuery()

      ->getResult();
  }
  public function findByPrincipal($principalOffice, $quarter)
  {

    return $this->createQueryBuilder('e')->leftJoin('e.taskAccomplishment', 'ts')
      ->leftJoin('ts.taskAssign', 'ta')
      ->leftJoin('ta.PerformerTask', 'ps')
      ->leftJoin('ps.operationalPlanningAcc', 'pa')
      ->leftJoin('pa.operationalSuitable', 'op')
      ->leftJoin('op.suitableInitiative', 'su')
      ->andWhere('su.principalOffice = :principalOffice')
      ->andWhere('ps.quarter = :quarter')
      ->setParameter('quarter', $quarter)
      ->setParameter('principalOffice', $principalOffice)
      ->orderBy('e.id', 'ASC')

      ->getQuery()

      ->getResult();
  }



  // /**
  //  * @return Evaluation[] Returns an array of Evaluation objects
  //  */
  /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

  /*
    public function findOneBySomeField($value): ?Evaluation
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
