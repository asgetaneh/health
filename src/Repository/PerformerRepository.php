<?php

namespace App\Repository;

use App\Entity\Performer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Performer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Performer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Performer[]    findAll()
 * @method Performer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Performer::class);
    }
public function findAllsUser($user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.operationalOffice','oo')
          ->leftJoin('oo.principalOffice','po')
         ->leftJoin('s.performer','u')
         ->leftJoin('u.userInfo','ui')

            ->Select('ui.fullName')  
           
            ->addSelect('u.id')
            ->andWhere('po.id = :val')
            ->setParameter('val', $user)
            ->orderBy('s.id', 'ASC')
          
            ->getQuery()
            
            ->getResult();
    }
    // /**
    //  * @return Performer[] Returns an array of Performer objects
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
    public function findOneBySomeField($value): ?Performer
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
