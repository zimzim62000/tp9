<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 14:52
 */

namespace App\Controller;


use App\AppEvent;
use App\Entity\NoteSkin;
use App\Entity\User;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(path="/{id}/new", name="note_add")
     */
    public function newNote(Request $request, WeaponSkin $skin)
    {
        $note = $this->get(NoteSkin::class);
        $note->setUser($this->getUser());
        $note->setSkin($skin);
        $form = $this->createForm(NoteSkinType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $event = $this->get(NoteSkinEvent::class);
            $event->setNote($note);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $event);

            return $this->redirectToRoute("skin_index");
        }
        return $this->render("Note/new.html.twig", ["form"=>$form->createView()]);
    }
}