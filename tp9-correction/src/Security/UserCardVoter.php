<?php

namespace App\Security;

use App\AppAccess;
use App\Controller\SkinController;
use App\Entity\User;
use App\Entity\WeaponSkin;

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

    const VIEW = AppAccess::SkinShow;
    const ADD = AppAccess::SkinAdd;
    const EDIT = AppAccess::SkinEdit;
    const DELETE = AppAccess::SkinDelete;

    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, array(self::VIEW, self::EDIT, self::DELETE))){
            return false;
        }

        if(!$subject instanceof WeaponSkin){
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
            case self::VIEW:
            case self::EDIT:
            case self::DELETE:
                return $subject->getUser()->getId() === $user->getId();
            default:
                throw new \LogicException('This code should not be reached!');
        }
    }
}