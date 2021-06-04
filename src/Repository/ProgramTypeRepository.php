<?php

namespace App\Repository;

use App\Entity\ProgramType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgramType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramType[]    findAll()
 * @method ProgramType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramType::class);
    }

    // /**
    //  * @return ProgramType[] Returns an array of ProgramType objects
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
    public function findOneBySomeField($value): ?ProgramType
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
