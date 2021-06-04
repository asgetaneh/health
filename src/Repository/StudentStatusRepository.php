<?php

namespace App\Repository;

use App\Entity\StudentStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StudentStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentStatus[]    findAll()
 * @method StudentStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentStatus::class);
    }

    // /**
    //  * @return StudentStatus[] Returns an array of StudentStatus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?StudentStatus
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
