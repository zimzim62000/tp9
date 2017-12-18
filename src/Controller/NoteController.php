<?php
namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
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

}