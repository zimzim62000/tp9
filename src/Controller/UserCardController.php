<?php

namespace App\Controller;


use App\AppAccess;
use App\AppEvent;
use App\Entity\Card;
use App\Entity\UserCard;
use App\Form\UserCardType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/usercard")
 */
class UserCardController extends Controller
{


    /**
     * @Route("/new/{id}", name="usercard_new")
     */
    public function newAction(Request $request, Card $card)
    {


        $usercard = $this->get(\App\Entity\UserCard::class);
        $form = $this->createForm(UserCardType::class,$usercard,['card'=>$card]);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid())
        {
            $usercardEvent = $this->get(\App\Event\UserCardEvent::class);

            $usercardEvent->setUserCard($usercard);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USERCARD_ADD, $usercardEvent);

        }
        return $this->render('UserCard/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/edit/{id}", name="usercard_edit")
     */
    public function editAction(Request $request, UserCard $userCard, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (false === $authorizationChecker->isGranted(AppAccess::CardShow, $userCard)) {
            return $this->denyAccessUnlessGranted(AppAccess::CardShow, $userCard);
        }
        $form = $this->createForm(UserCardType::class,$userCard);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid())
        {
            $usercardEvent = $this->get(\App\Event\UserCardEvent::class);
            $usercardEvent->setUserCard($userCard);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USERCARD_EDIT, $usercardEvent);

        }
        return $this->render('UserCard/new.html.twig', array('form' => $form->createView()));
    }
}
