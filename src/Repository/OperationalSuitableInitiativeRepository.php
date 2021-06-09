<?php

namespace App\Repository;

use App\Entity\OperationalSuitableInitiative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalSuitableInitiative|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalSuitableInitiative|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalSuitableInitiative[]    findAll()
 * @method OperationalSuitableInitiative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalSuitableInitiativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalSuitableInitiative::class);
    }

    // /**
    //  * @return OperationalSuitableInitiative[] Returns an array of OperationalSuitableInitiative objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationalSuitableInitiative
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
