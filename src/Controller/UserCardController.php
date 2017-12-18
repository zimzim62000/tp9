<?php

namespace App\Controller;

use App\AppAccess;
use App\Entity\Card;
use App\Entity\User;
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
     * @Route(
     *     path="/{id}/add",
     *     name="usercard_add"
     * )
     */
    public function addAction(Card $id, Request $request)
    {
        $userCard = $this->get(UserCard::class);
        $form = $this->createForm(UserCardType::class, $userCard);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userCardEvent = $this->get('app.UserCard.event');
            $userCard->setCard($id);
            $userCard->setUser($this->getUser());

            $userCardEvent->setUserCard($userCard);

            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppAccess::UserCardAdd , $userCardEvent);
            return $this->redirectToRoute('home_index');
        }

        return $this->render("UserCard/add.html.twig", array("form" => $form->createView()));
    }

    /**
     * @Route(
     *     path="/{id}/show",
     *     name="usercard_show"
     * )
     */
    public function showAction(UserCard $id, Request $request)
    {
        $userCard = $this->get(UserCard::class);

        $userCardEvent = $this->get('app.UserCard.event');
        $userCard->setCard($id);
        $userCard->setUser($this->getUser());

        $userCardEvent->setUserCard($userCard);

        $dispatcher = $this->get('event_dispatcher');
        $dispatcher->dispatch(AppAccess::UserCardAdd , $userCardEvent);


        return $this->render("UserCard/show.html.twig", array("userCard" => $userCard));
    }
}