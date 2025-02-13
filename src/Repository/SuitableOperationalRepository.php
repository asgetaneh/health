<?php

namespace App\Repository;

use App\Entity\SuitableOperational;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuitableOperational|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuitableOperational|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuitableOperational[]    findAll()
 * @method SuitableOperational[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuitableOperationalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuitableOperational::class);
    }
  public function findSuitableInitiatve($operationalOffice, $currentYear)
    {
        return $this->createQueryBuilder('os')
         ->leftJoin('os.suitableInitiative', 's')
            ->leftJoin('s.planningYear', 'y')
            ->andWhere('os.operationalOffice = :operationalOffice')
            ->andWhere('y.ethYear = :currentYear')
            ->setParameter('currentYear', $currentYear)
            ->setParameter('operationalOffice', $operationalOffice)
            ->orderBy('os.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function getBySuitableInitiatve($operationalOffice, $suitableInitiative)
    {
        return $this->createQueryBuilder('os')
            ->Join('os.suitableInitiative', 's')
           
            ->andWhere('os.operationalOffice = :operationalOffice')
            ->andWhere('os.suitableInitiative in (:suitable)')
          
            ->setParameter('suitable', $suitableInitiative)
            ->setParameter('operationalOffice', $operationalOffice)
            ->orderBy('os.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
      public function findOperationalId($suitableInId, $operationalOfId)
    {
        return $this->createQueryBuilder('os')
            ->andWhere('os.operationalOffice = :operationalOfId')
            ->andWhere('os.suitableInitiative = :suitableInId')
            ->setParameter('suitableInId', $suitableInId)
            ->setParameter('operationalOfId', $operationalOfId)
            ->orderBy('os.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    public function findByoffice($operationalOffice, $planyear)
    {
        $qb = $this->createQueryBuilder('s')
         ->leftJoin('s.suitableInitiative', 'si')
            ->leftJoin('si.initiative', 'i')
            ->leftJoin('i.keyPerformanceIndicator', 'k')
            ->leftJoin('k.strategy', 'st')
            ->leftJoin('st.objective', 'o')
            ->leftJoin('o.goal', 'g')
            ->andWhere('s.operationalOffice = :office')
            ->andwhere('si.planningYear = :planyear')
            ->setParameter('planyear', $planyear)
            ->setParameter('office', $operationalOffice);
        return $qb
            ->orderBy('i.initiativeNumber', 'ASC')->getQuery()->getResult();
    }
     public function getPlanningApproved($principalOffice)
    {
        // dd($principalOffice);

        return $this->createQueryBuilder('s')
            ->leftJoin('s.suitableInitiative', 'si')
            ->select('count(s.id)')
            // ->andWhere('py.ethYear', 'currentYear')
            ->andWhere('s.status = 1')
            ->andWhere('si.principalOffice =  :office')
            ->setParameter('office', $principalOffice)
            ->getQuery()->getSingleScalarResult();
    }
    public function findByPrincipal($principalOffice)
    {
        // dd($principalOffice);

        return $this->createQueryBuilder('s')
            ->leftJoin('s.suitableInitiative', 'si')
            // ->select('count(s.id)')
            // ->andWhere('py.ethYear', 'currentYear')
            // ->andWhere('s.status = 1')
            ->andWhere('si.principalOffice =  :office')
            ->setParameter('office', $principalOffice)
            ->getQuery()->getResult();
    }
      public function findDuplication($operationalOffice, $initiative, $planyear)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->andwhere('s.operationalOffice = :office')
                    ->leftJoin('s.suitableInitiative' ,'su')
            ->andwhere('s.suitableInitiative = :initiative')
            ->andwhere('su.planningYear = :planyear')
            ->setParameter('planyear', $planyear)
            ->setParameter('office', $operationalOffice)
            ->setParameter('initiative', $initiative);
        return $qb->getQuery()->getResult();
    }
     public function getRemovable($operationalOffice, $initiative, $planyear)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            //->leftJoin('s.planningAccomplishments','p')
            ->andwhere('s.operationalOffice = :office')
             ->leftJoin('s.suitableInitiative' ,'su')
            ->andwhere('s.suitableInitiative = :initiative')
            ->andwhere('su.planningYear = :planyear')
            // ->andWhere('s.planningAccomplishments is null')
            ->setParameter('planyear', $planyear)
            ->setParameter('office', $operationalOffice)
            ->setParameter('initiative', $initiative);
        // dd($qb->getQuery());
        return $qb->getQuery()->getOneOrNullResult();
    }
    

      public function findOprationalOfficeSuitableInitiative($OpratinalOffice)
    {
        // dd($id);

        return $this->createQueryBuilder('s')
            ->select('count(s.id)')
           // ->leftJoin('s.operationalOffice ', 'op')
            ->andWhere('s.operationalOffice = :oprational_office')
            ->setParameter('oprational_office', $OpratinalOffice)

            ->getQuery()->getOneOrNullResult();
    }
    public function findScore($search = [],$oprationalOffice)
    {

        $qb = $this->createQueryBuilder('op_s_i');
            if (isset($search['OpratinalOffice'])) {
                $qb
                    ->andWhere('op_s_i.operationalOffice = :oprational_office')
                    ->setParameter('oprational_office', $search['OpratinalOffice']);
            }
            if (isset($search['planningYear'])) {
                $qb
                     ->leftJoin('op_s_i.suitableInitiative', 's')
                    ->andWhere('s.planningYear = :planningYear')
                    ->setParameter('planningYear', $search['planningYear']);
            }
        return $qb->getQuery()->getResult();
    }
    
     public function getBySuitableInitiatveOnly($suitableInitiative)
    {
        return $this->createQueryBuilder('os')
            ->Join('os.suitableInitiative', 's')
           
            ->andWhere('os.suitableInitiative in (:suitable)')
          
            ->setParameter('suitable', $suitableInitiative)
            ->orderBy('os.id', 'ASC')
            ->getQuery()
            ->getResult();
    }
    // /**
    //  * @return SuitableOperational[] Returns an array of SuitableOperational objects
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
    public function findOneBySomeField($value): ?SuitableOperational
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
