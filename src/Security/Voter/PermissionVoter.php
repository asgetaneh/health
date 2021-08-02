<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
class PermissionVoter extends Voter
{ 
    private $session;
    public function __construct(SessionInterface $sessionInterface ) {
        $this->session=$sessionInterface;
    }
    protected function supports($attribute, $subject)
    {
        //  return true;
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        $permission=$this->session->get("PERMISSION");
        if(!$permission)
        $permission=array();

       return in_array($attribute, $permission);
    
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)

    {
        //   return true;
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }
        // if ($subject instanceof Encounter) {
        //     if($subject->getDoctor() == $user)
        //         return true;
        //     foreach ($subject->getTransfers() as $key => $value) {
              
        //        if ($value->getTransferredBy() == $user) {
        //           return true;
        //        }
        //     }
        //     return false;
        // }
        switch ($attribute) {
            case 'VIEW_USER':


                break;
            case 'POST_VIEW':

                break;
        }

        $permission = $this->session->get("PERMISSION");
        if (!$permission)
            $permission = array();

        return in_array($attribute, $permission) | in_array('rlspad',  $user->getRoles());
    }
}
