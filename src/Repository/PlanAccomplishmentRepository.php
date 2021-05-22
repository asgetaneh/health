<?php

namespace App\Repository;

use App\Entity\PlanAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanAccomplishment[]    findAll()
 * @method PlanAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanAccomplishment::class);
    }

    // /**
    //  * @return PlanAccomplishment[] Returns an array of PlanAccomplishment objects
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
    public function findOneBySomeField($value): ?PlanAccomplishment
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
