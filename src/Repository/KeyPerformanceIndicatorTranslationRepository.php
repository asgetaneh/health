<?php

namespace App\Repository;

use App\Entity\KeyPerformanceIndicatorTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KeyPerformanceIndicatorTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeyPerformanceIndicatorTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeyPerformanceIndicatorTranslation[]    findAll()
 * @method KeyPerformanceIndicatorTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyPerformanceIndicatorTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeyPerformanceIndicatorTranslation::class);
    }

    // /**
    //  * @return KeyPerformanceIndicatorTranslation[] Returns an array of KeyPerformanceIndicatorTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KeyPerformanceIndicatorTranslation
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
