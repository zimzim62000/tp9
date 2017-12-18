<?php

namespace App\Voter;

use App\Entity\NoteSkin;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class NoteSkinVoter extends Voter
{
    const USER_CAN_VIEW = 'user_can_view';

    protected function supports($attribute, $subject)
    {
        if(!$subject instanceof NoteSkin){
            return false;
        }
        if($attribute !== self::USER_CAN_VIEW){
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        return $subject === $token->getUser();
    }

}