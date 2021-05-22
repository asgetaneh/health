<?php

namespace App\Repository;

use App\Entity\InitiativeBehaviour;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InitiativeBehaviour|null find($id, $lockMode = null, $lockVersion = null)
 * @method InitiativeBehaviour|null findOneBy(array $criteria, array $orderBy = null)
 * @method InitiativeBehaviour[]    findAll()
 * @method InitiativeBehaviour[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeBehaviourRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InitiativeBehaviour::class);
    }

    // /**
    //  * @return InitiativeBehaviour[] Returns an array of InitiativeBehaviour objects
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
    public function findOneBySomeField($value): ?InitiativeBehaviour
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
