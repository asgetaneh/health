<?php

namespace App\Repository;

use App\Entity\InitiativeTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeTranslation[]    findAll()
 * @method InitiativeTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeTranslation::class);
    }

    // /**
    //  * @return InitiativeTranslation[] Returns an array of InitiativeTranslation objects
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
    public function findOneBySomeField($value): ?InitiativeTranslation
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
