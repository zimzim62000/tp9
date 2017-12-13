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
        $repo = $em->getRepository(UserCard::class);
        $cards = $repo->findBy(array('user' => $this->getUser()->getId()));

        return $this->render('User/index.html.twig', array('cards' => $cards));
    }


}
