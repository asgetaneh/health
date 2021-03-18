<?php

namespace App\Repository;

use App\Entity\Vichels;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vichels|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vichels|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vichels[]    findAll()
 * @method Vichels[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VichelsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vichels::class);
    }

    // /**
    //  * @return Vichels[] Returns an array of Vichels objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vichels
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
