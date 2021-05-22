<?php

namespace App\Repository;

use App\Entity\KeyPerformanceIndicator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method KeyPerformanceIndicator|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeyPerformanceIndicator|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeyPerformanceIndicator[]    findAll()
 * @method KeyPerformanceIndicator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyPerformanceIndicatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeyPerformanceIndicator::class);
    }
    public function findAlls()
    {
        return $this->createQueryBuilder('g')
            
            ->getQuery();
        
    }

    // /**
    //  * @return KeyPerformanceIndicator[] Returns an array of KeyPerformanceIndicator objects
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
    public function findOneBySomeField($value): ?KeyPerformanceIndicator
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
