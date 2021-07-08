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
    public function findplanAccwithoutSocial($suitable, $principal, $quarter)
    {
        $qb = $this->createQueryBuilder('pa')
            ->leftJoin('pa.suitableInitiative', 'si')
            ->andwhere('pa.suitableInitiative = :suitin')
            ->andwhere('si.principalOffice = :principal')
            ->andwhere('pa.quarter = :quarter')
            ->setParameter('suitin', $suitable)
            ->setParameter('quarter', $quarter)

            ->setParameter('principal', $principal);

        return $qb->getQuery()->getResult();
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
}
