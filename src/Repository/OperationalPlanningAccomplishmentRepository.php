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

    // /**
    //  * @return OperationalPlanningAccomplishment[] Returns an array of OperationalPlanningAccomplishment objects
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
    public function findOneBySomeField($value): ?OperationalPlanningAccomplishment
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
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
}
