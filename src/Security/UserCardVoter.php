<?php

namespace App\Security;

use App\AppAccess;
use App\Entity\User;
use App\Entity\UserCard;


use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserCardVoter extends Voter
{

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    const VIEW = AppAccess::UserCardShow;
    const EDIT= AppAccess::UserCardEdit;


    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, array(self::VIEW,self::EDIT))){
            return false;
        }

        if(!$subject instanceof UserCard){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {


        $user = $token->getUser();

        if(!$user instanceof User){
            return false;
        }

        if (!$this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }
        switch($attribute){
            case self::VIEW:
                return $subject->getUser()->getId()===$user->getId();
            case self::EDIT:
                return $subject->getUser()->getId()===$user->getId();
            default:
                throw new \LogicException('This code should not be reached!');
        }


    }
}