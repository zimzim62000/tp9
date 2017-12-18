<?php
/**
 * Created by PhpStorm.
 * User: bastien.cornu
 * Date: 18/12/17
 * Time: 15:45
 */

namespace App\Controller;


use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use App\Event\AppEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/noteskin")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route("/add/{id}" , name="app_noteskin_add")
     */
    public function addAction(Request $request, WeaponSkin $weaponSkin)
    {
        $note = $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $note);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $noteEvent = $this->get(NoteSkinEvent::class);
            /** @var NoteSkin $noteEvent */
            $note->setSkin($this->getDoctrine()->getRepository(WeaponSkin::class)->findOneBy(['id'=>$weaponSkin->getId()]));
            $note->setUser($this->getUser());
            $noteEvent->setNote($note);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $noteEvent);

            return $this->redirect($this->generateUrl('app_weaponskin_show', ["id"=>$weaponSkin->getId()]));
        }
        return $this->render("NoteSkin/add.html.twig", ['form' => $form->createView(),]);

    }

    /**
     * @Route("/edit/{id}" , name="app_noteskin_edit")
     */
    public function editAction(Request $request, WeaponSkin $weaponSkin, AuthorizationCheckerInterface $authorizationChecker)
    {
        $note = $this->get(NoteSkin::class);
        if (false === $authorizationChecker->isGranted(AppEvent::NOTE_EDIT, $note)) {
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("app_weaponskin_index");
        }
        $form = $this->createForm(NoteSkinType::class, $note);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $noteEvent = $this->get(NoteSkinEvent::class);
            /** @var NoteSkin $noteEvent */
            $noteEvent->setNote($note);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $noteEvent);

            return $this->redirect($this->generateUrl('app_weaponskin_index'));
        }
        return $this->render("NoteSkin/add.html.twig", ['form' => $form->createView(),]);

    }

    /**
     * @Route("/delete/{id}" , name="app_noteskin_delete")
     */
    public function deleteAction(Request $request, WeaponSkin $weaponSkin, AuthorizationCheckerInterface $authorizationChecker)
    {
        $note = $this->get(NoteSkin::class);
        if (false === $authorizationChecker->isGranted(AppEvent::NOTE_DELETE, $note)) {
            $this->addFlash('error', 'access deny !');
            return $this->redirectToRoute("app_weaponskin_index");
        }
        $form = $this->createForm(NoteSkinType::class, $note);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $noteEvent = $this->get(NoteSkinEvent::class);
            /** @var NoteSkin $noteEvent */
            $noteEvent->setNote($note);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_ADD, $noteEvent);

            return $this->redirect($this->generateUrl('app_weaponskin_index'));
        }
        return $this->render("NoteSkin/add.html.twig", ['form' => $form->createView(),]);

    }
}