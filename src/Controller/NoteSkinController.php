<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 18/12/17
 * Time: 16:52
 */

namespace App\Controller;


use App\AppEvent;
use App\Entity\NoteSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/Note",
 *     name="app_index")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(path="/new",
     *     name="new")
     */
    public function newAction(Request $request)
    {

        $weapon = $this->get(NoteSkin::class);

        $form = $this->createForm(NoteSkinType::class, $weapon);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(NoteSkinEvent::class);
            $event->getWeaponSkin($weapon);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $event);

        }

        return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(path="/edit",
     *     name="edit")
     */
    public function editAction(Request $request, NoteSkin $note)
    {

        $form = $this->createForm(NoteSkinType::class, $note);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(NoteSkinEvent::class);
            $event->setUserCard($note);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_EDIT, $event);

        }

        return $this->render("NoteSkin/edit.html.twig", ["form" => $form->createView()]);
    }

    /**
    * @Route(path="/delete",
    *       name="edit")
    */
    public function deleteAction(NoteSkin $note)
    {

        $event = $this->get(NoteSkinEvent::class);
        $event->setUserCard($note);
        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::NOTE_SKIN_DELETE, $event);

        return $this->redirectToRoute("app_user_index");

    }


}