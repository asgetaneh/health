<?php

namespace App\Repository;

use App\Entity\SocialAttributeAchievement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SocialAttributeAchievement|null find($id, $lockMode = null, $lockVersion = null)
 * @method SocialAttributeAchievement|null findOneBy(array $criteria, array $orderBy = null)
 * @method SocialAttributeAchievement[]    findAll()
 * @method SocialAttributeAchievement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SocialAttributeAchievementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SocialAttributeAchievement::class);
    }

    // /**
    //  * @return SocialAttributeAchievement[] Returns an array of SocialAttributeAchievement objects
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
    public function findOneBySomeField($value): ?SocialAttributeAchievement
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
