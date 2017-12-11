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

        $em = $this->getDoctrine()->getManager();

        $userCard = $em->getRepository(UserCard::class)->findBy(array("user"=>$this->getUser()));

        return $this->render('User/index.html.twig',['usercards' => $userCard]);


    }
}
