<?php
/**
 * Created by PhpStorm.
 * User: samuel.bigard
 * Date: 18/12/17
 * Time: 14:16
 */

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
     *     path="/list",
     *     name="skin_list"
     * )
     */
    public function listSkin(){
        $skins = $this->getDoctrine()->getRepository(WeaponSkin::class)->findBy(
            array(), array("updatedAt" => "desc")
        );

        return $this->render('WeaponSkin/list.html.twig', ['skins' => $skins]);
    }

    /**
     * @Route(
     *     path="/{id}",
     *     name="show_skin"
     * )
     */
    public function showSkin(WeaponSkin $weaponSkin){
        $bool = false;

        $notes = $this->getDoctrine()->getRepository(NoteSkin::class)->findBy(
            array("skin" => $weaponSkin->getId())
        );

        foreach ($notes as $note){
            if($note->getUser() == $this->getUser())
                $bool=true;
        }
        return $this->render('WeaponSkin/show.html.twig', ['skin' => $weaponSkin, "notes" => $notes, "aNote" => $bool]);
    }


}