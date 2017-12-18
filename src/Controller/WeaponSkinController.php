<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 14:16
 */

namespace App\Controller;

use App\AppEvent;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\WeaponSkinEvent;
use App\Form\WeaponSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/skin")
 */
class WeaponSkinController extends Controller
{
    /**
     * @Route(path="index", name="skin_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $skins = $em->getRepository(WeaponSkin::class)->findAll();
        return $this->render('Skin/index.html.twig', array("skins"=> $skins));
    }

    /**
     * @Route("/{id}", name="skin_view")
     */
    public function viewSkins(WeaponSkin $skin)
    {
        $em = $this->getDoctrine()->getManager();
        $notes = $em->getRepository(NoteSkin::class)->findBy(array('skin' => $skin->getId()));
        return $this->render("Skin/view.html.twig", array("skin" =>$skin, 'notes' => $notes));
    }

    /**
     * @Route(path="/new", name="skin_add")
     */
    public function newSkin(Request $request)
    {
        $skin = $this->get(WeaponSkin::class);
        $skin->setUser($this->getUser());
        $form = $this->createForm(WeaponSkinType::class, $skin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $event = $this->get(WeaponSkinEvent::class);
            $event->setSkin($skin);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::WEAPON_ADD, $event);

            return $this->redirectToRoute("skin_index");
        }
        return $this->render("Skin/new.html.twig", ["form"=>$form->createView()]);
    }

    /**
     * @Route(path="/{id}/edit", name="skin_edit")
     *
     */
    public function editAction(Request $request, WeaponSkin $weaponSkin)
    {
        $form = $this->createForm(WeaponSkinType::class, $weaponSkin);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(WeaponSkinEvent::class);
            $event->setSkin($weaponSkin);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::WEAPON_EDIT, $event);

            return $this->redirectToRoute("skin_index");
        }

        return $this->render("Skin/edit.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(path="/{id}/delete", name="skin_delete")
     *
     */
    public function deleteAction(WeaponSkin $weaponSkin)
    {
        $event = $this->get(WeaponSkinEvent::class);
        $event->setNote($weaponSkin);
        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::WEAPON_DEL, $event);

        return $this->redirectToRoute("skin_index");

    }
}