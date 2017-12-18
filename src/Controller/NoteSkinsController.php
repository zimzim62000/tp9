<?php
/**
 * Created by PhpStorm.
 * User: adrien.leduc
 * Date: 18/12/17
 * Time: 16:37
 */

namespace App\Controller;


use App\Entity\NoteSkin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
class NoteSkinsController extends Controller
{
    /**
     * @Route(path="/NoteSkin/new", name="noteskins_new")
     */
    public function newAction(Request $request)
    {
        // Seul les auteurs doivent avoir access.
        if($this->getUser()->isAuthor() == true){
            $article = new NoteSkin();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(NoteSkin::class, $article);
            $form->handleRequest($request);
            if($form->isSubmitted() && $form->isValid())
            {
                $em->persist($article);
                $em->flush();
            }
            return $this->render("Article/new.html.twig", array("form"=>$form->createView()));
        }
    }

    /**
     * @Route(path="/NoteSkin/trier", name="noteskins_trier")
     */
    public function newTrier(Request $request)
    {
        return $this->render("Article/trier.html.twig");
    }

}