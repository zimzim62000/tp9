<?php

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;

class UserController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_user_index"
     * )
     */
    public function homeAction()
    {
        return $this->redirectToRoute('app_skin_index');
    }
}