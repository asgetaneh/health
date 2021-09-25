<?php

namespace App\Repository;

use App\Entity\GoalTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GoalTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoalTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoalTranslation[]    findAll()
 * @method GoalTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GoalTranslation::class);
    }

    // /**
    //  * @return GoalTranslation[] Returns an array of GoalTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GoalTranslation
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
