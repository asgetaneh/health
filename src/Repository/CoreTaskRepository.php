<?php

namespace App\Repository;

use App\Entity\CoreTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CoreTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method CoreTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method CoreTask[]    findAll()
 * @method CoreTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoreTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CoreTask::class);
    }

    // /**
    //  * @return CoreTask[] Returns an array of CoreTask objects
    //  */
    
    public function findAllTasks()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?CoreTask
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
