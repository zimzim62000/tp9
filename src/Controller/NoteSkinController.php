<?php
/**
 * Created by PhpStorm.
 * User: jeremyclerot
 * Date: 18/12/2017
 * Time: 16:35
 */

namespace App\Controller;

use App\AppAccess;
use App\Entity\NoteSkin;
use App\Entity\User;
use App\AppEvent;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/noteskin")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(
     *     path="/{id}/new",
     *     name="noteskin_new"
     * )
     */
    public function newAction(Request $request, WeaponSkin $weaponskin, AuthorizationChecker $authorizationChecker)
    {
        $noteskin = $this->get(\App\Entity\NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $noteskin, ['weaponskin' => $weaponskin]);
        $form->handleRequest($request);

        if( $form->isSubmitted() &&  $form->isValid() ) {
            $noteskinEvent = $this->get(\App\Event\NoteSkinEvent::class);
            $noteskinEvent->setNoteskin($noteskin);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $noteskinEvent);
        }

        return $this->render('NoteSkin/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route(path="/{id}/remove", name="noteskin_delete")
     *
     */
    public function deleteAction(NoteSkin $noteSkin, AuthorizationCheckerInterface $authorizationChecker)
    {
        if(false === $authorizationChecker->isGranted(AppAccess::UserCardDelete, $noteSkin)){
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("weapon_index");
        }

        $event = $this->get(NoteSkinEvent::class);
        $event->setUserCard($noteSkin);
        $dispatcher = $this->get("event_dispatcher");
        $dispatcher->dispatch(AppEvent::NOTE_SKIN_DELETE, $event);

        return $this->redirectToRoute("weapon_index");
    }
}