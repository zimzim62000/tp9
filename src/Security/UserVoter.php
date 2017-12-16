<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 13/12/17
 * Time: 11:08
 */

namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    const USER_CAN_VIEW="user_can_view";

    protected function supports($attribute, $subject)
    {
        if(!$subject instanceof User) return false;
        if($attribute !== self::USER_CAN_VIEW)return false;
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        return $subject->getId()===$token->getUser();
    }

}