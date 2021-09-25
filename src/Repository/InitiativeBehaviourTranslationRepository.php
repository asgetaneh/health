<?php

namespace App\Repository;

use App\Entity\InitiativeBehaviourTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeBehaviourTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeBehaviourTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeBehaviourTranslation[]    findAll()
 * @method InitiativeBehaviourTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeBehaviourTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeBehaviourTranslation::class);
    }

    // /**
    //  * @return InitiativeBehaviourTranslation[] Returns an array of InitiativeBehaviourTranslation objects
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
    public function findOneBySomeField($value): ?InitiativeBehaviourTranslation
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
