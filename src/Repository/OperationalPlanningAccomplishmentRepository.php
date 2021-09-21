<?php

namespace App\Repository;

use App\Entity\OperationalPlanningAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalPlanningAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalPlanningAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalPlanningAccomplishment[]    findAll()
 * @method OperationalPlanningAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalPlanningAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalPlanningAccomplishment::class);
    }

    // /**
    //  * @return OperationalPlanningAccomplishment[] Returns an array of OperationalPlanningAccomplishment objects
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
    public function findOneBySomeField($value): ?OperationalPlanningAccomplishment
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
