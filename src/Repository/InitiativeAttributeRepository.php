<?php

namespace App\Repository;

use App\Entity\InitiativeAttribute;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeAttribute|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeAttribute|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeAttribute[]    findAll()
 * @method InitiativeAttribute[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeAttributeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeAttribute::class);
    }

    // /**
    //  * @return InitiativeAttribute[] Returns an array of InitiativeAttribute objects
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
    public function findOneBySomeField($value): ?InitiativeAttribute
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
