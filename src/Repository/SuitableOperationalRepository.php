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
