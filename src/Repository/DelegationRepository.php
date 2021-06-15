<?php

namespace App\Repository;

use App\Entity\Delegation;
use DateTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Delegation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Delegation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Delegation[]    findAll()
 * @method Delegation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DelegationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Delegation::class);
    }

    // /**
    //  * @return Delegation[] Returns an array of Delegation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Delegation
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAlls(){
        $qb=$this->createQueryBuilder('d');
        return $qb->getQuery();

    }
    public function findDelegationUser($user){
         $qb=$this->createQueryBuilder('d');
         $now =new DateTime('now');
         $qb->andWhere('d.endAt >:now and (d.status is null or d.status = 0 )')
         ->andWhere('d.delegatedUser=:owner')
         ->setParameter('owner',$user)
         ->setParameter('now',$now);
     return $qb->orderBy('d.id','DESC')->getQuery()->getResult();

    }
    public function findDuplication($owner,$delegate){
        $qb=$this->createQueryBuilder('d');
        $now =new DateTime('now');
        $qb->andWhere('d.endAt< :now')
        ->andWhere('d.delegatedBy=:owner')
        ->orWhere('d.delegatedUser=:delegate')
        ->setParameter('owner',$owner)
        ->setParameter('delegate',$delegate)
        ->setParameter('now',$now);
     return $qb->getQuery()->getResult();

    }
     public function findByUser($user){
        $qb=$this->createQueryBuilder('d');
        $now =new DateTime('now');
        $qb->andWhere('d.endAt >:now and (d.status is null or d.status = 0 )')
        ->andWhere('d.delegatedBy=:owner')
        ->setParameter('owner',$user)

        ->setParameter('now',$now);
     return $qb->orderBy('d.id','DESC')->getQuery()->getResult();

    }
}
