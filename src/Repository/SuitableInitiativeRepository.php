<?php

namespace App\Repository;

use App\Entity\SuitableInitiative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuitableInitiative|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuitableInitiative|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuitableInitiative[]    findAll()
 * @method SuitableInitiative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuitableInitiativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuitableInitiative::class);
    }

    // /**
    //  * @return SuitableInitiative[] Returns an array of SuitableInitiative objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SuitableInitiative
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findDuplication($principaloffice,$initiative,$planyear){
        $qb=$this->createQueryBuilder('s');
        $qb->andwhere('s.principalOffice = :office')
        ->andwhere('s.initiative = :initiative')
        ->andwhere('s.planningYear = :planyear')
        ->setParameter('planyear',$planyear)
        ->setParameter('office',$principaloffice)
        ->setParameter('initiative',$initiative);
        return $qb->getQuery()->getResult();

    }
    public function findByoffice($principaloffice,$planyear){
        $qb=$this->createQueryBuilder('s')
        ->andWhere('s.principalOffice = :office')
         ->andwhere('s.planningYear = :planyear')
        ->setParameter('planyear',$planyear)
        ->setParameter('office',$principaloffice);
        return $qb->getQuery()->getResult();
    }
}
