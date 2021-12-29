<?php

namespace App\Repository;

use App\Entity\OperationalManager;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalManager|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalManager|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalManager[]    findAll()
 * @method OperationalManager[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalManagerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalManager::class);
    }
    public function findAllsUser($principalOffice, $user)
    {

        // dd($user);
        // $user=$this->getUser();
        // dd($user);
        return $this->createQueryBuilder('s')
            ->leftJoin('s.operationalOffice', 'op')
            ->leftJoin('op.principalOffice', 'po')
            ->leftJoin('s.manager', 'u')
            ->leftJoin('u.userInfo', 'ui')
            ->Select('ui.fullName')
            ->addSelect('u.id')
            ->andWhere('po.id = :val')
            ->andWhere('u.id = :user')
            ->setParameter('user', $user)
            ->setParameter('val', $principalOffice)
            ->orderBy('s.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    // /**
    //  * @return OperationalManager[] Returns an array of OperationalManager objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?OperationalManager
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByPrincipal($principalOffice)
    {
        $qb = $this->createQueryBuilder('om');
        $qb->leftJoin('om.operationalOffice', 'oo')
            ->andwhere('oo.principalOffice = :principalOffice')

            ->setParameter('principalOffice', $principalOffice);


        return $qb->getQuery()->getResult();
    }
    public function findActive($operationaloffice, $manager = null)
    {
        $qb = $this->createQueryBuilder('om');
        if ($manager) {
            $qb->andWhere('om.operationalOffice = :po')
                ->andwhere('om.manager = :manager')

                ->setParameter('manager', $manager)
                ->setParameter('po', $operationaloffice);
        } else {
            $qb->andWhere('om.operationalOffice = :po')
                ->andwhere('om.isActive = true')
                ->setParameter('po', $operationaloffice);
        }
        return $qb->getQuery()->getResult();
    }
    public function search($search = [])
    {
        $qb = $this->createQueryBuilder('p');
        if (isset($search['name'])) {

            $qb
                ->join('p.manager', 'pr')
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
        return $qb->getQuery()->getResult();
    }
}
