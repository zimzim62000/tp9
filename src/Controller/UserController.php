<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserCard;
use App\Form\UserType;
use App\Security\UserVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route(path="/user")
 */
class UserController extends Controller
{
    /**
     * @Route(
     *     path="",
     *     name="user_index"
     * )
     */
    public function indexdAction()
    {
    	$userCards = $this->getDoctrine()->getManager()->getRepository(UserCard::class)->findBy(["user" => $this->getUser()]);
     
    	return $this->render('User/index.html.twig', ["userCards" => $userCards]);
    }
    
    /**
     * @Route(
     *     path="/new",
     *     name="user_new"
     * )
     */
    public function newUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
	    $form = $this->createForm(UserType::class);
	
	    $form->handleRequest($request);
	
	    if($form->isSubmitted() && $form->isValid()){
		    /** @var User $user */
	    	$user = $form->getData();
		    
		    $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
		    $this->getDoctrine()->getManager()->persist($user);
		    $this->getDoctrine()->getManager()->flush();
		    
		    return $this->redirectToRoute("user_index", [], $status = 302);
	    }
	
	    return $this->render('User/new.html.twig', ["form" => $form->createView()]);
    }
    
    /**
     * @Route(
     *     path="/edit",
     *     name="user_edit"
     * )
     */
    public function editUser(Request $request, UserPasswordEncoderInterface $encoder)
    {
	    $form = $this->createForm(UserType::class, $this->getUser());
	
	    $form->handleRequest($request);
	
	    if($form->isSubmitted() && $form->isValid()){
		    $user = $form->getData();
		    
		    $user->setPassword($encoder->encodePassword($user, $user->getPassword()));
		    $this->getDoctrine()->getManager()->persist($user);
		    $this->getDoctrine()->getManager()->flush();
		    
		    return $this->redirectToRoute("user_index", [], $status = 302);
	    }
	
	    return $this->render('User/new.html.twig', ["form" => $form->createView()]);
    }
	
	/**
	 * @Route(
	 *     path="/edit/{id}",
	 *     name="user_action_edit"
	 * )
	 */
	public function editUserAction(Request $request, UserPasswordEncoderInterface $encoder, AuthorizationCheckerInterface $authorizationChecker, User $user )
	{
		
		if(false === $authorizationChecker->isGranted(UserVoter::USER_CAN_VIEW, $user)){
			return $this->redirectToRoute("user_index", [], 302);
		}
		
		$form = $this->createForm(UserType::class, $user);
		
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid()){
			$user = $form->getData();
			
			$user->setPassword($encoder->encodePassword($user, $user->getPassword()));
			$this->getDoctrine()->getManager()->persist($user);
			$this->getDoctrine()->getManager()->flush();
			
			return $this->redirectToRoute("user_index", [], $status = 302);
		}
		
		return $this->render('User/new.html.twig', ["form" => $form->createView()]);
	}
 
}
