<?php

namespace App\Repository;

use App\Entity\InitiativeMeasurement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeMeasurement|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeMeasurement|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeMeasurement[]    findAll()
 * @method InitiativeMeasurement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeMeasurementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeMeasurement::class);
    }

    // /**
    //  * @return InitiativeMeasurement[] Returns an array of InitiativeMeasurement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InitiativeMeasurement
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
