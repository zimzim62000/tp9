<?php

namespace App\Security;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

/**
 * Created by PhpStorm.
 * User: florian
 * Date: 18/12/17
 * Time: 16:10
 */

class NoteSkinVoter extends Voter
{

    private $decisionManager;
    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    const VIEW = \App\AppAccess::NoteSkinAdd;

    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, array(self::VIEW))){
            return false;
        }
        if(!$subject instanceof \App\Entity\NoteSkin){
            return false;
        }
        return true;
    }


    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if($user === $subject->getUser()){
            return true;
        }

        if (!$this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return false;
        }

        return true;
    }
}