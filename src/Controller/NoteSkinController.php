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
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(path='/new', name="note_add")
     */
    public function newNote(Request $request)
    {
        $note = $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $event = $this->get(NoteSkinEvent::class);
            $event->setNews($note);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $event);

            return $this->redirectToRoute("news_index");
        }
        return $this->render("News/new.html.twig", ["form"=>$form->createView()]);
    }
}