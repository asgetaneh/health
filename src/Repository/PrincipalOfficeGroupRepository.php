<?php

namespace App\Repository;

use App\Entity\PrincipalOfficeGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrincipalOfficeGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrincipalOfficeGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrincipalOfficeGroup[]    findAll()
 * @method PrincipalOfficeGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipalOfficeGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrincipalOfficeGroup::class);
    }

    // /**
    //  * @return PrincipalOfficeGroup[] Returns an array of PrincipalOfficeGroup objects
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
    public function findOneBySomeField($value): ?PrincipalOfficeGroup
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
