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
use App\Event\NoteSkinEvent;
use App\Form\NoteSkinType;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route(path="{noteid}/new", name="note_new")
     */
    public function newAction(Request $request, $cardid){
        $noteSkin = $this->get(NoteSkin::class);
        $form = $this->createForm(NoteSkinType::class, $noteSkin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $noteSkinEvent = $this->get(NoteSkinEvent::class);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::NOTE_SKIN_ADD, $noteSkinEvent);
            return $this->redirect($this->generateUrl("usercard_show_index"));
        }
        return $this->render('Note/new.html.twig', array('form' => $form->createView()));
    }
}