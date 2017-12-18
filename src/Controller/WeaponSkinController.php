<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 18/12/2017
 * Time: 14:27
 */

namespace App\Controller;


use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/weaponSkin")
 */
class WeaponSkinController extends Controller
{
    /**
     * @Route(
     *     path="",
     *     name="skin_index"
     * )
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $weaponSkins = $em->getRepository(WeaponSkin::class)->findAll();

        return $this->render('Admin/index.html.twig', ['skins' => $weaponSkins]);
    }
}
