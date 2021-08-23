<?php

namespace App\Repository;

use App\Entity\Initiative;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Initiative|null find($id, $lockMode = null, $lockVersion = null)
 * @method Initiative|null findOneBy(array $criteria, array $orderBy = null)
 * @method Initiative[]    findAll()
 * @method Initiative[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InitiativeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Initiative::class);
    }

    // /**
    //  * @return Initiative[] Returns an array of Initiative objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Initiative
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAlls()
    {
        return $this->createQueryBuilder('g')

            ->orderBy('g.initiativeNumber', 'ASC')






            ->getQuery();
    }
    public function findByJu()
    {
        return $this->createQueryBuilder('g')
            ->leftJoin('g.category', 'c')
            ->andWhere('c.code=1 or c.code = 5 or c.code=6 or c.code=7 or c.id is null')
            ->orderBy('g.initiativeNumber', 'ASC')





            ->getQuery()->getResult();
    }

    public function findByPrincipalAndOffice($office)
    {
        $qb = $this->createQueryBuilder('i');
        $qb
            ->join('i.principalOffice', 'po')
            ->andWhere('po.id = :office')
            ->andwhere('i.isActive = 1')
            ->setParameter('office', $office);
        return $qb->getQuery()->getResult();
    }
    public function findBySuitable($office)
    {
        $qb = $this->createQueryBuilder('i');
        $qb
            ->select('i')
            ->addSelect('s')
            // ->join('i.principalOffice','po')
            ->join('i.suitableInitiatives', 's')
            ->andWhere('s.principalOffice in(:soffice)')
            //->andWhere('po.id = :office')
            ->andwhere('i.isActive = 1')
            ->setParameter('soffice', $office)
            // ->setParameter('office',$office)
        ;
        return $qb->getQuery()->getResult();
    }
    public function search($search = [])
    {

        $qb = $this->createQueryBuilder('i');
        if (isset($search['goal']) && sizeof($search['goal']) > 0) {
            $qb
                ->innerJoin('i.keyPerformanceIndicator', 'k')
                ->innerJoin('k.strategy', 's')
                ->innerJoin('s.objective', 'o')
                ->andWhere('o.goal in (:goal)')
                ->setParameter('goal', $search['goal']);
        }
        if (isset($search['perspective']) && sizeof($search['perspective']) > 0) {
            $qb->andWhere('o.perspective in (:perspective)')
                ->setParameter('perspective', $search['perspective']);
        }
        if (isset($search['objective']) && sizeof($search['objective']) > 0) {

            $qb
                ->Join('i.keyPerformanceIndicator', 'k')
                ->Join('k.strategy', 's')
                ->andWhere('s.objective in (:objective)')
                ->setParameter('objective', $search['objective']);
        }
        if (isset($search['strategy']) && sizeof($search['strategy']) > 0) {

            $qb
                ->Join('i.keyPerformanceIndicator', 'k')
                ->andWhere('k.strategy in (:strategy)')
                ->setParameter('strategy', $search['strategy']);
        }
        if (isset($search['kpi']) && sizeof($search['kpi']) > 0) {
            $qb->andWhere('i.keyPerformanceIndicator in (:kpi)')
                ->setParameter('kpi', $search['kpi']);
        }
        if (isset($search['principaloffice']) && sizeof($search['principaloffice']) > 0) {
            $qb
                ->leftJoin('i.principalOffice', 'p')
                ->andWhere('p.id in (:principalOffice)')
                ->setParameter('principalOffice', $search['principaloffice']);
        }
        if (isset($search['category']) && sizeof($search['category']) > 0) {
            $qb
                ->leftJoin('i.category', 'c')
                ->andWhere('c.id in (:category)')
                ->setParameter('category', $search['category']);
        }
        if (isset($search['name'])) {

            $qb
                ->leftJoin('i.translations', 't')
                ->andWhere("t.name  LIKE '%" . $search['name'] . "%' ");
        }


        return $qb->orderBy('i.initiativeNumber','ASC')->getQuery();

    }
}
