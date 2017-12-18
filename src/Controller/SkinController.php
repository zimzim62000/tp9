<?php
/**
 * Created by PhpStorm.
 * User: quentin.geeraert
 * Date: 18/12/17
 * Time: 14:17
 */

namespace App\Controller;

use App\Entity\WeaponSkin;
use App\Entity\NoteSkin;
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
    public function indexdAction()
    {
        //lister les skins
        $Skins = $this->getDoctrine()->getRepository(WeaponSkin::class)->findAll();

        return $this->render('Skin/index.html.twig', ['skins' => $Skins]);
    }

    /**
     * @Route(
     *     path="/show/{id}",
     *     name="skin_show"
     * )
     */
    public function showAction($id)
    {
        $skin = $this->getDoctrine()->getRepository(WeaponSkin::class)->findBy(array("id" => $id));

        $notes = $this->getDoctrine()->getRepository(NoteSkin::class)->findBy(array("skin" => $id));

        return $this->render('Skin/show.html.twig', ['skin' => $skin[0], "notes" => $notes]);
    }
}