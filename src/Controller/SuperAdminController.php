<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/SuperAdmin")
 */
class SuperAdminController extends Controller {
    /**
     * @Route(
     *     path="/",
     *     name="app_super_admin_index"
     * )
     */
    public function indexAction() {
        return $this->render('SuperAdmin/index.html.twig');
    }

    /**
     * @Route(
     *     path="/Random",
     *     name="app_super_admin_random"
     * )
     */
    public function Random() {
        if ($this->getUser()->getIsSuperAdmin() == true) {
            twig_random("skin1","skin2","skin3","skin4","skin5");
            return $this->render('SuperAdmin/random.html.twig');
        }
    }
}
