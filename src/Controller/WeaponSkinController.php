<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 18/12/17
 * Time: 14:40
 */

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use App\Form\WeaponSkinType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WeaponSkinController extends Controller
{
    /**
     * @return Response
     * @Route("/skin/show/{id}", name="skin_show")
     */
    public function show($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(WeaponSkin::class);
        $skin = $repo->find($id);
        $tabNotes = $em->getRepository(NoteSkin::class)->findBy(array('skin'=>$skin));
        return $this->render('Skin/show.html.twig',array('skin' => $skin, 'notes' => $tabNotes));
    }

    /**
     * @return Response
     * @Route("/skin/index", name="skin_index")
     */
    public function index() { //list
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(WeaponSkin::class);
        //$tabSkins = $repo->getSkinByDateUpdate();
        $tabSkins = $repo->findAll();
        return $this->render('Skin/index.html.twig',array('tabSkins' => $tabSkins));
    }
}