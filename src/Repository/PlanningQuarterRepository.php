<?php

namespace App\Repository;

use App\Entity\PlanningQuarter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningQuarter|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningQuarter|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningQuarter[]    findAll()
 * @method PlanningQuarter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningQuarterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningQuarter::class);
    }

    // /**
    //  * @return PlanningQuarter[] Returns an array of PlanningQuarter objects
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
    public function findOneBySomeField($value): ?PlanningQuarter
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
