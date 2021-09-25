<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newEncodedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }
    public function findForUserGroup($usergroup = null)
    {
        $qb = $this->createQueryBuilder('u');

        if (sizeof($usergroup)) {

            $qb->andWhere('u.id not in ( :usergroup )')
                ->setParameter('usergroup', $usergroup);
        }



        return $qb->orderBy('u.id', 'ASC')
            ->getQuery()->getResult();
    }
    public function search($search = [])
    {
        //  dd($search['performer']);
        $qb = $this->createQueryBuilder('u');
        $qb->leftJoin('u.userInfo', 'ui')
            ->leftJoin('u.principalManagers', 'pm')
            ->leftJoin('u.operationalManagers', 'om');

        if (isset($search['principalOffice']) && sizeof($search['principalOffice']) > 0) {

            $qb->andWhere('pm.principalOffice  in (:principalOffice)')
                ->setParameter('principalOffice', $search['principalOffice']);
        }

        if (isset($search['operationalOffice']) && sizeof($search['operationalOffice']) > 0) {
            $qb->andWhere('om.operationalOffice  in (:operationalOffice)')
                ->setParameter('operationalOffice', $search['operationalOffice']);
        }
         if (isset($search['performer']) && sizeof($search['performer']) > 0) {
            $qb->andWhere('ui.id  in (:performer)')
                ->setParameter('performer', $search['performer']);
        }


        return $qb = $qb->orderBy('u.id', 'ASC')->getQuery()->getResult();
    }



    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
