<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 18/12/2017
 * Time: 14:27
 */

namespace App\Controller;


use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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
        $weaponSkins = $em->getRepository(WeaponSkin::class)->findBy([], ['createdAt' => 'ASC']);

        return $this->render('WeaponSkin/index.html.twig', ['skins' => $weaponSkins]);
    }


    /**
     * @Route(
     *     path="/{id}",
     *     name="skin_show"
     * )
     */
    public function showCard(WeaponSkin $weaponskin, TokenStorageInterface $token)
    {
        $em = $this->getDoctrine()->getManager();
        $note = $em->getRepository(NoteSkin::class)->findBy(['skin'=> $weaponskin->getId()]);

        $sameUser = false;

        foreach ($note as $n){
            if($token->getToken()->getUser() == $n->getUser()->getEmail()){
                $sameUser = true;
            }
        }

        return $this->render('WeaponSkin/show.html.twig', ['skin' => $weaponskin, 'notes' => $note, 'sameUser' => $sameUser]);


    }
}
