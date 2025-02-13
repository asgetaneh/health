<?php

namespace App\Repository;

use App\Entity\UserInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserInfo[]    findAll()
 * @method UserInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserInfo::class);
    }
    public function filterUser()
    {
        $date = (new \DateTime())->format('y-m-d');

        //dd($productNmae);
        return $this->createQueryBuilder('s')


            ->Select('s.fullName')
        //    ->andWhere('s.serverTeam = 1')
           
            ->orderBy('s.id', 'ASC')
            ->getQuery()

            ->getResult();
    }
    public function filterDeliverBy()
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.user','u')

            ->Select('s.fullName')  
           
            ->addSelect('u.id')
            // ->andWhere('u.id = :val')
            // ->setParameter('val', $user)
            ->orderBy('s.id', 'ASC')
          
            ->getQuery()
            
            ->getResult();
    }
     public function filter($name)
    {
        return $this->createQueryBuilder('s')
           ->andWhere("s.fullName  LIKE '%".$name."%' ")
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
      public function findStatus($search=[])
    {
        return $this->createQueryBuilder('s')
        ->leftJoin('s.user','u')
           ->andWhere('u.status  = :status')
           ->setParameter('status',$search['status'])
            ->orderBy('s.id', 'ASC')
            ->getQuery();
    }
    

    // /**
    //  * @return UserInfo[] Returns an array of UserInfo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserInfo
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
