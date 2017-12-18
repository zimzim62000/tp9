<?php

namespace App\Controller;


use App\AppAccess;
use App\Entity\NoteSkin;
use App\Entity\User;
use App\Entity\WeaponSkin;
use App\Event\WeaponSkinEvent;
use App\Form\WeaponSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

/**
 * @Route(path="/skin")
 */
class WeaponSkinController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_weaponskin_index"
     * )
     */
    public function indexdAction()
    {
        $em = $this->getDoctrine()->getManager();
        $skins = $em->getRepository(WeaponSkin::class)->findBy([],['createdAt' => 'DESC']);

        return $this->render('WeaponSkin/index.html.twig', ['skins' => $skins]);
    }

    /**
     * @Route(
     *     path="/show/{id}",
     *     name="app_weaponskin_show"
     * )
     */
    public function showAction(WeaponSkin $weaponSkin)
    {
        $notes = $this->getDoctrine()->getRepository(NoteSkin::class)->findBy(['id' => $weaponSkin->getId()],['note' => 'DESC']);
        return $this->render('WeaponSkin/show.html.twig', ['skin' => $weaponSkin, 'notes' => $notes]);
    }

    /**
     * @Route(
     *     path="/new",
     *     name="app_weaponskin_new"
     * )
     */
    public function newAction(Request $request, TokenInterface $token)
    {

        if (false === $authChecker->isGranted(AppAccess::WeaponSkinAdd, $noteSkin)) {
            return $this->redirectToRoute('card_index');
        }

        $form = $this->createForm(WeaponSkinType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $weaponSkin = $form->getData();
            /** @var WeaponSkinEvent $weaponSkinEvent */
            $weaponSkinEvent = $this->get(WeaponSkinEvent::class);
            $weaponSkinEvent->setUser($token->getUser());
            $weaponSkinEvent->setWeaponSkin($weaponSkin);



            return $this->redirectToRoute('app_weaponskin_index');
        }

        return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="app_weaponskin_edit"
     * )
     */
    public function editAction(Request $request, TokenInterface $token, WeaponSkin $weaponSkin)
    {

        if (false === $authChecker->isGranted(AppAccess::WeaPonSkinEdit, $weaponSkin)) {
            return $this->redirectToRoute('card_index');
        }

        $form = $this->createForm(WeaponSkinType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $weaponSkin = $form->getData();
            /** @var WeaponSkinEvent $weaponSkinEvent */
            $weaponSkinEvent = $this->get(WeaponSkinEvent::class);
            $weaponSkinEvent->setUser($token->getUser());
            $weaponSkinEvent->setWeaponSkin($weaponSkin);



            return $this->redirectToRoute('app_weaponskin_index');
        }

        return $this->render("NoteSkin/new.html.twig", ["form" => $form->createView()]);
    }

}
