<?php

namespace App\Security;

use App\AppAccess;
use App\Entity\User;
use App\Entity\Card;

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
	
	const EDIT = AppAccess::UserCardEdit;
	const DELETE = AppAccess::UserCardDelete;
	const SHOW = AppAccess::UserCardShow;
	
	protected function supports($attribute, $subject)
	{
		if(!in_array($attribute, array(self::DELETE, self::EDIT, self::SHOW))){
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
		
		if ($this->decisionManager->decide($token, array('ROLE_ADMIN'))) {
			return true;
		}
		
		/** @var Usercard $userCard */
		$userCard = $subject;
		
		switch($attribute){
			case self::EDIT:
				return $userCard->getUser()->getId() === $user->getId();
			case self::DELETE:
				return $userCard->getUser()->getId() === $user->getId();
			case self::SHOW:
				return $userCard->getUser()->getId() === $user->getId();
			default:
				throw new \LogicException('This code should not be reached!');
		}
	}
}