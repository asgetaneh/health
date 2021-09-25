<?php

namespace App\Repository;

use App\Entity\SmisSetting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SmisSetting|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmisSetting|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmisSetting[]    findAll()
 * @method SmisSetting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmisSettingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmisSetting::class);
    }

    // /**
    //  * @return SmisSetting[] Returns an array of SmisSetting objects
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
    public function findOneBySomeField($value): ?SmisSetting
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
