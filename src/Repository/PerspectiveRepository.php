<?php

namespace App\Repository;

use App\Entity\Perspective;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Perspective|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perspective|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perspective[]    findAll()
 * @method Perspective[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerspectiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perspective::class);
    }

    // /**
    //  * @return Perspective[] Returns an array of Perspective objects
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
    public function findOneBySomeField($value): ?Perspective
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
