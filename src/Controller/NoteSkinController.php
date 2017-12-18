<?php

namespace App\Controller;


use App\AppAccess;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(
     *     path="/add/{id}",
     *     name="add_note"
     * )
     */
    public function addNoteAction(WeaponSkin $skin)
    {


        return null;//$this->redirectToRoute('app_skin_show',['id' => $note->getSkin()->getId()]);
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="edit_note"
     * )
     */
    public function editNoteAction(WeaponSkin $skin)
    {

        return null;//$this->redirectToRoute('app_skin_show',['id' => $note->getSkin()->getId()]);
    }


    /**
     * @Route(
     *     path="/remove/{idNote}",
     *     name="remove_note"
     * )
     */
    public function removeNoteAction(NoteSkin $note){
        $em = $this->getDoctrine()->getManager();

        $em->remove($note);

        $em->flush();

        return $this->redirectToRoute('app_skin_show',['id' => $note->getSkin()->getId()]);
    }

}
