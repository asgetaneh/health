<?php

namespace App\Repository;

use App\Entity\OperationalPlanningAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalPlanningAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalPlanningAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalPlanningAccomplishment[]    findAll()
 * @method OperationalPlanningAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalPlanningAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalPlanningAccomplishment::class);
    }
     public function findplanAccwithoutSocial($operationalSuitable, $operational, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
            ->leftJoin('pa.operationalSuitable', 'si')
            ->andwhere('pa.operationalSuitable = :suitin')
            ->andwhere('si.operationalOffice = :operational')
            ->andwhere('pa.quarter = :quarter')
            ->setParameter('suitin', $operationalSuitable)
            ->setParameter('quarter', $quarter)

            ->setParameter('operational', $operational);

        return $qb->getQuery()->getResult();
    }
     public function findByQuarter( $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
          
            ->andwhere('pa.quarter = :quarter')
           
            ->setParameter('quarter', $quarter);


        return $qb->getQuery()->getResult();
    }
    
public function getOperationalCascading($principalOffice)
    {
        // dd($principalOffice);

        return $this->createQueryBuilder('s')
        ->leftJoin('s.operationalSuitable','os')
        ->leftJoin('os.suitableInitiative','si')
                       ->select('count(os.id)')
            ->andWhere('si.principalOffice =  :office')

            ->setParameter('office', $principalOffice)

            ->getQuery()->getSingleScalarResult();
    }
     public function findDuplication($operationalSuitable, $attrib = null, $quarter)
    {
        $qb = $this->createQueryBuilder('pa');
        $qb
            ->andWhere('pa.operationalSuitable = :plan')
            ->andWhere('pa.quarter = :quarter')
            ->setParameter('plan', $operationalSuitable)
            ->setParameter('quarter', $quarter);
        if ($attrib) {
            $qb->andWhere('pa.socialAttribute = :attrib')


                ->setParameter('attrib', $attrib);
        }


        return $qb->getQuery()->getOneOrNullResult();
    }
     public function calculateQuartertPlan($operationalSuitable)
    {
        $qb = $this->createQueryBuilder('pa');
        $qb
            ->select('sum(pa.planValue) ')
            ->join('pa.operationalSuitable' ,'os')
            ->andWhere('os.suitableInitiative = :si')
            ->setParameter('si', $operationalSuitable)
            // ->setParameter('quarter', $quarter)
            ;
        // if ($attrib) {
        //     $qb->andWhere('pa.socialAttribute = :attrib')


        //         ->setParameter('attrib', $attrib);
        // }


        return $qb->GroupBy('pa.quarter')->orderBy('pa.quarter','ASC')->getQuery()->getArrayResult();
    }
     public function calculateSocialAttrQuartertPlan($operationalSuitable,$socialAttribute)
    {
        $qb = $this->createQueryBuilder('pa');
        $qb
            ->select('sum(pa.planValue) ')
            ->join('pa.operationalSuitable' ,'os')
            ->andWhere('os.suitableInitiative = :si')
            ->setParameter('si', $operationalSuitable)
            ->andWhere('pa.socialAttribute = :attrib')
            ->setParameter('attrib', $socialAttribute);
           


        return $qb->groupBy('pa.socialAttribute')->addGroupBy('pa.quarter')->orderBy('pa.quarter','ASC')->getQuery()->getArrayResult();
    }
     public function findYearlyPlan($suitable, $social=null,$type,$operationaloffice)
    {
       
        $qb = $this->createQueryBuilder('pa')
           ->join('pa.operationalSuitable' ,'os');
           
        if($type== 0 || $type == 2){
            $qb->select('max(pa.planValue)');
        }
        elseif ($type == 1 ) {
           $qb->select('sum(pa.planValue)');
        }
         elseif ($type == 3 )

        $qb->select('min(pa.planValue)');

        $qb->andwhere('os.suitableInitiative = :suitin')
        ->andWhere('os.operationalOffice= :office')
         ->setParameter('office', $operationaloffice)
           
            ->setParameter('suitin', $suitable);
        if($social){
            $qb
             ->andwhere('pa.socialAttribute = :name')
             ->setParameter('name', $social);
        }


           
            
            ;
            // dd($qb->groupBy('pa.suitableInitiative')->getQuery()->getSingleScalarResult());

        return $qb->getQuery()->getSingleScalarResult();
    }
     public function findYearlyPlanAccomp($suitable, $social=null,$type,$operationaloffice)
    {
       
         $qb = $this->createQueryBuilder('pa')
           ->join('pa.operationalSuitable' ,'os');
        if($type== 0 ){
            $qb->select('Avg(pa.accompValue)');
        }
         elseif ($type == 2 ) {
           $qb->select('max(pa.accompValue)');
         }
        


        elseif ($type == 1 ) {
           $qb->select('sum(pa.accompValue)');
        }
         elseif ($type == 3 )

        $qb->select('min(pa.accompValue)');

         $qb->andwhere('os.suitableInitiative = :suitin')
        ->andWhere('os.operationalOffice= :office')
         ->setParameter('office', $operationaloffice)
           
            ->setParameter('suitin', $suitable);
        if($social){
            $qb
             ->andwhere('pa.socialAttribute = :name')
             ->setParameter('name', $social);
        }


           
            
            ;
            // dd($qb->groupBy('pa.suitableInitiative')->getQuery()->getSingleScalarResult());

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function findQuarterPlan($suitable, $social=null,$quarter,$operationaloffice)
    {
       
        $qb = $this->createQueryBuilder('pa')
           ->join('pa.operationalSuitable' ,'os');
       
 
           
         
        $qb->select('pa.planValue as plan')
        ->join('pa.quarter','q')
        ->andWhere('q.slug = :slg')
        ->andwhere('os.suitableInitiative = :suitin')
        ->andWhere('os.operationalOffice= :office')
         ->setParameter('office', $operationaloffice)
           
            ->setParameter('suitin', $suitable)
             ->setParameter('slg', $quarter);
        

     
        if($social){
            $qb
             ->andwhere('pa.socialAttribute = :name')
             ->setParameter('name', $social);
        }


           
            
            ;
            //  dd($qb->getQuery()->getSingleScalarOrNullResult());
             $result=$qb->getQuery()->getOneOrNullResult();
            
             return $result? $result['plan']:null;


       
    }
      public function findQuarterPlanAccomp($suitable, $social=null,$quarter,$operationaloffice)
    {
       
        $qb = $this->createQueryBuilder('pa')
           ->join('pa.operationalSuitable' ,'os');
       
 
           
         
        $qb->select('pa.accompValue as acomp')
        ->join('pa.quarter','q')
        ->andWhere('q.slug = :slg')
        ->andwhere('os.suitableInitiative = :suitin')
        ->andWhere('os.operationalOffice= :office')
         ->setParameter('office', $operationaloffice)
           
            ->setParameter('suitin', $suitable)
             ->setParameter('slg', $quarter);
    
        if($social){
            $qb
             ->andwhere('pa.socialAttribute = :name')
             ->setParameter('name', $social);
        } ;
            //  dd($qb->getQuery()->getSingleScalarOrNullResult());
             $result=$qb->getQuery()->getOneOrNullResult();
            
             return $result? $result['acomp']:null;
    }
    public function findByPrincipal($principalOffice)
    {
        return $this->createQueryBuilder('pa')
          ->leftJoin('pa.operationalSuitable','op')
             ->leftJoin('op.suitableInitiative','su')
              ->andWhere('su.principalOffice = :principalOffice')
              ->setParameter('principalOffice', $principalOffice)
            ->orderBy('pa.id', 'ASC')
            ->getQuery()
            
            ->getResult();
    }
}
