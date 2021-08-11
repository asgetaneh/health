<?php

namespace App\Repository;

use App\Entity\InitiativeCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeCategory[]    findAll()
 * @method InitiativeCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeCategory::class);
    }

    // /**
    //  * @return InitiativeCategory[] Returns an array of InitiativeCategory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InitiativeCategory
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
