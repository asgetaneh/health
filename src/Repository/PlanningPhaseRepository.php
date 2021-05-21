<?php

namespace App\Repository;

use App\Entity\PlanningPhase;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningPhase|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningPhase|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningPhase[]    findAll()
 * @method PlanningPhase[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningPhaseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningPhase::class);
    }

    // /**
    //  * @return PlanningPhase[] Returns an array of PlanningPhase objects
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
    public function findOneBySomeField($value): ?PlanningPhase
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
