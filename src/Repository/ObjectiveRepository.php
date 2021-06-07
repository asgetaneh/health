<?php

namespace App\Repository;

use App\Entity\Objective;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Objective|null find($id, $lockMode = null, $lockVersion = null)
 * @method Objective|null findOneBy(array $criteria, array $orderBy = null)
 * @method Objective[]    findAll()
 * @method Objective[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ObjectiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Objective::class);
    }

    public function findAlls()
    {
        return $this->createQueryBuilder('g')
            
            ->getQuery();
        
    }
    // /**
    //  * @return Objective[] Returns an array of Objective objects
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
    public function findOneBySomeField($value): ?Objective
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function search($search=[]){

        $qb=$this->createQueryBuilder('o');
        if(isset($search['goal']) && sizeof($search['goal'])>0){
            $qb->andWhere('o.goal in (:goal)')
            ->setParameter('goal',$search['goal']);

        }
          if(isset($search['perspective']) && sizeof($search['perspective'])>0 ){
            $qb->andWhere('o.perspective in (:perspective)')
            ->setParameter('perspective',$search['perspective']);
            
        }
        if(isset($search['name']) ){
           
            $qb
            ->join('o.translations','t')
            ->andWhere("t.name  LIKE '%" . $search['name']. "%' or t.outCome  LIKE '%" . $search['name'] . "%'  or t.outPut  LIKE '%" . $search['name']. "%' ");
        

            
        }

        return $qb->orderBy('o.id','ASC')->getQuery();
    }
}
