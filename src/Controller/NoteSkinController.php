<?php

namespace App\Controller;

use App\AppAccess;
use App\Entity\User;
use App\AppEvent;
use App\Entity\WeaponSkin;
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
     * @Route(path="/{id}/new", name="noteskin_new")
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
}