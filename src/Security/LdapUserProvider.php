<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\UserInfo;
use App\Helper\Constants;
use Doctrine\DBAL\Exception\ConnectionException as ExceptionConnectionException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Ldap\Ldap;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Ldap\LdapInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Ldap\Exception\ConnectionException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;


class LdapUserProvider implements UserProviderInterface
{
    /**
     * @var Ldap
     */
    private $ldap;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var string
     */
    private $ldapSearchDn;
    /**
     * @var string
     */
    private $ldapSearchPassword;
    /**
     * @var string
     */
    private $ldapBaseDn;
    /**
     * @var string
     */
    private $ldapSearchDnString;


    public function __construct(EntityManagerInterface $entityManager, Ldap $ldap, string $ldapSearchDn, string $ldapSearchPassword, string $ldapBaseDn, string $ldapSearchDnString)
    {
        $this->ldap = $ldap;
        $this->entityManager = $entityManager;
        $this->ldapSearchDn = $ldapSearchDn;
        $this->ldapSearchPassword = $ldapSearchPassword;
        $this->ldapBaseDn = $ldapBaseDn;
        $this->ldapSearchDnString = $ldapSearchDnString;
    }

    /**
     * @param string $username
     * @return UserInterface|void
     * @see getUserEntityCheckedFromLdap(string $username, string $password)
     */
    public function loadUserByUsername($username)
    {
    }

    /**
     * search user against ldap and returns the matching App\Entity\User. 
     * @param string $username
     * @param string $password
     * @return User|object|null
     */
    public function getUserEntityCheckedFromLdap(string $username, string $password)
    {
        //  dd(sprintf($this->ldapSearchDnString, $username));

        try {


            $this->ldap->bind(sprintf($this->ldapSearchDnString, $username), $password);
        } catch (ExceptionConnectionException $th) {

            return null;
            throw new CustomUserMessageAuthenticationException('Cant connect to server,try again');
        } catch (\Throwable $th) {

            return null;
        }
        // dd("bind");

        $username = $this->ldap->escape($username, '', LdapInterface::ESCAPE_FILTER);
        $search = $this->ldap->query($this->ldapBaseDn, 'uid=' . $username);


        $entries = $search->execute();
        //  dd($entries);
        $count = count($entries);
        // dd($count);

        if (!$count) {
            return null;
            // throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
        }
        if ($count > 1) {
            return null;
            // throw new UsernameNotFoundException('More than one user found');
        }
        $ldapEntry = $entries[0];
        // dd($ldapEntry);
        $fullName = $ldapEntry->getAttributes()['gecos'][0];
        $email = $ldapEntry->getAttributes()['mail'][0];
        $username = $ldapEntry->getAttributes()['uid'][0];
        // $email = $ldapEntry->getAttributes()['mail'][0];
        if ($ldapEntry->getAttributes()['mobile']) {
            # code...
            $mobile = $ldapEntry->getAttributes()['mobile'][0];
        } else {
            $mobile = "no";
        }
        if ($ldapEntry->getAttributes()['employeeNumber']) {
            $employeeNumber = $ldapEntry->getAttributes()['employeeNumber'][0];
        } else {
            $employeeNumber = "no";
        }
        // dd($employeeNumber);
        $userinfo = new UserInfo();

        $user = new User();
        $userRepository = $this->entityManager->getRepository('App\Entity\User');
        $userfind = $userRepository->findOneBy(['username' => $username]);
        # code...
        if (!$userfind) {
//            if ($ldapEntry->getAttributes()['employeeType'][0] == "Staff") {
                $user->setUsername($username);
                $user->setRoles(['staff']);
                $user->setStatus(0);
                $user->setMobile($mobile);
                $this->entityManager->persist($user);
                //$this->entityManager->flush();
                $userinfo->setUser($user);
                $userinfo->setEmail($email);
                $userinfo->setEmployeeNumber($employeeNumber);
                $userinfo->setFullName($fullName);
                $this->entityManager->persist($userinfo);

                $this->entityManager->flush();
                $username = $user->getUsername();
                $userfind1 = $userRepository->findOneBy(['username' => $username]);
                return $userfind1;
          //  }
        } else {

            return $userfind;
        }
    }

    /**
     * Refreshes the user after being reloaded from the session.
     *
     * When a user is logged in, at the beginning of each request, the
     * User object is loaded from the session and then this method is
     * called. Your job is to make sure the user's data is still fresh by,
     * for example, re-querying for fresh User data.
     *
     * If your firewall is "stateless: true" (for a pure API), this
     * method is not called.
     *
     * @return UserInterface
     */
    public function refreshUser(UserInterface $user)
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Invalid user class "%s".', get_class($user)));
        }
        return $user;

        // Return a User object after making sure its data is "fresh".
        // Or throw a UsernameNotFoundException if the user no longer exists.
        throw new \Exception('TODO: fill in refreshUser() inside ' . __FILE__);
    }

    /**
     * Tells Symfony to use this provider for this User class.
     */
    public function supportsClass($class)
    {
        return User::class === $class || is_subclass_of($class, User::class);
    }
}
