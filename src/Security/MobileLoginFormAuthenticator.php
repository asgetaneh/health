<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Student;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class MobileLoginFormAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'mobile_login';

    private $entityManager;
    private $urlGenerator;
    private $csrfTokenManager;
    private $passwordEncoder;
    private $is_ldap_user;


    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, CsrfTokenManagerInterface $csrfTokenManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->passwordEncoder = $passwordEncoder;
    }

    public function supports(Request $request)
    {


        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    public function getCredentials(Request $request)
    {

        $credentials = [
            'username' => $request->request->get('username'),
            'password' => $request->request->get('password'),
            'csrf_token' => $request->request->get('_csrf_token'),
        ];
        //dd($credentials);
        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['username']
        );

        // dd($credentials);
        return $credentials;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {

        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }
        //  dd($credentials['username']);
            $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $credentials['username']]);
   // $user = $userProvider->getUserEntityCheckedFromLdap($credentials['username'], $credentials['password']);

        $this->user = $user;
        //  dd($user);
        if (!$user) {
          

            throw new CustomUserMessageAuthenticationException('Invalid Credentials.');
            // throw new CustomUserMessageAuthenticationException('Username could not be found.');
        } else {

            $this->is_ldap_user = true;
        }
       
        return $user;
    }
    public function getUserlist($username)
    {

        $token = new CsrfToken('authenticate', $credentials['csrf_token']);
        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }
        
          $user = $this->entityManager->getRepository(User::class)->findOneBy(['username' => $credentials['username']]);
      //$user = $userProvider->getUserEntityCheckedFromLdap($credentials['username'], $credentials['password']);
        $this->user = $user;
       
        if (!$user) {
          

            throw new CustomUserMessageAuthenticationException('Invalid Credentials.');
            // throw new CustomUserMessageAuthenticationException('Username could not be found.');
        } else {

            $this->is_ldap_user = true;
        }

        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
        if ($this->is_ldap_user) {
            return true;
        }

        return $this->passwordEncoder->isPasswordValid($user, $credentials['password']);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function getPassword($credentials): ?string
    {

        return $credentials['password'];
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {

        $user = $this->user;
        // dd($user);
        $permissions = [];

        foreach ($user->getRoles() as $role) {
            $permissions[] = $role;
        }

        $groups = $this->user->getUserGroup();
        foreach ($groups as $key => $value) {

            $permission = $value->getPermission();
            foreach ($permission as $key => $value1) {
                $permissions[] = $value1->getCode();
            }
        }
        // dd($permissions);
        $request->getSession()->set(
            "PERMISSION",
            $permissions
        );
        // if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
        //     return new RedirectResponse($targetPath);
        // } else if (in_array("admin", $user->getRoles()))
        //     return new RedirectResponse($this->urlGenerator->generate('choose_office'));
        // else if (in_array("Request", $user->getRoles()))
        //     return new RedirectResponse($this->urlGenerator->generate('choose_office'));
        // else if (in_array("Approve", $user->getRoles()))
        //     return new RedirectResponse($this->urlGenerator->generate('choose_office'));
        // else
        //     return new RedirectResponse($this->urlGenerator->generate('choose_office'));

        return new RedirectResponse($this->urlGenerator->generate('mobile_choose_office'));
        throw new \Exception('TODO: provide a valid redirect inside ' . __FILE__);
    }
    protected function getLoginUrl()
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}
