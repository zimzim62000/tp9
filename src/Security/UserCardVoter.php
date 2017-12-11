<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 11/12/17
 * Time: 16:36
 */

namespace App\Security;

use App\AppAccess;
use App\Entity\User;
use App\Entity\Card;

use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
class UserCardVoter
{
    private $decisionManager;

    public function __construct(AccessDecisionManagerInterface $decisionManager)
    {
        $this->decisionManager = $decisionManager;
    }

    const VIEW = AppAccess::CardShow;

    protected function supports($attribute, $subject)
    {
        if(!in_array($attribute, array(self::VIEW))){
            return false;
        }

        if(!$subject instanceof Card){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        if (!$this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
            return false;
        }

        $user = $token->getUser();

        if(!$user instanceof User){
            return false;
        }

        switch($attribute){
            case self::VIEW:
                return $subject->getVisible();
            default:
                throw new \LogicException('This code should not be reached!');
        }
    }
}