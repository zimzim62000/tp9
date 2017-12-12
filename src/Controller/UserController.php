<?php

namespace App\Controller;


use App\Entity\UserCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
