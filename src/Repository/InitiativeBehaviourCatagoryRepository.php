<?php

namespace App\Repository;

use App\Entity\InitiativeBehaviourCatagory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeBehaviourCatagory|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeBehaviourCatagory|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeBehaviourCatagory[]    findAll()
 * @method InitiativeBehaviourCatagory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeBehaviourCatagoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeBehaviourCatagory::class);
    }

    // /**
    //  * @return InitiativeBehaviourCatagory[] Returns an array of InitiativeBehaviourCatagory objects
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
    public function findOneBySomeField($value): ?InitiativeBehaviourCatagory
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
