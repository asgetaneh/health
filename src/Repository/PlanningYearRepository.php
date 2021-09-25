<?php

namespace App\Repository;

use App\Entity\PlanningYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningYear[]    findAll()
 * @method PlanningYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningYear::class);
    }

    // /**
    //  * @return PlanningYear[] Returns an array of PlanningYear objects
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
    public function findOneBySomeField($value): ?PlanningYear
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function findLast()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.id',"DESC")
            ->setMaxResults(1)
            ->getQuery()
              ->getOneOrNullResult()
            // ->getSingleResult()
        ;
    }

}
