<?php
/**
 * Created by PhpStorm.
 * User: bastien.cornu
 * Date: 18/12/17
 * Time: 14:27
 */

namespace App\Controller;
use App\Entity\WeaponSkin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/weaponskin")
 */
class WeaponSkinController extends Controller
{

    /**
     * @Route("/", name="app_weaponskin_index")
     */
    public function indexAction(EntityManagerInterface $em){
        $weapons = $this->getDoctrine()->getRepository(WeaponSkin::class)->findBy(array(),array('updatedAt' => 'DESC'));
        return $this->render("WeaponSkin/index.html.twig",["weapons" => $weapons]);
    }

    /**
     * @Route("/show/{id}", name="app_weaponskin_show")
     */
    public function showAction(WeaponSkin $weaponSkin){
        $weapon = $this->getDoctrine()->getRepository(WeaponSkin::class)->findBy(['id'=>$weaponSkin->getId()]);
        return $this->render("WeaponSkin/show.html.twig",["weapon" => $weapon]);
    }
}