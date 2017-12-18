<?php

namespace App\Security;

use App\AppAccess;
use App\Entity\User;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
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

    const EDIT = AppAccess::SkinNoteEdit;
    const DELETE = AppAccess::SkinNoteDelete;
    const SHOW = AppAccess::SkinNoteShow;

    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, array(self::DELETE, self::EDIT, self::SHOW))){
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

        if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return true;
        }

        /** @var NoteSkin $noteSkin */
        $noteSkin = $subject;

        switch($attribute){
            case self::EDIT:
                return false;
            case self::DELETE:
                return false;
            case self::SHOW:
                return $noteSkin->getUser()->getId() === $user->getId();
            default:
                throw new \LogicException('This code should not be reached!');
        }
    }
}