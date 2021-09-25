<?php

namespace App\Repository;

use App\Entity\Disablity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Disablity|null find($id, $lockMode = null, $lockVersion = null)
 * @method Disablity|null findOneBy(array $criteria, array $orderBy = null)
 * @method Disablity[]    findAll()
 * @method Disablity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DisablityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Disablity::class);
    }

    // /**
    //  * @return Disablity[] Returns an array of Disablity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Disablity
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
