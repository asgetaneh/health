<?php

namespace App\Repository;

use App\Entity\PerspectiveTranslation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PerspectiveTranslation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerspectiveTranslation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerspectiveTranslation[]    findAll()
 * @method PerspectiveTranslation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerspectiveTranslationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerspectiveTranslation::class);
    }

    // /**
    //  * @return PerspectiveTranslation[] Returns an array of PerspectiveTranslation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PerspectiveTranslation
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
