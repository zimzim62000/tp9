<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 18/12/2017
 * Time: 13:38
 */

namespace App\Controller;

use App\AppAccess;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\AppEvent;
use App\Event\NoteSkinEvent;
use App\Event\SkinEvent;
use App\Form\NoteSkinType;
use App\Form\WeaponSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/skin")
 */
class SkinController extends Controller{
	
	/**
	 * @Route(
	 *     path="/add",
	 *     name="skin_add"
	 * )
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function addAction(Request $request, AuthorizationCheckerInterface $authorizationChecker)
	{
		$weaponSkin = $this->get("App\Entity\WeaponSkin");
		
		if(false === $authorizationChecker->isGranted(AppAccess::WeaponAdd, $weaponSkin)){
			return $this->redirectToRoute("weapon_index", [], 302);
		}
		
		$form = $this->createForm(WeaponSkinType::class, $weaponSkin);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$weaponSkin = $form->getData();
			
			/** @var SkinEvent $weaponSkinEvent*/
			$weaponSkinEvent = $this->get("App\Event\SkinEvent");
			
			$weaponSkinEvent->setSkin($weaponSkin);
			
			/** @var EventDispatcher $dispatcher */
			$dispatcher = $this->get("event_dispatcher");
			$dispatcher->dispatch(AppEvent::SKIN_ADD, $weaponSkinEvent);
			
			return $this->redirectToRoute("weapon_index", [], $status = 302);
		}
		
		return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
	}
	
	/**
	 * @Route(
	 *     path="/edit/{id}",
	 *     name="skin_edit"
	 * )
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, AuthorizationCheckerInterface $authorizationChecker, WeaponSkin $weaponSkin)
	{/*
		if(false === $authorizationChecker->isGranted(AppAccess::WeaponEdit, $weaponSkin)){
			die("pas le droit");
			return $this->redirectToRoute("weapon_index", [], 302);
		}
		*/
		$form = $this->createForm(WeaponSkinType::class, $weaponSkin);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$weaponSkin = $form->getData();
			
			/** @var NoteSkinEvent $weaponSkinEvent*/
			$weaponSkinEvent = $this->get("App\Event\SkinEvent");
			
			$weaponSkinEvent->setNoteSkin($weaponSkin);
			
			/** @var EventDispatcher $dispatcher */
			$dispatcher = $this->get("event_dispatcher");
			$dispatcher->dispatch(AppEvent::SKIN_EDIT, $weaponSkinEvent);
			
			return $this->redirectToRoute("weapon_index", [], $status = 302);
		}
		
		return $this->render("Weapon/new.html.twig", ["form" => $form->createView()]);
	}
}