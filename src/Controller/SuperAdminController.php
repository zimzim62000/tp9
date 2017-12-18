<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 16/12/2017
 * Time: 20:52
 */
namespace App\Controller;

use App\AppAccess;
use App\Entity\NoteSkin;
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
 * @Route(path="/superadmin")
 */
class SuperAdminController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="superskin_index"
     * )
     */
    public function indexAction()
    {
        return $this->render('SuperAdmin/index.html.twig');
    }

    /**
     * @Route(
     *     path="/{id}/new",
     *     name="superskin_new"
     * )
     */
    public function newAction(Request $request,AuthorizationCheckerInterface $authorizationChecker)
    {
        if(!$authorizationChecker->isGranted('ROLE_SUPER_ADMIN')){
            return $this->redirectToRoute("skin_index");
        }
        $skin = $this->get(\App\Entity\WeaponSkin::class);
        $form = $this->createForm(NoteSkinType::class, $skin);
        $form->handleRequest($request);
        if( $form->isSubmitted() &&  $form->isValid() ) {
            $skinEvent = $this->get(\App\Event\SkinEvent::class);
            $skinEvent->setSkin($skin);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::SKIN_ADD, $skinEvent);
        }
        return $this->render('SuperAdmin/new.html.twig', array('form' => $form->createView()));
    }


    /**
     * @Route(
     *     path="/{id}/edit",
     *     name="superskin_edit"
     * )
     */
    public function editAction(Request $request,WeaponSkin $weaponskin, AuthorizationCheckerInterface $authorizationChecker)
    {
        if(!$authorizationChecker->isGranted('ROLE_SUPER_ADMIN')){
            return $this->redirectToRoute("skin_index");
        }

        $form = $this->createForm(NoteSkinType::class, $weaponskin);
        $form->handleRequest($request);
        if( $form->isSubmitted() &&  $form->isValid() ) {
            $skinEvent = $this->get(\App\Event\SkinEvent::class);
            $skinEvent->setSkin($weaponskin);
            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::SKIN_ADD, $skinEvent);
        }
        return $this->render('SuperAdmin/new.html.twig', array('form' => $form->createView()));
    }


}