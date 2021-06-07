<?php
declare(strict_types=1);
namespace App\Repository;

use App\Entity\Strategy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @method Strategy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Strategy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Strategy[]    findAll()
 * @method Strategy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StrategyRepository extends ServiceEntityRepository
{
    use TranslatableTrait;
    
    public function __construct(ManagerRegistry $registry)
    {
        
        parent::__construct($registry, Strategy::class);
    }
    public function findAlls()
    {
        return $this->createQueryBuilder('g')
            
            ->getQuery();
        
    }

    // /**
    //  * @return Strategy[] Returns an array of Strategy objects
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
    public function findOneBySomeField($value): ?Strategy
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function search($search=[]){

        $qb=$this->createQueryBuilder('s')
       // ->select('s')
        ->join('s.objective','o')
        ;
        if(isset($search['goal']) && sizeof($search['goal'])>0){
            $qb->andWhere('o.goal in (:goal)')
            ->setParameter('goal',$search['goal']);

        }
          if(isset($search['perspective']) && sizeof($search['perspective'])>0 ){
            $qb->andWhere('o.perspective in (:perspective)')
            ->setParameter('perspective',$search['perspective']);
            
        }
         if(isset($search['objective']) && sizeof($search['objective'])>0 ){
            $qb->andWhere('s.objective in (:objective)')
            ->setParameter('objective',$search['objective']);
            
        }
        if(isset($search['name']) ){
            
           $qb
        
           ->join('s.translations','t')
            ->andWhere("t.name  LIKE '%" . $search['name']. "%' ");
        

            
        }

        return $qb->orderBy('s.id','ASC')->getQuery();
    }
}
