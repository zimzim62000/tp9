<?php

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteEvent;
use App\Form\NoteType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\AppEvent;

/**
 * @Route(path="/note")
 */
class NoteController extends Controller
{
    /**
     * @Route(
     *     path="/add/{id}",
     *     name="app_note_add"
     * )
     */
    public function addAction(Request $request, WeaponSkin $skin)
    {
        $note = $this->get(NoteSkin::class);

        $form = $this->createForm(NoteType::class, $note, ["skin" => $skin]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(NoteEvent::class);
            $event->setNote($note);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $event);

            return $this->redirectToRoute('app_skin_show', ['id' => $skin->getId()]);
        }

        return $this->render('Note/new.html.twig', ['skin' => $skin, 'form' => $form->createView()]);
    }
}
