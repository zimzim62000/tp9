<?php
/**
 * Created by PhpStorm.
 * User: adrien.leduc
 * Date: 18/12/17
 * Time: 15:00
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WeaponSkinController extends Controller
{
    /**
     * @Route(path="/index", name="weaponskin_index")
     */
    public function indexAction()
    {
        return $this->render('WeaponSkin/index.html.twig');
    }

    /**
     * @Route(path="/show", name="weaponskin_show")
     */
    public function showAction()
    {
        return $this->render('WeaponSkin/show.html.twig');
    }
}