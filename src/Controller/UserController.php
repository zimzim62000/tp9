<?php

namespace App\Controller;

use App\Entity\User;
use App\Security\UserVoter;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\UserCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

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
     *  @Route("/new", name="app_user_new")
     */
    public function newAction(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder){
        $form = $this->createForm(UserType::class, null, ['validation_groups' => 'new']);
        $form->handleRequest(($request));

        if ($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $user->setPassword($encoder->encoderPassword($user->getPassword()));

            $manager->persist($form->getData());
            $manager->flush();
            return $this->redirect($this->generateUrl('app_user_index'));
        }
        return $this->render('entity/User/index.html.twig', array('form' => $form->createView()));
    }
    /**
     *  @Route("/edit")
     */
    public function editAction(User $user,Request $request, EntityManagerInterface $manager){
        $this->denyAccessUnlessGranted(UserVoter::USER_CAN_VIEW, $user);

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest();
        if ($form->isSubmitted() && $form->isValid()){
            $manager->flush();
        }
    }
}
