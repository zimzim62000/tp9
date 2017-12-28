<?php

namespace App\Controller;

use App\AppAccess;
use App\Entity\WeaponSkin;
use App\Entity\NoteSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/weaponskin")
 */
class WeaponSkinController extends Controller
{

    /**
     * @Route(path="", name="weaponskin_index")
     */
    public function indexdAction(AuthorizationCheckerInterface $authorizationChecker)
    {
        $weapons = $this->getDoctrine()->getManager()->getRepository(WeaponSkin::class)->findAll();

        return $this->render('Weapon/index.html.twig', ['weapons' => $weapons]);
    }

    /**
     * @Route(path="{id}/show", name="weaponskin_show")
     */
    public function showAction(WeaponSkin $weapon){
        $notes = $this->getDoctrine()->getManager()->getRepository(NoteSkin::class)->findBy(["skin" => $weapon->getId()]);

        return $this->render('Weapon/show.html.twig', ['weapons' => $weapon, 'notes' => $notes]);
    }
}
