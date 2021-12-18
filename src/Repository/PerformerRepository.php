<?php

namespace App\Repository;

use App\Entity\Performer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Performer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Performer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Performer[]    findAll()
 * @method Performer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PerformerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Performer::class);
    }
    public function findAllsUser($principalOffice)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.operationalOffice', 'oo')
            ->leftJoin('oo.principalOffice', 'po')
            ->leftJoin('s.performer', 'u')
            ->leftJoin('u.userInfo', 'ui')

            ->Select('ui.fullName')

            ->addSelect('u.id')
            ->andWhere('po.id = :val')
            ->setParameter('val', $principalOffice)
            ->orderBy('s.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    public function filterDeliverBy($user)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')->leftJoin('s.operationalOffice', 'oo')
            ->leftJoin('oo.principalOffice', 'po')
            ->leftJoin('s.performer', 'u')
            ->leftJoin('u.userInfo', 'ui')

            ->Select('ui.fullName')

            ->addSelect('u.id')
            ->andWhere('po.id = :val')
            ->setParameter('val', $user)
            ->orderBy('s.id', 'ASC')

            ->getQuery()

            ->getResult();
    }

    // /**
    //  * @return Performer[] Returns an array of Performer objects
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
    public function findOneBySomeField($value): ?Performer
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findActive($operationaloffice, $performer)
    {
        $qb = $this->createQueryBuilder('om');

        $qb->andWhere('om.operationalOffice = :po')
            ->andwhere('om.performer = :manager')

            ->setParameter('manager', $performer)
            ->setParameter('po', $operationaloffice);


        return $qb->getQuery()->getResult();
    }
    public function search($search = [])
    {
        $qb = $this->createQueryBuilder('p');
        if (isset($search['name'])) {

            $qb
                ->join('p.performer', 'pr')
                ->join('pr.userInfo', 'ui')

                ->andWhere("ui.fullName  LIKE '%" . $search['name'] . "%' ");
        }
        if (isset($search['principaloffice']) && sizeof($search['principaloffice']) > 0) {


            $qb
                ->join('p.operationalOffice', 'o')

                ->andWhere("o.principalOffice in(:po)")
                ->setParameter('po', $search['principaloffice']);
        }
        if (isset($search['operationaloffice']) && sizeof($search['operationaloffice']) > 0) {


            $qb
                ->join('p.operationalOffice', 'o')

                ->andWhere("o.id in (:id)")
                ->setParameter('id', $search['operationaloffice']);
        }
        return $qb->getQuery();
    }
}
