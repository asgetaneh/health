<?php

namespace App\Repository;

use App\Entity\PrincipalOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Internal\Hydration\ObjectHydrator;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\VarExporter\Internal\Hydrator;

/**
 * @method PrincipalOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrincipalOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrincipalOffice[]    findAll()
 * @method PrincipalOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrincipalOfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrincipalOffice::class);
    }
    public function findAllsUser($user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.operationalOffices', 'oo')
            ->leftJoin('oo.operationalManagers', 'om')
            ->leftJoin('om.manager', 'u')
            ->leftJoin('u.userInfo', 'ui')
            ->Select('ui.fullName')

            ->addSelect('u.id')
            ->andWhere('s.id = :val')
            ->setParameter('val', $user)
            ->orderBy('s.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    public function search($search = [])
    {
        $qb = $this->createQueryBuilder('p');
        if (isset($search['name'])) {

            $qb

                ->andWhere("p.name  LIKE '%" . $search['name'] . "%' ");
        }
        if (isset($search['principaloffice'])) {

            $qb

                ->andWhere("p.id in(:po)")
                ->setParameter('po', $search['principaloffice']);
        }
        return $qb->getQuery();
    }
    // /**
    //  * @return PrincipalOffice[] Returns an array of PrincipalOffice objects
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
    // /**
    //  * @return PrincipalOffice[] Returns an array of PrincipalOffice objects
    //  */
   
    public function findByYear($QyearId)
    {
        return $this->createQueryBuilder('p')
            ->InnerJoin('p.suitableInitiatives', 's')
            ->andWhere('s.planningYear= :year')
             ->setParameter('year', $QyearId)
            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    public function findByYearPrinciplaOffice( $prinOfId,$QyearId)
    {
        return $this->createQueryBuilder('p')
            ->InnerJoin('p.suitableInitiatives', 's')
            ->andWhere('p.id= :pid')
            ->andWhere('s.planningYear= :year')
             ->setParameter('pid', $prinOfId)
             ->setParameter('year', $QyearId)
            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
  

    /*
    public function findOneBySomeField($value): ?PrincipalOffice
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findOfficeByUser($user, $delegationuser = [])
    {
        $qb = $this->createQueryBuilder('po')
            ->join('po.principalManagers', 'pm')
            ->andWhere('pm.principal = :user or pm.principal in (:delegate)')
            ->andwhere('pm.isActive = 1')
            ->setParameter('user', $user)
            ->setParameter('delegate', $delegationuser);

        return $qb->getQuery()->getResult();
    }
    public function findPlannedOffice($filter = [])
    {
        $qb = $this->createQueryBuilder('p');
       
        if (isset($filter['status'])) {

            ;
            $status = $filter['status'];

            if ($status == 1) {
               
                $qb->InnerJoin('p.suitableInitiatives', 's')
                     ->join('s.planningAccomplishments', 'pc')
                    ->andWhere('s.planningYear= :year')
                    ->setParameter('year', $filter['year'])
                ->andWhere('pc.id is not null');
                
                
            } elseif ($status == 2) {


                $qb->Where($qb->expr()->notIn('p.id', $this->findNonPlannedOffice($filter)));;;
            }
        }


        $qb ->andWhere('p.isActive = :acctive')
            ->setParameter('acctive',1);

        return $qb->getQuery();
    }
    public function findNonPlannedOffice($filter = [])
    {
        $qb = $this->createQueryBuilder('p')
            ->select('DISTINCT p.id');





        $qb->InnerJoin('p.suitableInitiatives', 's')
            ->join('s.planningAccomplishments', 'pc')
            ->andWhere('s.planningYear= :year')
            ->setParameter('year', $filter['year'])
            ->andWhere('pc.id is not null');


        $id = [];
        $results = $qb->getQuery()->getResult();

        foreach ($results as $key => $result) {

            $id[] = $result['id'];
        }



        return $id;
    }

    public function findPrintPlannedOffice($filter = [])
    {
        $qb = $this->createQueryBuilder('p');

        if (isset($filter['status'])) {


            $status = $filter['status'];

            if ($status == 1) {
                $qb->Join('p.suitableInitiatives', 's')
                    ->join('s.planningAccomplishments', 'pc')
                    ->andWhere('s.planningYear= :year')
                   
                //   ->andWhere('pc.id is not null')
                 ->setParameter('year', $filter['year']);
            } elseif ($status == 2) {


                $qb->Where($qb->expr()->notIn('p.id', $this->findNonPlannedOffice($filter)));;;
            }
        }




        return $qb->getQuery()->getResult();
    }

    public function findPrincipalOffice($user)
    {
        $qb = $this->createQueryBuilder('po')
            ->leftJoin('po.principalManagers', 'pm')
            ->leftJoin('po.operationalOffices', 'of')
            ->leftJoin('of.operationalManagers', 'om')
            ->leftJoin('of.performers', 'pr')

            ->orWhere('pm.principal = :user and pm.isActive = 1')
            ->orWhere('om.manager = :manager and om.isActive = 1')
            ->orWhere('pr.id = :performer and pr.isActive = 1')
            ->setParameter('user', $user)
            ->setParameter('manager', $user)
            ->setParameter('performer', $user->getId());
        return $qb->getQuery()->getResult();
    }
}
