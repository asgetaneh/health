<?php

namespace App\Repository;

use App\Entity\PlanningAccomplishment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanningAccomplishment|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanningAccomplishment|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanningAccomplishment[]    findAll()
 * @method PlanningAccomplishment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanningAccomplishmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanningAccomplishment::class);
    }

    // /**
    //  * @return PlanningAccomplishment[] Returns an array of PlanningAccomplishment objects
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
    public function findOneBySomeField($value): ?PlanningAccomplishment
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findPrincipal($search,  $quarterId)
    {
        $qb = $this->createQueryBuilder('pa');


        $qb
            ->leftJoin('pa.suitableInitiative', 's')
            ->andWhere('s.principalOffice = :principalOffice')
            ->andWhere('pa.quarter = :quarter')
            ->setParameter('quarter', $quarterId)

            ->setParameter('principalOffice', $search);




        return $qb->getQuery()->getResult();
    }
    public function findPrincipalReports($search = [], $quarterId)
    {
        $qb = $this->createQueryBuilder('pa');
        if (isset($search['principalOffice'])) {


            $qb
                ->leftJoin('pa.suitableInitiative', 's')
                ->andWhere('s.principalOffice = :principalOffice')

                ->setParameter('principalOffice', $search['principalOffice']);
        }
        if (isset($search['planningQuarter'])) {


            $qb
                ->andWhere('pa.quarter = :planningQuarter')

                ->setParameter('planningQuarter', $search['planningQuarter']);
        }
        if (isset($search['planningYear'])) {


            $qb
                ->leftJoin('pa.suitableInitiative', 'p')
                ->andWhere('p.planningYear = :planningYear')

                ->setParameter('planningYear', $search['planningYear']);
        }



        return $qb->getQuery();
    }

    public function findDuplication($suitableinitiative, $attrib = null, $quarter)
    {
        $qb = $this->createQueryBuilder('pa');
        $qb
            ->andWhere('pa.suitableInitiative = :plan')
            ->andWhere('pa.quarter = :quarter')
            ->setParameter('plan', $suitableinitiative)
            ->setParameter('quarter', $quarter);
        if ($attrib) {
            $qb->andWhere('pa.socialAttribute = :attrib')


                ->setParameter('attrib', $attrib);
        }


        return $qb->getQuery()->getOneOrNullResult();
    }


    public function findBySuitable($suitable)
    {
        $qb = $this->createQueryBuilder('pa');
        $qb
            ->andwhere('pa.suitableInitiative =:suitin')
            ->setParameter('suitin', $suitable);
        return $qb->getQuery()->getResult();
    }
    public function findplanAccomp($suitable, $social)
    {
        $qb = $this->createQueryBuilder('pa')
            ->leftjoin('pa.socialAttribute', 'sa')
            ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('sa.id = :name')
            ->setParameter('suitin', $suitable)
            ->setParameter('name', $social);

        return $qb->getQuery()->getResult();
    }
    public function findQuarterPlanAccomp($suitable, $social=null,$quarter)
    {
       
        $qb = $this->createQueryBuilder('pa');
       

        $qb->select('pa.accompValue as acomp')
        ->join('pa.quarter','q')
        ->andWhere('q.slug = :slg')
        ->andwhere('pa.suitableInitiative = :suitin')
           
            ->setParameter('suitin', $suitable)
             ->setParameter('slg', $quarter);
        

     
        if($social){
            $qb
             ->andwhere('pa.socialAttribute = :name')
             ->setParameter('name', $social);
        }


           
            
            ;
            // dd($qb->getQuery()->getSingleScalarResult());

       $result=$qb->getQuery()->getOneOrNullResult();
            
             return $result? $result['acomp']:null;
    }
    public function findQuarterPlan($suitable, $social=null,$quarter)
    {
       
        $qb = $this->createQueryBuilder('pa');
       

        $qb->select('pa.planValue as plan')
        ->join('pa.quarter','q')
        ->andWhere('q.slug = :slg')
        ->andwhere('pa.suitableInitiative = :suitin')
           
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
     public function findYearlyPlan($suitable, $social=null,$type)
    {
       
        $qb = $this->createQueryBuilder('pa');
        if($type== 0 || $type == 2){
            $qb->select('max(pa.planValue)');
        }
        elseif ($type == 1 ) {
           $qb->select('sum(pa.planValue)');
        }
         elseif ($type == 3 )

        $qb->select('min(pa.planValue)');

        $qb->andwhere('pa.suitableInitiative = :suitin')
           
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
    public function findYearlyPlanAccomp($suitable, $social=null,$type)
    {
       
        $qb = $this->createQueryBuilder('pa');
        if($type== 0 || $type == 2){
            $qb->select('max(pa.accompValue)');
        }
        elseif ($type == 1 ) {
           $qb->select('sum(pa.accompValue)');
        }
         elseif ($type == 3 )

        $qb->select('min(pa.accompValue)');

        $qb->andwhere('pa.suitableInitiative = :suitin')
           
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
   
    public function findByQuarter($suitable, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')

            ->andwhere('pa.suitableInitiative = :suitin')

            ->andwhere('pa.quarter = :quarter')
            // ->andWhere('pa.accompValue is not null')
            ->setParameter('suitin', $suitable)
            ->setParameter('quarter', $quarter);

        return $qb->getQuery()->getResult();
    }

    public function findplanAcc($suitable, $social, $principal, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
            ->leftjoin('pa.socialAttribute', 'sa')
            ->leftJoin('pa.suitableInitiative', 'si')
            ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('pa.quarter = :quarter')
            ->andwhere('si.principalOffice = :princiapl')
            ->andwhere('sa.id = :name')
            ->setParameter('suitin', $suitable)
            ->setParameter('quarter', $quarter)
            ->setParameter('princiapl', $principal)
            ->setParameter('name', $social);

        return $qb->getQuery()->getResult();
    }
      public function calulateSumByInitiativeAndYear($initiative, $year, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
        ->select('sum(pa.planValue) as plan')
            // ->leftjoin('pa.socialAttribute', 'sa')
            ->Join('pa.suitableInitiative', 'si')
            // ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('pa.quarter = :quarter')
            ->andwhere('si.initiative = :initiative')
            ->andwhere('si.planningYear = :year')
            // ->andwhere('sa.id = :name')
            ->setParameter('year',  $year)
            ->setParameter('quarter', $quarter)
            ->setParameter('initiative', $initiative)
            // ->setParameter('name', $social)
            ;

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function SumByInitiativeAndYear()
    {
        $conn=$this->getEntityManager()->getConnection();
        $sql='SELECT year(p.year) as year from planning_year p';
         $fraud_stmt = $conn->prepare($sql);
        $fraud_stmt->execute();
        $result=$fraud_stmt->fetchAllAssociative();
     dd($result);
        $qb = $this->createQueryBuilder('pa')
        ->select('sum(pa.planValue) as plan,i.id as initiative, y.ethYear as year')
        // ->addSelect('extract(YEAR FROM y.year) years')
        
            // ->leftjoin('pa.socialAttribute', 'sa')
            ->Join('pa.suitableInitiative', 'si')
              ->Join('si.initiative', 'i')
               ->Join('si.planningYear', 'y')
            // ->andwhere('pa.suitableInitiative = :suitin')
            // ->andwhere('pa.quarter = :quarter')
            // ->andwhere('si.initiative = :initiative')
            // ->andwhere('si.planningYear = :year')
            // // ->andwhere('sa.id = :name')
            // ->setParameter('year',  $year)
            // ->setParameter('quarter', $quarter)
            // ->setParameter('initiative', $initiative)
            // ->setParameter('name', $social)
             
           
            ->groupBy('i.id')
             ->addGroupBy('y.id')
             
            
             ->orderBy('y.id','ASC')
              ->addOrderBy('i.id','ASC')
            // ->addGroupBy('si.planningYear')
          
           
            ;

        return $qb->getQuery()->getResult();
    }


      public function getOrganizationPlanByInitiativeAndYear($initiative, $year, $quarter,$org,$attrib=null)
    {
        $qb = $this->createQueryBuilder('pa')
        ->select('sum(pa.planValue) as plan')
            // ->leftjoin('pa.socialAttribute', 'sa')
            ->Join('pa.suitableInitiative', 'si')
              ->Join('si.principalOffice', 'po')
             ->andwhere('po.officeGroup = :og')
            ->andwhere('pa.quarter = :quarter')
            ->andwhere('si.initiative = :initiative')
            ->andwhere('si.planningYear = :year')
            // ->andwhere('sa.id = :name')
            ->setParameter('year',  $year)
            ->setParameter('quarter', $quarter)
            ->setParameter('initiative', $initiative)
             ->setParameter('og', $org)
            ;
            if($attrib){
                $qb->andWhere('pa.socialAttribute= :attr')
                 ->setParameter('attr', $attrib)
            ;
            }


        return $qb->getQuery()->getSingleScalarResult();
    }






    public function calulateAchievementByInitiativeAndYear($initiative, $year, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
            ->select('sum(pa.accompValue) as accomp')
            // ->leftjoin('pa.socialAttribute', 'sa')
            ->Join('pa.suitableInitiative', 'si')
            // ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('pa.quarter = :quarter')
            ->andwhere('si.initiative = :initiative')
            ->andwhere('si.planningYear = :year')
            // ->andwhere('sa.id = :name')
            ->setParameter('year',  $year)
            ->setParameter('quarter', $quarter)
            ->setParameter('initiative', $initiative)
            // ->setParameter('name', $social)
        ;

        return $qb->getQuery()->getSingleScalarResult();
    }
}
