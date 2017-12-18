<?php

namespace App\Controller;


use App\AppAccess;
use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

/**
 * @Route(path="/skin")
 */
class WeaponSkinController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_skin_index"
     * )
     */
    public function indexdAction()
    {
        $em = $this->getDoctrine()->getManager();

        $skins = $em->getRepository(WeaponSkin::class)->findBy(array(), array('updateAt' => 'ASC'));

        return $this->render('WeaponSkin/index.html.twig', ['skins' => $skins]);
    }

    /**
     * @Route(
     *     path="/show/{id}",
     *     name="app_skin_show"
     * )
     */

    public function showAction(WeaponSkin $skin, AuthorizationCheckerInterface $authChecker){
        $em = $this->getDoctrine()->getManager();

        $notes = $em->getRepository(NoteSkin::class)->findBy(['skin'=>$skin], ['note' => 'ASC']);

        $noteByUser = $em->getRepository(NoteSkin::class)->findBy(['skin'=>$skin, 'user'=>$this->getUser()]);
        
        return $this->render('WeaponSkin/show.html.twig', ['skin' => $skin, 'notes' => $notes, 'noteByUser' => $noteByUser]);
    }

    /**
     * @Route(
     *     path="/magicRandom",
     *     name="app_magic_random"
     * )
     */

    public function magicRandomAction(){
        $em = $this->getDoctrine()->getManager();

        $weaponSkin = new WeaponSkin();

        $weaponSkin->setCreatedAt(new \DateTime());
        $weaponSkin->setUser($this->getUser());
        $weaponSkin->setName("Magical");
        $weaponSkin->getPrice(12.12);

        $em->persist($weaponSkin);

        $em->flush();

        return $this->render('WeaponSkin/show.html.twig');
    }
}
