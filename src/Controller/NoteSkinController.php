<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 18/12/2017
 * Time: 14:27
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
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(
     *     path="/add/{id}",
     *     name="note_add"
     * )
     */
    public function add(Request $request, $id)
    {
        $note = $this->get(NoteSkin::class);
        $em = $this->getDoctrine()->getManager();
        $currentSkin = $em->getRepository(NoteSkin::class)->findBy(['id'=> $id]);
        $note->setSkin($currentSkin);
        $form = $this->createForm(NoteSkinType::class,$note);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $event = $this->get(NoteSkinEvent::class);
            $event->setNoteSkin($note);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $event);

            return $this->redirectToRoute("skin_index");
        }

        return $this->render("NoteSkin/add.html.twig", ["form" => $form->createView()]);
    }
}
