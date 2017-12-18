<?php

namespace App\Controller;

use App\AppAccess;
use App\AppEvent;
use App\Entity\User;
use App\Event\UserEvent;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\UserCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route(path="/user")
 */
class UserController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_user_index"
     * )
     */
    public function indexdAction(AuthorizationCheckerInterface $authorizationChecker)
    {
        if($authorizationChecker->isGranted('ROLE_ADMIN')){

            $userCards = $this->getDoctrine()->getManager()->getRepository(UserCard::class)->findAll();

        }else{
            $userCards = $this->getDoctrine()->getManager()->getRepository(UserCard::class)->findBy(["user" => $this->getUser()]);
        }

        return $this->render('User/index.html.twig', ["userCards" => $userCards]);
    }
    /**
     * @Route(
     *     path="/new",
     *     name="app_user_new"
     * )
     */
    public function newAction(Request $request,UserPasswordEncoderInterface $encoder){

        $person= $this->get(User::class);
        $form = $this->createForm(UserType::class, $person);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user=$form->getData();
            $user->setPassword($encoder->encodePassword($user,$user->getPassword()));
            $event = $this->get(UserEvent::class);
            $event->setUser($person);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::USER_ADD, $event);
            $this->redirectToRoute("app_user_index");
    }
        return $this->render("User/add.html.twig", array("form" => $form->createView()));

    }


    /**
     * @Route(
     *     path="/edit",
     *     name="app_user_edit"
     * )
     */
    public function editAction(Request $request,UserPasswordEncoderInterface $encoder){


        $form=$this->createForm(UserType::class,$this->getUser());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user=$form->getData();
            $user->setPassword($encoder->encodePassword($user,$user->getPassword()));

            $em->flush();
        }
        return $this->render("User/add.html.twig", array("form" => $form->createView()));
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="app_user_edituser"
     * )
     */
    public function editUserAction(Request $request,UserPasswordEncoderInterface $encoder,User $user,AuthorizationCheckerInterface $authorizationChecker){

        if(false === $authorizationChecker->isGranted(AppAccess::USER_CAN_VIEW)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("app_home_index");
        }
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user->setPassword($encoder->encodePassword($user,$user->getPassword()));

            $em->flush();
        }
        return $this->render("User/add.html.twig", array("form" => $form->createView()));
    }
}
