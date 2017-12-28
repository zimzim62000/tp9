<?php

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Form\NoteSkinType;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\AppEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;




/**
 * @Route(path="/noteSkin")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(path="/{id}/new", name="app_noteskin_add")
     *
     */
    public function addAction(Request $request, WeaponSkin $weaponSkin)
    {
        $noteSkin = $this->get(NoteSkin::class);

        $form = $this->createForm(NoteSkinType::class, $noteSkin);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(NoteSkinEvent::class);
            $noteSkin->setSkin($weaponSkin);
            $event->setNoteSkin($noteSkin);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $event);

            return $this->redirectToRoute("app_skin_index");
        }

        return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
    }
}
