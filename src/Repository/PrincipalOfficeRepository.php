<?php

namespace App\Repository;

use App\Entity\PrincipalOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrincipalOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrincipalOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrincipalOffice[]    findAll()
 * @method PrincipalOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipalOfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrincipalOffice::class);
    }

    // /**
    //  * @return PrincipalOffice[] Returns an array of PrincipalOffice objects
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
    public function findOneBySomeField($value): ?PrincipalOffice
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOfficeByUser($user){
        $qb=$this->createQueryBuilder('po')
        ->join('po.principalManagers','pm')
        ->andWhere('pm.principal = :user')
        ->andwhere('pm.isActive = 1')
        ->setParameter('user',$user)
        ;
        return $qb->getQuery()->getResult();

    }
}
