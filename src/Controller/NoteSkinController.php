<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 14:57
 */

namespace App\Controller;


use App\AppEvent;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Class WeaponSkinController
 * @package App\Controller
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * WeaponSkinController constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @Route(path="{id}/new", name="note_new")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, $id){
        /**
         * @var $noteSkin NoteSkin
         */
        $noteSkin = $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $noteSkin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /**
             * @var $noteSkinEvent NoteSkinEvent
             */
            $noteSkinEvent = $this->get(NoteSkinEvent::class);
            $noteSkin->setUser($this->getUser());
            $noteSkin->setCreatedAt(new \DateTime());
            $noteSkin->setSkin($this->em->getRepository(WeaponSkin::class)->findOneBy(array('id' => $id)));
            $noteSkinEvent->setNoteSkin($noteSkin);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $noteSkinEvent);
            $this->container->get('session')->getFlashBag()->add("success", "Ajout d'une note");
            return $this->redirect($this->generateUrl("skin_index"));
        }
        return $this->render('Note/new.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route(path="{id}/new", name="note_edit")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, $id){
        /**
         * @var $noteSkin NoteSkin
         */
        $noteSkin = $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $noteSkin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /**
             * @var $noteSkinEvent NoteSkinEvent
             */
            $noteSkinEvent = $this->get(NoteSkinEvent::class);
            $noteSkinEvent->setNoteSkin($noteSkin);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_EDIT, $noteSkinEvent);
            return $this->redirect($this->generateUrl("skin_index"));
        }
        return $this->render('Note/edit.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route(path="{id}/delete", name="note_delete")
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteAction(Request $request, $id){
        /**
         * @var $noteSkin NoteSkin
         */
        $noteSkin = $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $noteSkin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /**
             * @var $noteSkinEvent NoteSkinEvent
             */
            $noteSkinEvent = $this->get(NoteSkinEvent::class);
            $noteSkin = $this->em->getRepository(NoteSkin::class)->findOneBy(array('id' => $id));
            $noteSkinEvent->setNoteSkin($noteSkin);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_DELETE, $noteSkinEvent);
            return $this->redirect($this->generateUrl("skin_index"));
        }
        return $this->render('Note/delete.html.twig', array('form' => $form->createView()));
    }
}