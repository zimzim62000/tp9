<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 11/12/2017
 * Time: 15:57
 */

namespace App\Controller;

use App\Entity\Card;
use App\Entity\User;
use App\Entity\UserCard;
use App\Event\AppEvent;
use App\Event\UserCardEvent;
use App\Form\UserCardType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserCardController extends Controller
{
    /**
     * @Route(
     *     path="/userCardNew",
     *     name="new_usercard"
     * )
     */
    public function newUserCard(Request $request, Card $card, UserCard $userCards, UserCardEvent $userCardEvents)
    {
        $userCard = $userCards;
        $userCard->setCard($card);
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserCardType::class, $userCard, ['card' => $card->getId()]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $userCardEvent = $userCardEvents;
            $userCard->setCard($card);
            $userCardEvent->setUserCard($userCard);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USERCARD_ADD, $userCardEvent);
        }
        return $this->render('UserCard/new.html.twig', array('form' => $form->createView()));
    }
}

