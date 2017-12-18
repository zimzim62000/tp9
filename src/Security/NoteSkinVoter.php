<?php

namespace App\Security;

use App\AppAccess;
use App\Entity\NoteSkin;
use App\Entity\User;

use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class NoteSkinVoter extends Voter
{

    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    const SHOW = AppAccess::NoteSkinShow;
    const EDIT = AppAccess::NoteSkinEdit;
    const DELETE = AppAccess::NoteSkinDelete;

    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, array(self::SHOW, self::EDIT,self::DELETE))){
            return false;
        }

        if(!$subject instanceof NoteSkin){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        $user = $token->getUser();

        if(!$user instanceof User){
            return false;
        }

        switch($attribute){
            case self::SHOW:
            case self::EDIT:
            case self::DELETE:
                return $subject->getUser()->getId() === $user->getId();
            default:
                throw new \LogicException('This code should not be reached!');
        }
    }
}