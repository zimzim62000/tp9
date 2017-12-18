<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 14:16
 */

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Form\WeaponSkinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/skin")
 */
class WeaponSkinController extends Controller
{
    /**
     * @Route(path="index", name="skin_index")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $skins = $em->getRepository(WeaponSkin::class)->findAll();
        return $this->render('Skin/index.html.twig', array("skins"=> $skins));
    }

    /**
     * @Route("/{id}", name="skin_view")
     */
    public function viewSkins(WeaponSkin $skin)
    {
        $em = $this->getDoctrine()->getManager();
        $notes = $em->getRepository(NoteSkin::class)->findBy(array('skin' => $skin->getId()));
        return $this->render("Skin/view.html.twig", array("skin" =>$skin, 'notes' => $notes));
    }
}