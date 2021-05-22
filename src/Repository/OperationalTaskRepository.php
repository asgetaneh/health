<?php

namespace App\Repository;

use App\Entity\OperationalTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalTask[]    findAll()
 * @method OperationalTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalTask::class);
    }

    // /**
    //  * @return OperationalTask[] Returns an array of OperationalTask objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationalTask
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
