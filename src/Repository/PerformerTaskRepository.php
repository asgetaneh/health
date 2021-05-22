<?php

namespace App\Repository;

use App\Entity\PerformerTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PerformerTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerformerTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerformerTask[]    findAll()
 * @method PerformerTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformerTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformerTask::class);
    }

    // /**
    //  * @return PerformerTask[] Returns an array of PerformerTask objects
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
    public function findOneBySomeField($value): ?PerformerTask
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
