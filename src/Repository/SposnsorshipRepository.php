<?php

namespace App\Repository;

use App\Entity\Sposnsorship;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sposnsorship|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sposnsorship|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sposnsorship[]    findAll()
 * @method Sposnsorship[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SposnsorshipRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sposnsorship::class);
    }

    // /**
    //  * @return Sposnsorship[] Returns an array of Sposnsorship objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sposnsorship
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
