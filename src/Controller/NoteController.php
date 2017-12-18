<?php
namespace App\Controller;

use App\AppAccess;
use App\AppEvent;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteType;
use App\WeaponSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class PlayerController
 * @package App\Controller
 * @Route("/note")
 */
class NoteController extends Controller
{
    /**
     *  @Route("/new", name="entity_note_new")
     */
    public function newPlayer(Request $request){

        $note = new NoteSkin();
        $form = $this->createForm(NoteType::class, $note);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($note);
            $em->flush();
            return $this->redirect($this->generateUrl('entity_note_index'));
        }
        return $this->render('entity/note/index.html.twig', array('form' => $form->createView()));
    }

    /**
     *  @Route("/index", name="entity_note_index")
     */
    public function index(){
        $em = $this->getDoctrine()->getManager();
        $notes = $em->getRepository(NoteSkin::class)->findAll();

        return $this->render('entity/note/note.html.twig', array("note" => $notes));
    }
    /**
     * @return Response
     * @Route("/show/{id}", name="entity_note_show")
     */
    public function show($id){
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(NoteSkin::class);
        $note = $repo->find($id);
        return $this->render('entity/note/show.html.twig', array('note' => $note));
    }

    /**
     * @Route(path="/{id}/edit", name="entity_note_edit")
     *
     */
    public function editAction(Request $request, NoteSkin $noteSkin, AuthorizationCheckerInterface $authorizationChecker)
    {
        if(false === $authorizationChecker->isGranted(AppAccess::NoteEdit, $noteSkin)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("entity_note_index");
        }
        $form = $this->createForm(NoteType::class, $noteSkin);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $event = $this->get(NoteSkinEvent::class);
            $event->setUserCard($noteSkin);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::USER_NOTE_EDIT, $event);
            return $this->redirectToRoute("app_user_index");
        }
        return $this->render("UserCard/edit.html.twig", ["form" => $form->createView()]);
    }
    /**
     * @Route(path="/{id}/delete", name="entity_note_delete")
     *
     */
    public function deleteAction(NoteSkin $noteSkin, AuthorizationCheckerInterface $authorizationChecker)
    {
        if(false === $authorizationChecker->isGranted(AppAccess::NoteEdit, $noteSkin)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("entity_note_index");
        }
        $event = $this->get(NoteSkinEvent::class);
        $event->setUserCard($noteSkin);
        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::USER_NOTE_DELETE, $event);
        return $this->redirectToRoute("entity_note_index");
    }


}