<?php

namespace App\Controller;


use App\AppAccess;
use App\AppEvent;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route(
     *     path="/new",
     *     name="app_noteskin_new"
     * )
     */
    public function newAction(Request $request, TokenInterface $token, WeaponSkin $weaponSkin, EventDispatcher $dispatcher)
    {


        $form = $this->createForm(NoteSkinType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $note = $form->getData();
            /** @var NoteSkinEvent $noteEvent */
            $noteEvent = $this->get(NoteSkinEvent::class);
            $noteEvent->setNote($note);
            $noteEvent->setWeaponSkin($weaponSkin);
            $noteEvent->setUser($token->getUser());

            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $noteEvent);

            return $this->redirectToRoute('app_weaponskin_index');
        }

        return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
    }


    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="app_noteskin_edit"
     * )
     */
    public function editAction(Request $request, TokenInterface $token, WeaponSkin $weaponSkin, EventDispatcher $dispatcher, NoteSkin $noteSkin)
    {

        if (false === $authChecker->isGranted(AppAccess::NoteSkinAdd, $noteSkin)) {
            return $this->redirectToRoute('card_index');
        }

        $form = $this->createForm(NoteSkinType::class,$noteSkin);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $note = $form->getData();
            /** @var NoteSkinEvent $noteEvent */
            $noteEvent = $this->get(NoteSkinEvent::class);
            $noteEvent->setNote($note);
            $noteEvent->setWeaponSkin($weaponSkin);
            $noteEvent->setUser($token->getUser());



            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $noteEvent);

            return $this->redirectToRoute('app_weaponskin_index');
        }

        return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
    }

}
