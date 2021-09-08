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

    public function findSuitableInitiatve($principalOffice, $currentYear)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.planningYear', 'y')
            ->andWhere('s.principalOffice = :principalOffice')
            ->andWhere('y.ethYear = :currentYear')
            ->setParameter('currentYear', $currentYear)
            ->setParameter('principalOffice', $principalOffice)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult();
    }


    /*
    public function findOneBySomeField($value): ?SuitableInitiative
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
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

        $qb = $this->createQueryBuilder('s');
        if (isset($search['planyear']) && sizeof($search['planyear']) > 0) {
            $qb->andWhere('s.planningYear in (:planyear)')
                ->setParameter('planyear', $search['planyear']);
        }
        if (isset($search['principaloffice']) && sizeof($search['principaloffice']) > 0) {
            $qb->andWhere('s.principalOffice in (:principalOffice)')
                ->setParameter('principalOffice', $search['principaloffice']);
        }
        if (isset($search['initiative']) && sizeof($search['initiative']) > 0) {
            $qb->andWhere('s.initiative in (:initiative)')
                ->setParameter('initiative', $search['initiative']);
        }
        return $qb->getQuery()->getResult();
    }
    public function findByPrincipalAndOffice($office)
    {
        $qb = $this->createQueryBuilder('i');
        $qb
            ->join('i.principalOffice', 'po')
            ->andWhere('po.id in (:office)')
            // ->andwhere('i.isActive = 1')
            ->setParameter('office', $office);
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
}
