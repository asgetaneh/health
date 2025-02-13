<?php

namespace App\Repository;

use App\Entity\PrincipalManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrincipalManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrincipalManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrincipalManager[]    findAll()
 * @method PrincipalManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipalManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrincipalManager::class);
    }

    // /**
    //  * @return PrincipalManager[] Returns an array of PrincipalManager objects
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
    public function findOneBySomeField($value): ?PrincipalManager
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findActive($principaloffice,$principal=null){
        $qb=$this->createQueryBuilder('pm');
        if ($principal) {
             $qb->andWhere('pm.principalOffice = :po')
             ->andwhere('pm.principal = :principal')
            
             ->setParameter('principal',$principal)
             ->setParameter('po',$principaloffice);
        }
        else{
             $qb->andWhere('pm.principalOffice = :po')
             ->andwhere('pm.isActive = true')
             ->setParameter('po',$principaloffice);
        }
        return $qb->getQuery()->getResult();
      
    }
     public function search($search = [])
    {
        $qb = $this->createQueryBuilder('p');
        if (isset($search['name'])) {

            $qb
                ->join('p.principal', 'pr')
                ->join('pr.userInfo', 'ui')

                ->andWhere("ui.fullName  LIKE '%" . $search['name'] . "%' ");
        }
        if (isset($search['principaloffice']) && sizeof($search['principaloffice']) > 0) {


            $qb

                ->andWhere("p.principalOffice in(:po)")
                ->setParameter('po', $search['principaloffice']);
        }
       
        return $qb->getQuery();
    }
}
