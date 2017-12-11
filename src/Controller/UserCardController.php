<?php

namespace App\Controller;


use App\AppEvent;
use App\Entity\Card;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserCardType;


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
            $usercard->setCard($card);

            $usercardEvent->setUserCard($usercard);
            $dispatcher = $this->get('event_dispatcher');

            $dispatcher->dispatch(AppEvent::USERCARD_ADD, $usercardEvent);

        }
        return $this->render('UserCard/new.html.twig', array('form' => $form->createView()));

    }
}
