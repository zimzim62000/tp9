<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 18/12/17
 * Time: 14:40
 */

namespace App\Controller;

use App\AppEvent;
use App\Entity\NoteSkin;
use App\Form\NoteSkinType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NoteSkinController extends Controller
{
    /**
     * @return Response
     * @Route("/skin/new", name="note_form_add")
     */
    public function form_add(Request $request) {
        $note = $this->get(\App\Entity\NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $note);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $noteEvent = $this->get('app.note.event');
            $noteEvent->setNote($note);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $noteEvent);
            return $this->redirectToRoute('weapon_index');
        }
        return $this->render('Skin/player_new.html.twig',array('form' => $form->createView()));
    }

    /**
     * @return Response
     * @Route("/note/edit/{id}", name="note_form_edit")
     */
    public function form_edit($id, Request $request) {
        $note = $this->getDoctrine()->getManager()->getRepository(\App\Entity\NoteSkin::class)->find($id);
        $form = $this->createForm(NoteSkinType::class, $note);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $noteEvent = $this->get('app.note.event');
            $noteEvent->setNote($note);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_EDIT, $noteEvent);
            return $this->redirectToRoute('weapon_index');
        }
        return $this->render('Skin/form.html.twig',array('form' => $form->createView()));
    }
}