<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 11/12/17
 * Time: 14:28
 */

namespace App\Controller;


use App\Entity\User;
use App\Entity\UserCard;
use App\Form\UserCardType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class UserCardController extends Controller
{

    /**
     * @Route(path="/newUserCard", name ="newusercard")
     */
    public function newUserCard(Request $request){
        $usercard = $this->get(\App\Entity\UserCard::class);
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserCardType::class, $usercard);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($usercard);
            $em->flush();
        }

        return $this->render("UserCard/new.html.twig", array("form"=>$form->createView()));
    }

    /**
     * @Route(path="/showUserCard")
     */
    public function show(){
        $em = $this->getDoctrine()->getManager();
        $usercards = $em->getRepository(UserCard::class)->findAll();

        return $this->render("UserCard/show.html.twig", array("usercard"=>$usercards));

    }

}