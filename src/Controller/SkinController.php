<?php

namespace App\Controller;


use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/skin")
 */
class SkinController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="skin_index"
     * )
     */
    public function indexdAction()
    {
        $skins = $this->getDoctrine()->getManager()->getRepository(WeaponSkin::class)->findBy(array(), array('updatedAt' => 'desc'));
        return $this->render('Skin/index.html.twig', array('skins' => $skins));
    }


    /**
     * @Route(
     *     path="/{id}/show",
     *     name="skin_show"
     * )
     */
    public function showAction(WeaponSkin $weaponSkin)
    {
        $notes = $this->getDoctrine()->getManager()->getRepository(NoteSkin::class)->findBy(array('skin' => $weaponSkin));
        return $this->render('Skin/show.html.twig', array('skin' => $weaponSkin, 'notes' => $notes));
    }


}