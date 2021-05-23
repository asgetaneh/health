<?php

namespace App\Repository;

use App\Entity\OperationalManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalManager[]    findAll()
 * @method OperationalManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalManager::class);
    }
    
    public function findAllsUser($user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.operationalOffice','u')

            ->Select('s.fullName')  
           
            ->addSelect('u.id')
            ->andWhere('u.id = :val')
            ->setParameter('val', $user)
            ->orderBy('s.id', 'ASC')
          
            ->getQuery()
            
            ->getResult();
    }
    // /**
    //  * @return OperationalManager[] Returns an array of OperationalManager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationalManager
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
