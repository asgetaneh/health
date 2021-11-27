<?php

namespace App\Repository;

use App\Entity\InistuitionSuitableInitiative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InistuitionSuitableInitiative|null find($id, $lockMode = null, $lockVersion = null)
 * @method InistuitionSuitableInitiative|null findOneBy(array $criteria, array $orderBy = null)
 * @method InistuitionSuitableInitiative[]    findAll()
 * @method InistuitionSuitableInitiative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InistuitionSuitableInitiativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InistuitionSuitableInitiative::class);
    }

    // /**
    //  * @return InistuitionSuitableInitiative[] Returns an array of InistuitionSuitableInitiative objects
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
    public function findOneBySomeField($value): ?InistuitionSuitableInitiative
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function getByInitiativeAndYear($initiative,$year,$organization)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.initiative = :init')
            ->andWhere('i.year = :year')
            ->andWhere('i.inistuition= :org')
            ->setParameter('init', $initiative)
            ->setParameter('year', $year)
              ->setParameter('org', $organization)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
