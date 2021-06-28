<?php

namespace App\Repository;

use App\Entity\OperationalOffice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OperationalOffice|null find($id, $lockMode = null, $lockVersion = null)
 * @method OperationalOffice|null findOneBy(array $criteria, array $orderBy = null)
 * @method OperationalOffice[]    findAll()
 * @method OperationalOffice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OperationalOfficeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OperationalOffice::class);
    }
    public function filterOperationalOffice($principalOffice)
    {

        //dd($productNmae);
        return $this->createQueryBuilder('s')


            ->Select('s.name')

            ->addSelect('s.id')
            ->andWhere('s.principalOffice = :principalOffice')
            ->setParameter('principalOffice', $principalOffice)
            ->orderBy('s.id', 'ASC')

            ->getQuery()

            ->getResult();
    }
    // /**
    //  * @return OperationalOffice[] Returns an array of OperationalOffice objects
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
    public function findOneBySomeField($value): ?OperationalOffice
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function search($search = [])
    {
        $qb = $this->createQueryBuilder('o');
        if (isset($search['name'])) {

            $qb

                ->andWhere("o.name  LIKE '%" . $search['name'] . "%' ");
        }
        return $qb->getQuery();
    }
}
