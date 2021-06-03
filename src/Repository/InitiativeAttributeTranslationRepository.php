<?php

namespace App\Repository;

use App\Entity\InitiativeAttributeTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeAttributeTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeAttributeTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeAttributeTranslation[]    findAll()
 * @method InitiativeAttributeTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeAttributeTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeAttributeTranslation::class);
    }

    // /**
    //  * @return InitiativeAttributeTranslation[] Returns an array of InitiativeAttributeTranslation objects
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
    public function findOneBySomeField($value): ?InitiativeAttributeTranslation
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
