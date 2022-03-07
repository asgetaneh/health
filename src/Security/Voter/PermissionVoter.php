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
        
        $permission=$this->session->get("PERMISSION");
        if(!$permission)
        $permission=array();

        return in_array($attribute, $permission) | in_array('supper', $permission);
    
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)

    {
        //   return true;
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }
      
        switch ($attribute) {
            case 'VIEW_USER':


                break;
            case 'POST_VIEW':

                break;
        }

        $permission = $this->session->get("PERMISSION");
        if (!$permission)
            $permission = array();

        return in_array($attribute, $permission) | in_array('supper',  $user->getRoles());
    }
}
