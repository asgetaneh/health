<?php

namespace App\Repository;

use App\Entity\PlanAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PlanAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlanAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlanAchievement[]    findAll()
 * @method PlanAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlanAchievementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlanAchievement::class);
    }

    // /**
    //  * @return PlanAchievement[] Returns an array of PlanAchievement objects
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
    public function findOneBySomeField($value): ?PlanAchievement
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
