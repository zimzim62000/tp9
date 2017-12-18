<?php

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;

/**
 * @Route(path="/skins")
 */
class SkinController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_skin_index"
     * )
     */
    public function indexAction(AuthorizationCheckerInterface $authorizationChecker)
    {
        $skins = $this->getDoctrine()->getManager()->getRepository(WeaponSkin::class)->findBy(array(),array('updatedAt' => 'desc'));
        return $this->render('Skin/index.html.twig', ["skins" => $skins]);
    }

    /**
     * @Route(
     *     path="/show/{id}",
     *     name="app_skin_show"
     * )
     */
    public function showAction(WeaponSkin $skin, AuthorizationCheckerInterface $authChecker)
    {
        $notes = $this->getDoctrine()->getManager()->getRepository(NoteSkin::class)->findBy(array('skin' => $skin->getId()),array('note' => 'desc'));
        return $this->render('Skin/show.html.twig', ['skin' => $skin, 'notes' => $notes]);
    }
}
