<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 11/12/2017
 * Time: 21:10
 */

namespace App\Controller;


use App\AppAccess;
use App\Entity\Card;
use App\Entity\UserCard;
use App\Event\AppEvent;
use App\Event\LogUserCardEvent;
use App\Event\UserCardEvent;
use App\Form\UserCardType;
use App\Handler\AddUserCardHandler;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UserCardController
 * @package App\Controller
 * @Route(path="/usercard")
 */
class UserCardController extends Controller{
	
	/**
	 * @Route(path="/add/{id}",
	 *     name="add_usercard")
	 * @param Request $request
	 * @param Card $card
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function addUserCard(Request $request, Card $card){
		
		/** @var AddUserCardHandler $addUserCardHandler */
		$addUserCardHandler = $this->get("App\Handler\AddUserCardHandler");
		
		if(! $addUserCardHandler->checkNumberCard()){
			return $this->redirectToRoute("user_index", [], $status = 302);
		}
		
		$userCard = $this->get(UserCard::class);
		
		$form = $this->createForm(UserCardType::class, $userCard, ["card" => $card]);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$userCard = $form->getData();
			
			/** @var UserCardEvent $userCardEvent */
			$userCardEvent = $this->get("App\Event\UserCardEvent");
			
			$userCardEvent->setUserCard($userCard);
			
			/** @var LogUserCardEvent $userCardEvent */
			$logUserCardEvent = $this->get("App\Event\LogUserCardEvent");
			$logUserCardEvent->getLogUserCard()->setUser($this->getUser());
			$logUserCardEvent->getLogUserCard()->setCard($userCard->getCard());
			$logUserCardEvent->getLogUserCard()->setUserOwner($userCard->getUser());
			
			/** @var EventDispatcher $dispatcher */
			$dispatcher = $this->get("event_dispatcher");
			$dispatcher->dispatch(AppEvent::USER_CARD_ADD, $userCardEvent);
			$dispatcher->dispatch(AppEvent::LOG_USER_CARD_ADD, $logUserCardEvent);
			
			return $this->redirectToRoute("user_index", [], $status = 302);
		}
		
		return $this->render("UserCard/new.html.twig", ["form" => $form->createView()]);
	}
	
	/**
	 * @Route(path="/edit/{id}",
	 *     name="edit_usercard")
	 * @param Request $request
	 * @param UserCard $userCard
	 * @param AuthorizationCheckerInterface $authorizationChecker
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function editUserCard(Request $request, UserCard $userCard, AuthorizationCheckerInterface $authorizationChecker, ValidatorInterface $validator){
		
		/*
		 * ValidatorInterface : permet de recuperer les erreurs sur un objets ex : $validator->validate($userCard)
		 */
		
		
		if(false === $authorizationChecker->isGranted(AppAccess::UserCardEdit, $userCard)){
			return $this->redirectToRoute("user_index", [], 302);
		}
		
		$form = $this->createForm(UserCardType::class, $userCard);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$userCard = $form->getData();
			
			/** @var UserCardEvent $userCardEvent */
			$userCardEvent = $this->get("App\Event\UserCardEvent");
			
			$userCardEvent->setUserCard($userCard);
			
			/** @var LogUserCardEvent $userCardEvent */
			$logUserCardEvent = $this->get("App\Event\LogUserCardEvent");
			$logUserCardEvent->getLogUserCard()->setUser($this->getUser());
			$logUserCardEvent->getLogUserCard()->setCard($userCard->getCard());
			$logUserCardEvent->getLogUserCard()->setUserOwner($userCard->getUser());
			
			/** @var EventDispatcher $dispatcher */
			$dispatcher = $this->get("event_dispatcher");
			
			$dispatcher->dispatch(AppEvent::USER_CARD_EDIT, $userCardEvent);
			$dispatcher->dispatch(AppEvent::LOG_USER_CARD_EDIT, $logUserCardEvent);
			
			return $this->redirectToRoute("user_index", [], $status = 302);
		}
		
		return $this->render("UserCard/edit.html.twig", ["form" => $form->createView()]);
	}
	
	/**
	 * @Route(path="/delete/{id}", name="delete_usercard")
	 * @param UserCard $userCard
	 * @param AuthorizationCheckerInterface $authorizationChecker
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function deleteUserCard(UserCard $userCard, AuthorizationCheckerInterface $authorizationChecker){
		
		if(false === $authorizationChecker->isGranted(AppAccess::UserCardDelete, $userCard)){
			return $this->redirectToRoute("user_index", [], 302);
		}
		
		/** @var UserCardEvent $userCardEvent */
		$userCardEvent = $this->get("App\Event\UserCardEvent");
		$userCardEvent->setUserCard($userCard);
		
		/** @var LogUserCardEvent $userCardEvent */
		$logUserCardEvent = $this->get("App\Event\LogUserCardEvent");
		$logUserCardEvent->getLogUserCard()->setUser($this->getUser());
		$logUserCardEvent->getLogUserCard()->setCard($userCard->getCard());
		$logUserCardEvent->getLogUserCard()->setUserOwner($userCard->getUser());
		
		/** @var EventDispatcher $dispatcher */
		$dispatcher = $this->get("event_dispatcher");
		$dispatcher->dispatch(AppEvent::USER_CARD_DELETE, $userCardEvent);
		$dispatcher->dispatch(AppEvent::LOG_USER_CARD_DELETE, $logUserCardEvent);
		
		return $this->redirectToRoute("user_index", [], 302);
	}
	
	/**
	 * @Route(path="/show/{id}", name="show_usercard")
	 * @param UserCard $userCard
	 * @param AuthorizationCheckerInterface $authorizationChecker
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
	 */
	public function showUserCard(UserCard $userCard, AuthorizationCheckerInterface $authorizationChecker){
		
		if(false === $authorizationChecker->isGranted(AppAccess::UserCardShow, $userCard)){
			return $this->redirectToRoute("user_index", [], 302);
		}
		
		/** @var LogUserCardEvent $userCardEvent */
		$logUserCardEvent = $this->get("App\Event\LogUserCardEvent");
		$logUserCardEvent->getLogUserCard()->setUser($this->getUser());
		$logUserCardEvent->getLogUserCard()->setCard($userCard->getCard());
		$logUserCardEvent->getLogUserCard()->setUserOwner($userCard->getUser());
		
		/** @var EventDispatcher $dispatcher */
		$dispatcher = $this->get("event_dispatcher");
		$dispatcher->dispatch(AppEvent::LOG_USER_CARD_SHOW, $logUserCardEvent);
		
		return $this->render('UserCard/show.html.twig', ['userCard' => $userCard]);
	}
	
	
}