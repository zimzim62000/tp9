<?php

namespace App\Controller;


use App\AppAccess;

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
     *     path="",
     *     name="skin_index"
     * )
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skins = $em->getRepository(WeaponSkin::class)->findBy(array (), array('updatedAt'=>'desc'));

        return $this->render('Skin/index.html.twig', ['skins' => $skins]);
    }

    /**
    * @Route(
    *     path="/show/{id}",
    *     name="skin_show"
    * )
    */
    public function showAction(WeaponSkin $skin){

        $em = $this->getDoctrine()->getManager();

        $notes = $em->getRepository(NoteSkin::class)->findBy(array (), array('note'=>'desc'));

        return $this->render('Skin/show.html.twig', ['skin' => $skin,'notes'=>$notes]);
    }


}
