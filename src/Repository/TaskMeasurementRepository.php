<?php

namespace App\Repository;

use App\Entity\TaskMeasurement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskMeasurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskMeasurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskMeasurement[]    findAll()
 * @method TaskMeasurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskMeasurementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskMeasurement::class);
    }

    // /**
    //  * @return TaskMeasurement[] Returns an array of TaskMeasurement objects
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
    public function findOneBySomeField($value): ?TaskMeasurement
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
