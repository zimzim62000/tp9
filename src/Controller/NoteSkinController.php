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
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/noteskin")
 */
class NoteSkinController extends Controller{
	
	/**
	 * @Route(
	 *     path="/{id}",
	 *     name="noteskin_add"
	 * )
	 * @param Request $request
	 * @param WeaponSkin $weaponSkin
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function addAction(Request $request, AuthorizationCheckerInterface $authorizationChecker, WeaponSkin $weaponSkin)
	{
		if(false === $authorizationChecker->isGranted(AppAccess::NoteAdd, $weaponSkin)){
			return $this->redirectToRoute("weapon_index", [], 302);
		}
		
		$noteSkin = $this->getDoctrine()->getRepository(NoteSkin::class)->findBy(["weaponSkin" => $weaponSkin, "user" => $this->getUser()]);
		
		if(!empty($noteSkin)){
			$this->denyAccessUnlessGranted("Pas le droit d'ajouter plusieurs notes");
		}
		$noteSkin = $this->get("App\Entity\NoteSkin");
		
		$form = $this->createForm(NoteSkinType::class, $noteSkin, ["weaponskin" => $weaponSkin]);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$noteSkin = $form->getData();
			
			/** @var NoteSkinEvent $noteSkinEvent*/
			$noteSkinEvent = $this->get("App\Event\NoteSkinEvent");
			
			$noteSkinEvent->setNoteSkin($noteSkin);
			
			/** @var EventDispatcher $dispatcher */
			$dispatcher = $this->get("event_dispatcher");
			$dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $noteSkinEvent);
			
			return $this->redirectToRoute("weapon_index", [], $status = 302);
		}
		
		return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
	}
	
	/**
	 * @Route(
	 *     path="/edit/{id}",
	 *     name="noteskin_edit"
	 * )
	 * @param Request $request
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editAction(Request $request, AuthorizationCheckerInterface $authorizationChecker, NoteSkin $noteSkin)
	{
		if(false === $authorizationChecker->isGranted(AppAccess::NoteEdit, $noteSkin)){
			die("pas le droit");
			return $this->redirectToRoute("weapon_index", [], 302);
		}
		
		$form = $this->createForm(NoteSkinType::class, $noteSkin);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$noteSkin = $form->getData();
			
			/** @var NoteSkinEvent $noteSkinEvent*/
			$noteSkinEvent = $this->get("App\Event\NoteSkinEvent");
			
			$noteSkinEvent->setNoteSkin($noteSkin);
			
			/** @var EventDispatcher $dispatcher */
			$dispatcher = $this->get("event_dispatcher");
			$dispatcher->dispatch(AppEvent::NOTE_SKIN_EDIT, $noteSkinEvent);
			
			return $this->redirectToRoute("weapon_index", [], $status = 302);
		}
		
		return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
	}
	
	/**
	 * @Route(
	 *     path="/delete/{id}",
	 *     name="noteskin_delete"
	 * )
	 * @param WeaponSkin $weaponSkin
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function deleteAction(AuthorizationCheckerInterface $authorizationChecker, NoteSkin $noteSkin)
	{
		
		if(false === $authorizationChecker->isGranted(AppAccess::NoteDelete, $noteSkin)){
			die("pas le droit");
			return $this->redirectToRoute("weapon_index", [], 302);
		}
		
		/** @var NoteSkinEvent $noteSkinEvent*/
		$noteSkinEvent = $this->get("App\Event\NoteSkinEvent");
		
		$noteSkinEvent->setNoteSkin($noteSkin);
		
		/** @var EventDispatcher $dispatcher */
		$dispatcher = $this->get("event_dispatcher");
		$dispatcher->dispatch(AppEvent::NOTE_SKIN_DELETE, $noteSkinEvent);

		return $this->redirectToRoute("weapon_index");
	}
}