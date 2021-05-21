<?php

namespace App\Repository;

use App\Entity\PrincipalManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrincipalManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrincipalManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrincipalManager[]    findAll()
 * @method PrincipalManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipalManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrincipalManager::class);
    }

    // /**
    //  * @return PrincipalManager[] Returns an array of PrincipalManager objects
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
    public function findOneBySomeField($value): ?PrincipalManager
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
