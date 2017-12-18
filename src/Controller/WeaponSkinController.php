<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 14:17
 */

namespace App\Controller;

use App\AppEvent;
use App\Entity\WeaponSkin;
use App\Entity\WeaponSkin;
use App\Event\WeaponSkinEvent;
use App\Form\WeaponSkinType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class WeaponSkinController
 * @package App\Controller
 * @Route(path="/skin")
 */
class WeaponSkinController extends Controller
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
     * @Route(path="/", name="skin_index")
     */
    public function indexAction(){
        $skins = $this->em->getRepository(WeaponSkin::class)->findBy(array(), array('updated_at' => 'DESC'));
        return $this->render('Skin/index.html.twig', array('skins' => $skins));
    }

    /**
     * @Route(path="/{id}", name="skin_show")
     */
    public function showAction($id){
        $skin = $this->em->getRepository(WeaponSkin::class)->find($id);
        $notes = $this->em->getRepository(WeaponSkin::class)->findBy(array('skin' => $skin), array('note' => 'DESC'));
        return $this->render('Skin/show.html.twig', array('skin' => $skin, 'notes' => $notes));
    }

    public function newAction(Request $request){
        /**
         * @var $weaponSkin WeaponSkin
         */
        $weaponSkin = $this->get(WeaponSkin::class);
        $form = $this->createForm(WeaponSkinType::class, $weaponSkin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            /**
             * @var $weaponSkinEvent WeaponSkinEvent
             */
            $weaponSkinEvent = $this->get(WeaponSkinEvent::class);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::WEAPON_SKIN_ADD, $weaponSkinEvent);
            $this->container->get('session')->getFlashBag()->add("success", "Ajout d'un skin");
            return $this->redirect($this->generateUrl("skin_index"));
        }
        return $this->render('Skin/new.html.twig', array('form' => $form->createView()));
    }
}