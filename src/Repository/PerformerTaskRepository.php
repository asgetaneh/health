<?php

namespace App\Repository;

use App\Entity\PerformerTask;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PerformerTask|null find($id, $lockMode = null, $lockVersion = null)
 * @method PerformerTask|null findOneBy(array $criteria, array $orderBy = null)
 * @method PerformerTask[]    findAll()
 * @method PerformerTask[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformerTaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PerformerTask::class);
    }
     public function filterDeliverBy($plan)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')

            ->Select('s.name')  
           
            ->addSelect('s.id')
            // ->addSelect('s.user')

            ->orderBy('s.id', 'ASC')->
            andWhere('s.PlanAcomplishment = :plan')
            ->setParameter('plan', $plan)

            ->getQuery()
            
            ->getResult();
    }
    public function findPerformerInitiativeTask($user,$initiative)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')

            ->leftJoin('s.PlanAcomplishment','pl')  
           ->andWhere('pl.suitableInitiative = :initiative')
            ->andWhere('s.createdBy = :user')


            ->setParameter('initiative', $initiative)
                        ->setParameter('user', $user)

                        ->orderBy('s.id', 'ASC')
            ->getQuery()
            
            ->getResult();
    }
    

    // /**
    //  * @return PerformerTask[] Returns an array of PerformerTask objects
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
    public function findOneBySomeField($value): ?PerformerTask
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
