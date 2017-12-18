<?php

namespace App\Controller;


use App\AppAccess;
use App\AppEvent;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(
     *     path="",
     *     name="note_index"
     * )
     */
    public function indexAction()
    {
        return $this->render('Note/index.html.twig');
    }

    /**
     * @Route(
     *     path="/new/{id}",
     *     name="note_index"
     * )
     */
    public function newAction(Request $request, WeaponSkin $skin)
    {
        $noteSkin = $this->get(NoteSkin::class);

        $form = $this->createForm(NoteSkinType::class, $noteSkin, ["skin" => $skin]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(NoteSkinEvent::class);
            $event->setNoteSkin($noteSkin);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $event);

            return $this->redirectToRoute("user_index");
        }

        return $this->render("Note/new.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(path="/delete/{id}", name="note_delete")
     *
     */
    public function deleteAction(NoteSkin $noteSkin, AuthorizationCheckerInterface $authorizationChecker)
    {
       /* if(false === $authorizationChecker->isGranted(AppAccess::NoteRemove, $noteSkin)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("user_index");
        }*/

        $event = $this->get(NoteSkinEvent::class);
        $event->setNoteSkin($noteSkin);
        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::NOTE_DELETE, $event);

        return $this->redirectToRoute("user_index");

    }
}
