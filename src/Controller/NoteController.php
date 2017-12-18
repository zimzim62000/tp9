<?php
/**
 * Created by PhpStorm.
 * User: quentin.geeraert
 * Date: 18/12/17
 * Time: 14:59
 */

namespace App\Controller;

use App\Entity\WeaponSkin;
use App\Entity\NoteSkin;
use App\Event\AppEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/note")
 */
class NoteController extends Controller
{
    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="editer_note"
     * )
     */
    public function editAction(Request $request, NoteSkin $noteSkin){

        $form = $this->createForm(NoteSkinType::class, $noteSkin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $noteSkin = $form->getData();
            $noteSkinEvent = $this->get("App\Event\SkinNoteEvent");
            $noteSkinEvent->setSkinnote($noteSkin);

            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::SKIN_NOTE_EDIT, $noteSkinEvent);
            return $this->redirectToRoute("user_index", [], $status = 302);
        }
        return $this->render("Note/edit.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route("/add", name="add_note")
     */
    public function addAction(Request $request){

        $noteSkin = $this->get(\App\Entity\NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $noteSkin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $noteSkin = $form->getData();
            $noteSkinEvent = $this->get("App\Event\SkinNoteEvent");
            $noteSkinEvent->setSkinnote($noteSkin);

            // dispatcher
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::SKIN_NOTE_ADD, $noteSkinEvent);
            return $this->redirectToRoute('user_index', [], $status = 302);
        }
        return $this->render('Note/add.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/noter", name="noter")
     */
    public function noterAction(Request $request)
    {
        echo "FIXME";
    }

    /**
     * @Route("/delete/{id}", name="supprimer_note")
     */
    public function deleteAction(NoteSkin $noteSkin){

        $noteSkinEvent = $this->get("App\Event\SkinNoteEvent");
        $noteSkinEvent->setSkinnote($noteSkin);

        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::SKIN_NOTE_DELETE, $noteSkinEvent);
        return $this->redirectToRoute("user_index", [], 302);
    }

}