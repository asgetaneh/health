<?php

namespace App\Repository;

use App\Entity\TaskUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TaskUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskUser[]    findAll()
 * @method TaskUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskUser::class);
    }
      public function findPerformerTaskUsers($value)
    {
        return $this->createQueryBuilder('t')
        ->leftJoin('t.taskAssign','ta')
        // ->leftJoin('ta.performerTask','p')
            ->andWhere('t.assignedTo = :val')
            ->andWhere('t.status < 5  ')
            ->setParameter('val', $value)
        //  ->setParameter('status', 5)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
      public function findPerformerTask($value)
    {
        return $this->createQueryBuilder('t')
        ->leftJoin('t.taskAssign','ta')
        // ->leftJoin('ta.performerTask','p')
            ->andWhere('ta.assignedBy = :val')
            ->andWhere('t.status = 5  ')
            ->setParameter('val', $value)
        //  ->setParameter('status', 5)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     public function findTaskUsers($value)
    {
        return $this->createQueryBuilder('t')
        ->leftJoin('t.taskAssign','ta')
         ->leftJoin('ta.PerformerTask','p')
            ->andWhere('p.createdBy = :val')
        //  ->andWhere('t.type = 1 or t.type = 2 ')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
     public function findTaskUsersList($value)
    {
        return $this->createQueryBuilder('t')
        ->leftJoin('t.taskAssign','ta')
         ->leftJoin('ta.PerformerTask','p')
            ->andWhere('p.createdBy = :val')
        ->andWhere('t.type < 3 ')
                ->andWhere('t.status > 4 ')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            // ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    
    

    // /**
    //  * @return TaskUser[] Returns an array of TaskUser objects
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
    public function findOneBySomeField($value): ?TaskUser
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
