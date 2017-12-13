<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\User;
use App\Entity\UserCard;
use App\Form\UserType;
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
    public function createUser(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $user = $this->get(User::class);

        $form = $this->createForm(UserType::class, null);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $passwordEncoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em-> persist($user);
            $em-> flush();
        }

        return $this->render("User/new.html.twig", ["form" => $form->createView()]);

    }

    /**
     * @Route(
     *     path="/edit",
     *     name="app_user_edit"
     * )
     */
    public function editUser(Request $request, UserPasswordEncoderInterface $passwordEncoder){

        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $passwordEncoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em-> persist($user);
            $em-> flush();
        }

        return $this->render("User/new.html.twig", ["form" => $form->createView()]);

    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="app_user_edit_by_id"
     *
     * )
     */
    public function editUserById(User $user, Request $request, AuthorizationCheckerInterface $authorizationChecker, UserPasswordEncoderInterface $passwordEncoder){

        $user = $this->getUser();

        if(false === $authorizationChecker->isGranted(AppAccess::UserEdit, $user)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("app_user_index");
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $password = $passwordEncoder->encodePassword($user,$user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em-> persist($user);
            $em-> flush();
        }

        return $this->render("User/new.html.twig", ["form" => $form->createView()]);

    }



}
