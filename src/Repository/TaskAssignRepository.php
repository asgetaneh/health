<?php

namespace App\Repository;

use App\Entity\TaskAssign;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskAssign|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskAssign|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskAssign[]    findAll()
 * @method TaskAssign[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskAssignRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskAssign::class);
    }

    // /**
    //  * @return TaskAssign[] Returns an array of TaskAssign objects
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
    public function findOneBySomeField($value): ?TaskAssign
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
