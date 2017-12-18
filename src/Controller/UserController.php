<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Security\UserVoter;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

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
     * @Route(path="/register", name="app_user_register")
     *
     */
    public function newAction(Request $request, EntityManager $entityManager, UserPasswordEncoderInterface $userPasswordEncoder)
    {

        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            /** @var $user User */
            $user->setPassword($userPasswordEncoder->encodePassword($user, $user->getPassword()));
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_user_index');
        }

        return $this->render("User/new.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(path="/edit", name="app_user_edit")
     */
    public function editUser(Request $request, UserPasswordEncoderInterface $userPasswordEncoder){
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user1 = $form->getData();
            $user->setPassword($userPasswordEncoder->encodePassword($user, $user->getPassword()));

            $this->getDoctrine()->getManager()->persist($user1);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('app_user_index');
        }

        return $this->render("User/new.html.twig", ["form" => $form->createView()]);

    }

}
