<?php

namespace App\Repository;

use App\Entity\GoalAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GoalAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoalAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoalAchievement[]    findAll()
 * @method GoalAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalAchievementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GoalAchievement::class);
    }

    // /**
    //  * @return GoalAchievement[] Returns an array of GoalAchievement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GoalAchievement
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
     public function getByGoalAndYear($goal,$year)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.goal = :init')
            ->andWhere('i.year = :year')
            ->setParameter('init', $goal)
            ->setParameter('year', $year)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
