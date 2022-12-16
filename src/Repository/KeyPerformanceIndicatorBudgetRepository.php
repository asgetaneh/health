<?php

namespace App\Repository;

use App\Entity\KeyPerformanceIndicatorBudget;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<KeyPerformanceIndicatorBudget>
 *
 * @method KeyPerformanceIndicatorBudget|null find($id, $lockMode = null, $lockVersion = null)
 * @method KeyPerformanceIndicatorBudget|null findOneBy(array $criteria, array $orderBy = null)
 * @method KeyPerformanceIndicatorBudget[]    findAll()
 * @method KeyPerformanceIndicatorBudget[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KeyPerformanceIndicatorBudgetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, KeyPerformanceIndicatorBudget::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(KeyPerformanceIndicatorBudget $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(KeyPerformanceIndicatorBudget $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return KeyPerformanceIndicatorBudget[] Returns an array of KeyPerformanceIndicatorBudget objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?KeyPerformanceIndicatorBudget
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
