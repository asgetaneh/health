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
    public function findAllsUser($user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.operationalOffices','oo')
          ->leftJoin('oo.operationalManagers','om')
          ->leftJoin('om.manager','u')
         ->leftJoin('u.userInfo','ui')
            ->Select('ui.fullName')  
           
            ->addSelect('u.id')
            ->andWhere('s.id = :val')
            ->setParameter('val', $user)
            ->orderBy('s.id', 'ASC')
          
            ->getQuery()
            
            ->getResult();
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
    public function findOfficeByUser($user,$delegationuser=[]){
        $qb=$this->createQueryBuilder('po')
        ->join('po.principalManagers','pm')
        ->andWhere('pm.principal = :user or pm.principal in (:delegate)')
        ->andwhere('pm.isActive = 1')
        ->setParameter('user',$user)
        ->setParameter('delegate',$delegationuser)
        ;
      
        return $qb->getQuery()->getResult();

    }
    public function findPlannedOffice($year){
        $qb=$this->createQueryBuilder('p')
        // ->select('p')
        ->addSelect('s')
        ->leftJoin('p.suitableInitiatives','s')
        // ->orWhere('s.planningYear= :year')
        // ->setParameter('year',$year)
        
        ;
      
        return $qb->getQuery();

    }
    
     public function findPrincipalOffice($user){
        $qb=$this->createQueryBuilder('po')
        ->leftJoin('po.principalManagers','pm')
        ->leftJoin('po.operationalOffices','of')
        ->leftJoin('of.operationalManagers','om')
        ->leftJoin('of.performers','pr')

        ->orWhere('pm.principal = :user and pm.isActive = 1')
       ->orWhere('om.manager = :manager and om.isActive = 1')
       ->orWhere('pr.id = :performer and pr.isActive = 1')
        ->setParameter('user',$user)
         ->setParameter('manager',$user)
          ->setParameter('performer',$user->getId())
        ;
        return $qb->getQuery()->getResult();

    }
}
