<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 18/12/17
 * Time: 15:28
 */

namespace App\Controller;


use App\AppAccess;
use App\Entity\NoteSkin;
use App\AppEvent;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class NoteSkinController extends Controller
{
    /**
     * @Route(path="/new/{id}", name="app_note_new")
     *
     */
    public function newAction(Request $request,WeaponSkin $weaponSkin)
    {
        $person= $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $person,["weapon" => $weaponSkin]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $event = $this->get(NoteSkinEvent::class);
            $event->setNoteSkin($person);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $event);
            $this->redirectToRoute("home_index");
        }
        return $this->render("NoteSkin/add.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(path="/edit/{id}", name="app_note_edit")
     *
     */
    public function editAction(Request $request, NoteSkin $noteSkin, AuthorizationCheckerInterface $authorizationChecker)
    {

        if(false === $authorizationChecker->isGranted(AppAccess::NoteEdit, $noteSkin)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("skin_index");
        }

        $form = $this->createForm(NoteSkinType::class, $noteSkin);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(NoteSkinEvent::class);
            $event->setNoteSkin($noteSkin);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_EDIT, $event);

            return $this->redirectToRoute("home_index");
        }

        return $this->render("NoteSkin/edit.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(path="/delete/{id}", name="app_note_delete")
     *
     */
    public function deleteAction(NoteSkin $noteSkin, AuthorizationCheckerInterface $authorizationChecker)
    {
        if(false === $authorizationChecker->isGranted(AppAccess::NoteEdit, $noteSkin)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("home_index");
        }

        $event = $this->get(NoteSkinEvent::class);
        $event->setNoteSkin($noteSkin);
        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::NOTE_DELETE, $event);

        return $this->redirectToRoute("home_index");

    }
}