<?php

namespace App\Security;

use App\AppAccess;
use App\Entity\User;
use App\Entity\NoteSkin;

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

    const ADD = AppAccess::NOTE_SKIN_ADD;
    const EDIT = AppAccess::NOTE_SKIN_EDIT;
    const DELETE = AppAccess::NOTE_SKIN_DELETE;

    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, array(self::EDIT, self::DELETE))){
            return false;
        }

        if(!$subject instanceof NoteSkin){
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

        if ($this->decisionManager->decide($token, array('ROLE_ADMIN')) === true && $attribute !== self::ADD) {
            return true;
        }

        switch($attribute){
            case self::ADD:
            case self::EDIT:
            case self::DELETE:
                return $subject->getUser()->getId() === $user->getId();
            default:
                throw new \LogicException('This code should not be reached!');
        }
    }
}