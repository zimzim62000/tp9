<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 18/12/17
 * Time: 14:29
 */

namespace App\Controller;


use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Event\NoteSkinEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WeaponSkinController extends Controller
{
    /**
     * @Route(
     *     path="/skin",
     *     name="skin_index"
     * )
     */
    public function indexAction()
    {
        $this->get(NoteSkin::class);
        $em = $this->getDoctrine()->getManager();
        $skins = $em->getRepository(WeaponSkin::class)->findAll();
        return $this->render('WeaponSkin/index.html.twig', ['skins' => $skins]);
    }

    /**
     * @Route(
     *     path="/skin/{id}",
     *     name="app_skin_index"
     * )
     */
    public function showAction(WeaponSkin $weaponSkin)
    {
        return $this->render('WeaponSkin/show.html.twig', ['weaponSkin' => $weaponSkin]);
    }

}