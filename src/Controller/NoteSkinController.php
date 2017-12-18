<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 18/12/17
 * Time: 15:28
 */

namespace App\Controller;


use App\Entity\NoteSkin;
use App\AppEvent;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class NoteSkinController extends Controller
{
    /**
     * @Route(path="/{id}/new", name="app_note_new")
     *
     */
    public function newAction(Request $request,WeaponSkin $weaponSkin)
    {
        $person= $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $person,["weapon" => $weaponSkin]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $event = $this->get(NoteSkinEvent::class);
            $event->setNoteSkin($person);
            $dispatcher = $this->get("event_dispatcher");
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $event);
            $this->redirectToRoute("home_index");
        }
        return $this->render("NoteSkin/add.html.twig", ["form" => $form->createView()]);
    }
}