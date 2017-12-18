<?php

namespace App\Controller;


use App\AppAccess;

use App\AppEvent;
use App\Entity\WeaponSkin;


use App\Event\WeaponSkinEvent;
use App\Form\WeaponSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/WeaponSkin")
 */
class WeaponSkinController extends Controller
{

    /**
     * @Route(
     *     path="/index",
     *     name="app_user_index"
     * )
     */
    public function indexAction()
    {

        $WeaponSkins = $this->getDoctrine()->getManager()->getRepository(WeaponSkin::class)->findAll();


        return $this->render('WeaponSkin/index.html.twig', ["WeaponSkin" => $WeaponSkins]);
    }

    /**
     * @Route(path="/new", name="WeaponSkin_new")
     *
     */
    public function newAction(Request $request)
    {
        $weapon = $this->get(WeaponSkin::class);

        $form = $this->createForm(WeaponSkinType::class, $weapon);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(WeaponSkinEvent::class);
            $event->getWeaponSkin($weapon);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::WEAPON_SKIN_ADD, $event);

            return $this->redirectToRoute("app_user_index");
        }

        return $this->render("WeaponSkin/new.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(
     *     path="/edit",
     *     name="edit_WeaponSkin"
     * )
     */
    public function editAction(WeaponSkin $weapon, Request $request,EventDispatcherInterface $dispatcher)
    {
        $weapon = $this->getUser();
        $form = $this->createForm(WeaponSkinType::class,$weapon);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $WeaponEvent = new WeaponSkin($form->getData());
            $dispatcher->dispatch(AppEvent::WEAPON_SKIN_EDIT, $WeaponEvent);
            return $this->redirectToRoute("app_user_index");
        }

        return $this->render("WeaponSkin/new.html.twig", array("form"=>$form->createView()));

    }

    /**
     * @Route(
     *     path="/delete",
     *     name="delete_WeaponSkin"
     * )
     */
    public function deleteAction(WeaponSkin $weapon)
    {

        $event = $this->get(WeaponSkinEvent::class);
        $event->setWeaponSkin($weapon);
        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::WEAPON_SKIN_DELETE, $event);

        return $this->redirectToRoute("app_user_index");

    }


}