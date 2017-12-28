<?php

namespace App\Controller;


use App\AppAccess;
use App\Entity\Card;
use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/Weapon/Skin")
 */
class WeaponSkinController extends Controller {
    /**
     * @Route(
     *     path="/",
     *     name="app_weapons_skins_index"
     * )
     */
    public function indexdAction() {

        $em = $this->getDoctrine()->getManager();
        $weaponSkins = $em->getRepository(WeaponSkin::class)->findAll();

        return $this->render('WeaponSkin/index.html.twig', ['weaponSkins' => $weaponSkins]);
    }

    /**
     * @Route(
     *     path="{id}/show",
     *     name="app_weapons_show_show"
     * )
     */
    public function showAction(WeaponSkin $weaponSkin, AuthorizationCheckerInterface $authChecker){

        return $this->render('WeaponSkin/show.html.twig', ['weaponSkins' => $weaponSkins]);
    }
}
