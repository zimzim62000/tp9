<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 11/12/17
 * Time: 14:38
 */

namespace App\Controller;


use App\Entity\Card;
use App\Entity\User;
use App\Entity\UserCard;
use App\Form\UserCardType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Event\AppEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class UserCardController extends Controller
{

    /**
     * @Route(path="/usercard/show",name="app_user_card_show")
     */
    public function indexAction()
    {   if (false === $authChecker->isGranted(AppAccess::CardShow, $card)) {
        return $this->redirectToRoute('card_index');
    }
        $UserCards = $this->getDoctrine()->getManager()->getRepository(UserCard::class)->findAll();
        return $this->render('UserCard/index.html.twig', ['usercard' => $UserCards]);
    }

    /**
     * @Route(path="/usercard/add/{id}",name="app_user_card_add")
     */
    public function addAction(Request $request,Card $id)
    {
        $usercard= $this->get(UserCard::class);
        $form = $this->createForm(UserCardType::class, $usercard);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $UserCardEvent = $this->get('app.UserCard.event');
            $usercard->setCard($id);
            $usercard->setUser($this->getUser());

            $UserCardEvent->setUsercard($usercard);

            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::USERCARD_ADD , $UserCardEvent);
            return $this->redirectToRoute('home_index');
        }

        return $this->render("UserCard/add.html.twig", array("form" => $form->createView()));

    }

}