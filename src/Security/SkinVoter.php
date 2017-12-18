<?php

namespace App\Security;

use App\AppAccess;
use App\Entity\NoteSkin;
use App\Entity\User;
use App\Entity\Card;

use App\Entity\WeaponSkin;
use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SkinVoter extends Voter
{
	
	private $decisionManager;
	
	public function __construct(AccessDecisionManagerInterface $decisionManager)
	{
		$this->decisionManager = $decisionManager;
	}
	
	const ADD = AppAccess::WeaponAdd;
	const EDIT = AppAccess::WeaponEdit;
	
	protected function supports($attribute, $subject)
	{
		if(!in_array($attribute, array(self::ADD, self::EDIT))){
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
		
		switch($attribute){
			case self::ADD:
				return $this->decisionManager->decide($token, array('ROLE_USER', 'ROLE_SUPER_ADMIN'));
			default:
				throw new \LogicException('This code should not be reached!');
		}
	}
}