<?php

namespace App\Repository;

use App\Entity\OperationalSuitableInitiative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalSuitableInitiative|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalSuitableInitiative|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalSuitableInitiative[]    findAll()
 * @method OperationalSuitableInitiative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalSuitableInitiativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalSuitableInitiative::class);
    }

    // /**
    //  * @return OperationalSuitableInitiative[] Returns an array of OperationalSuitableInitiative objects
    //  */
    public function findPrincipalAccomplishment($suitableInitiative, $quarter)
    {

        return $this->createQueryBuilder('os')
            ->leftJoin('os.operationalPlanning', 'op')
            ->leftJoin('op.operationalSuitable', 'osu')
            ->leftJoin('osu.suitableInitiative', 'su')
            ->andWhere('os.quarter = :quarter')
            ->andWhere('su.id = :suitableInitiative')
            ->andWhere('os.status = 1')
            ->setParameter('suitableInitiative', $suitableInitiative)
            ->setParameter('quarter', $quarter)
            ->orderBy('os.id', 'ASC')

            ->getQuery()

            ->getResult();
    }

    public function findplan($principalOffice, $suitable, $currentQuarter)
    {
        // dd($suitable,$principalOffice);
        return $this->createQueryBuilder('o')
            ->leftJoin('o.operationalOffice', 'op')
            ->leftJoin('o.operationalPlanning', 'pa')
            ->leftJoin('pa.operationalSuitable', 'su')
            ->andWhere('op.principalOffice = :val')
            ->andWhere('su.suitableInitiative = :suitable')
            ->andWhere('o.quarter = :currentQuarter')
//            ->andWhere('o.status = 1')
            ->setParameter('currentQuarter', $currentQuarter)
            ->setParameter('val', $principalOffice)
            ->setParameter('suitable', $suitable)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(50)
            ->getQuery()
            ->getResult();
    }
    public function findplanSocial($principalOffice, $suitable, $social)
    {
        return $this->createQueryBuilder('o')
            ->leftJoin('o.operationalOffice', 'op')
            ->leftJoin('o.operationalPlanning', 'pa')
            ->leftJoin('pa.operationalSuitable', 'su')
            ->andWhere('op.principalOffice = :val')
            ->andWhere('o.social = :social')
            ->andWhere('o.status = 1')
            ->andWhere('su.suitableInitiative = :suitable')
            ->setParameter('val', $principalOffice)
            ->setParameter('social', $social)
            ->setParameter('suitable', $suitable)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }
    public function findByPrincipal($principalOffice,$quarter)
    {

        return $this->createQueryBuilder('ops')
            ->leftJoin('ops.operationalPlanning', 'opa')
            ->leftJoin('opa.operationalSuitable', 'op')
            ->leftJoin('op.suitableInitiative', 'su')
            ->andWhere('ops.quarter = :quarter')
            ->setParameter('quarter', $quarter)
            ->andWhere('su.principalOffice = :principalOffice')
            ->setParameter('principalOffice', $principalOffice)
            ->orderBy('ops.id', 'ASC')

            ->getQuery()

            ->getResult();
    }

    // public function findBySelect($quarter)
    // {
    //     return $this->createQueryBuilder('o')
    //         ->Select('SUM(o.accomplishedValue) as total')
    //         ->addSelect('o.status as office')
    //         ->andWhere('o.quarter = :quarter')
    //         ->groupBy('o.operationalOffice')
    //         ->setParameter('quarter', $quarter)
    //         ->getQuery()->getResult();
    // }

    /*
    public function findOneBySomeField($value): ?OperationalSuitableInitiative
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
