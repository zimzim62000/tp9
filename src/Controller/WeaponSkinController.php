<?php
/**
 * Created by PhpStorm.
 * User: jeremyclerot
 * Date: 18/12/2017
 * Time: 14:16
 */

namespace App\Controller;

use App\Entity\WeaponSkin;
use App\Entity\NoteSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/weapon")
 */
class WeaponSkinController extends Controller
{
    /**
     * @Route(
     *     path="",
     *     name="weapon_index"
     * )
     */
    public function indexdAction(AuthorizationCheckerInterface $authorizationChecker)
    {
        $weapons = $this->getDoctrine()->getManager()->getRepository(WeaponSkin::class)->findAll();
        return $this->render('Weapon/index.html.twig', ["weapons" => $weapons]);
    }

    /**
     * @Route(
     *     path="{id}/show",
     *     name="app_weapon_show"
     * )
     */
    public function showAction(WeaponSkin $weapon){
        $notes = $this->getDoctrine()->getManager()->getRepository(NoteSkin::class)->findBy(["skin" => $weapon->getId()]);

        return $this->render('Weapon/show.html.twig', ['weapons' => $weapon, 'notes' => $notes]);
    }
}