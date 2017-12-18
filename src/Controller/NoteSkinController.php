<?php
/**
 * Created by PhpStorm.
 * User: samuel.bigard
 * Date: 18/12/17
 * Time: 15:18
 */

namespace App\Controller;


use App\AppEvent;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NoteSkinController extends Controller
{
    /**
     * @Route(
     *     path="/note/{id}",
     *     name="new_note"
     * )
     */
    public function newNote(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $note = new NoteSkin();
        $skin = $em->getRepository(WeaponSkin::class)->find($id);
        $note->setSkin($skin);
        $note->setUser($this->getUser());
        $form = $this->createForm(NoteSkinType::class, $note);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $noteSkinEvent = $this->get(NoteSkinEvent::class);
            $noteSkinEvent->setNoteSkin($note);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTESKIN_ADD, $noteSkinEvent);
            return $this->redirectToRoute("show_skin", ["id" => $id]);
        }
        return $this->render("NoteSkin/new.html.twig", array("form"=>$form->createView()));
    }

    /**
     * @Route(
     *     path="/note/edit/{id}",
     *     name="edit_note"
     * )
     */
    public function editNote(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $note = $em->getRepository(NoteSkin::class)->find($id);
        $form = $this->createForm(NoteSkinType::class, $note);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $noteSkinEvent = $this->get(NoteSkinEvent::class);
            $noteSkinEvent->setNoteSkin($note);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTESKIN_EDIT, $noteSkinEvent);
            return $this->redirectToRoute("show_skin", ["id" => $note->getSkin()->getId()]);
        }
        return $this->render("NoteSkin/edit.html.twig", array("form"=>$form->createView()));
    }

    /**
     * @Route(
     *     path="/note/del/{id}",
     *     name="del_note"
     * )
     */
    public function delNote(NoteSkin $note){
        $noteSkinEvent = $this->get(NoteSkinEvent::class);
        $noteSkinEvent->setNoteSkin($note);
        $dispatcher = $this->get('event_dispatcher');
        $dispatcher->dispatch(AppEvent::NOTESKIN_REMOVE, $noteSkinEvent);
        return $this->redirectToRoute("show_skin", array("id"=>$note->getSkin()->getId()));
    }
}