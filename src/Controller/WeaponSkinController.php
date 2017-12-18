<?php

namespace App\Controller;


use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
}
