<?php

namespace App\Controller;


use App\AppAccess;
use App\AppEvent;
use App\Entity\Card;
use App\Entity\User;
use App\Entity\UserCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserCardType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


/**
 * @Route(path="/usercard")
 */
class UserCardController extends Controller
{
    /**
     * @Route(
     *     path="/new/{id}",
     *     name="usercard_add"
     * )
     */
    public function addAction(Request $request, Card $card)
    {
        $usercard = $this->get(\App\Entity\UserCard::class);
        $form = $this->createForm(UserCardType::class, $usercard, ['card' => $card]);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()) {
            $usercardEvent = $this->get(\App\Event\UserCardEvent::class);


            $usercardEvent->setUserCard($usercard);
            $dispatcher = $this->get('event_dispatcher');

            $dispatcher->dispatch(AppEvent::USERCARD_ADD, $usercardEvent);

            return $this->redirectToRoute('user_index');
        }
        return $this->render('UserCard/new.html.twig', array('form' => $form->createView()));

    }


    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="usercard_edit"
     * )
     */
    public function editAction(Request $request, UserCard $usercard,AuthorizationCheckerInterface $authorizationChecker)
    {
        if(false === $authorizationChecker->isGranted(AppAccess::UserCardEdit, $usercard)){
            			return $this->redirectToRoute("user_index");
 	}
        $form = $this->createForm(UserCardType::class, $usercard);
        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted()) {
            $usercardEvent = $this->get(\App\Event\UserCardEvent::class);

            $usercardEvent->setUserCard($usercard);
            $dispatcher = $this->get('event_dispatcher');

            $dispatcher->dispatch(AppEvent::USERCARD_EDIT, $usercardEvent);

            return $this->redirectToRoute('user_index');
        }
        return $this->render('UserCard/edit.html.twig', array('form' => $form->createView()));

    }



    /**
     * @Route(
     *     path="/remove/{id}",
     *     name="usercard_remove"
     * )
     */
    public function removeAction(UserCard $usercard,AuthorizationCheckerInterface $authorizationChecker)
    {
        if(false === $authorizationChecker->isGranted(AppAccess::UserCardDelete, $usercard)){
            			return $this->redirectToRoute("user_index");
 		}

            $usercardEvent = $this->get(\App\Event\UserCardEvent::class);

            $usercardEvent->setUserCard($usercard);
            $dispatcher = $this->get('event_dispatcher');

            $dispatcher->dispatch(AppEvent::USERCARD_REMOVE, $usercardEvent);

            return $this->redirectToRoute('user_index');

    }


}
