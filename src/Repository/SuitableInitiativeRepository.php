<?php

namespace App\Repository;

use App\Entity\SuitableInitiative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SuitableInitiative|null find($id, $lockMode = null, $lockVersion = null)
 * @method SuitableInitiative|null findOneBy(array $criteria, array $orderBy = null)
 * @method SuitableInitiative[]    findAll()
 * @method SuitableInitiative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SuitableInitiativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SuitableInitiative::class);
    }

    // /**
    //  * @return SuitableInitiative[] Returns an array of SuitableInitiative objects
    //  */
    public function findDuplication($principaloffice, $initiative, $planyear)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->andwhere('s.principalOffice = :office')
            ->andwhere('s.initiative = :initiative')
            ->andwhere('s.planningYear = :planyear')
            ->setParameter('planyear', $planyear)
            ->setParameter('office', $principaloffice)
            ->setParameter('initiative', $initiative);
        return $qb->getQuery()->getResult();
    }
    public function getRemovable($principaloffice, $initiative, $planyear)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            //->leftJoin('s.planningAccomplishments','p')
            ->andwhere('s.principalOffice = :office')
            ->andwhere('s.initiative = :initiative')
            ->andwhere('s.planningYear = :planyear')
            // ->andWhere('s.planningAccomplishments is null')
            ->setParameter('planyear', $planyear)
            ->setParameter('office', $principaloffice)
            ->setParameter('initiative', $initiative);
        // dd($qb->getQuery());
        return $qb->getQuery()->getOneOrNullResult();
    }
    public function findByYear($initiative, $planyear)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->join('s.planningAccomplishments', 'p')
            ->andWhere('p.id is not null and p.accompValue is not null')
            ->andwhere('s.initiative = :initiative')
            ->andwhere('s.planningYear = :planyear')
            ->setParameter('planyear', $planyear)
            ->setParameter('initiative', $initiative);
        return $qb->getQuery()->getResult();
    }
    public function countByPrincipalOffice($initiative, $planyear)
    {
        $qb = $this->createQueryBuilder('s');
        $qb
            ->join('s.principalOffice', 'p')
            ->select('count(DISTINCT p.id) as count')
            ->andwhere('s.initiative = :initiative')
            ->andwhere('s.planningYear = :planyear')
            ->setParameter('planyear', $planyear)
            ->setParameter('initiative', $initiative);
        return $qb->getQuery()->getSingleScalarResult();
    }
    public function findByoffice($principaloffice, $planyear)
    {
        $qb = $this->createQueryBuilder('s')
            ->leftJoin('s.initiative', 'i')
            ->leftJoin('i.keyPerformanceIndicator', 'k')
            ->leftJoin('k.strategy', 'st')
            ->leftJoin('st.objective', 'o')
            ->leftJoin('o.goal', 'g')
            ->andWhere('s.principalOffice = :office')
            ->andwhere('s.planningYear = :planyear')
            ->setParameter('planyear', $planyear)
            ->setParameter('office', $principaloffice);
        return $qb
            ->orderBy('i.initiativeNumber', 'ASC')->getQuery()->getResult();
    }
    public function findAllActive($principaloffice, $planyear, $stat)
    {
        $qb = $this->createQueryBuilder('s')
            ->andWhere('s.principalOffice = :office')
            ->andwhere('s.planningYear = :planyear')
            ->andwhere('s.isActive = :stat')
            ->setParameter('stat', $stat)
            ->setParameter('planyear', $planyear)
            ->setParameter('office', $principaloffice);
        return $qb->getQuery()->getResult();
    }
    public function search($search = [])
    {

        $qb = $this->createQueryBuilder('s')
            ->join('s.initiative', 'i')
            ->join('i.keyPerformanceIndicator', 'k')
            ->join('k.strategy', 'st')
            ->join('st.objective', 'o');

        if (isset($search['planyear'])) {

            $qb->andWhere('s.planningYear in (:planyear)')
                ->setParameter('planyear', $search['planyear']);
        }
        if (isset($search['principaloffice'])) {
            $qb->andWhere('s.principalOffice in (:principalOffice)')
                ->setParameter('principalOffice', $search['principaloffice']);
        }
        if (isset($search['initiative']) && sizeof($search['initiative']) > 0) {
            $qb->andWhere('s.initiative in (:initiative)')
                ->setParameter('initiative', $search['initiative']);
        }
        if (isset($search['kpi']) && sizeof($search['kpi']) > 0) {
            $qb->andWhere('i.keyPerformanceIndicator in (:kpi)')
                ->setParameter('kpi', $search['kpi']);
        }
        if (isset($search['strategy']) && sizeof($search['strategy']) > 0) {
            $qb->andWhere('k.strategy in (:strategy)')
                ->setParameter('strategy', $search['strategy']);
        }
        if (isset($search['objective']) && sizeof($search['objective']) > 0) {
            $qb->andWhere('st.objective in (:objective)')
                ->setParameter('objective', $search['objective']);
        }
        if (isset($search['goal']) && sizeof($search['goal']) > 0) {
            $qb->andWhere('o.goal in (:goal)')
                ->setParameter('goal', $search['goal']);
        }
        return $qb->getQuery();
    }

   public function findByPrincipalAndOffice($office, $planningyear)
    {
        $qb = $this->createQueryBuilder('i');
        $qb
            ->join('i.principalOffice', 'po')
            ->join('i.planningYear', 'py')
            ->andWhere('po.id in (:office)')
            ->andWhere('py.id = :planningyearid')
            // ->andwhere('i.isActive = 1')
            ->setParameter('office', $office)
            ->setParameter('planningyearid', $planningyear);
        return $qb->getQuery()->getResult();
    }

    public function findwithPlan($id)
    {
        $qb = $this->createQueryBuilder('i');
        $qb
            ->select('i')
            ->addSelect('p as plan')
            ->leftJoin('i.planningAccomplishments', 'p')
            ->andWhere('i.id  =:id')
            // ->andwhere('i.isActive = 1')
            ->setParameter('id', $id);
        return $qb->getQuery()->getOneOrNullResult();
    }
    public function finds($initiative, $principal)
    {
        $qb = $this->createQueryBuilder('i');
        $qb

            ->andwhere('i.initiative = :initiative')
            ->andwhere('i.principalOffice = :principal')
            ->setParameter('principal', $principal)
            ->setParameter('initiative', $initiative);
        return $qb->getQuery()->getResult();
    }
    public function findPrincipal($search,  $quarterId)
    {
        $qb = $this->createQueryBuilder('pa');

        //  dd($quarterId);
        $qb
            ->leftJoin('pa.suitableInitiative', 's')
            ->andWhere('s.principalOffice = :principalOffice')
            ->andWhere('pa.quarter = :quarter')
            ->setParameter('quarter', $quarterId)

            ->setParameter('principalOffice', $search);
        return $qb->getQuery()->getResult();
    }


    public function findScore($search = [],$principalOffice, $principalValue)
    {

        $qb = $this->createQueryBuilder('s');
        if ($principalValue == 1) {
            # code...

            if (isset($search['principalOffice'])) {
                $qb
                    ->andWhere('s.principalOffice = :principalOffice')
                    ->setParameter('principalOffice', $search['principalOffice']);
            }
            if (isset($search['planningYear'])) {
                $qb
                    ->andWhere('s.planningYear = :planningYear')
                    ->setParameter('planningYear', $search['planningYear']);
            }
        } else {
           
            if (isset($search['planningYear'])) {
                $qb
                    ->andWhere('s.planningYear = :planningYear')
                    ->setParameter('planningYear', $search['planningYear'])
                    ->andWhere('s.principalOffice = :principalOffice')
                    ->setParameter('principalOffice', $principalOffice);
            }
        }
        return $qb->getQuery()->getResult();
    }
    public function getPrincipalSelectSuitable($principalOffice)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.planningYear', 'py')
            ->select('count(s.id)')
            ->andWhere('s.principalOffice =  :office')
            ->setParameter('office', $principalOffice)
            ->getQuery()->getSingleScalarResult();
    }
}
