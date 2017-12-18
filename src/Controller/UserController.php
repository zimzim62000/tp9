<?php

namespace App\Controller;

use Symfony\Component\Routing\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * @Route(path="/user")
 */
class UserController extends Controller
{
    /**
     * @Route(path="/user", name="user_index")
     */
    public function indexAction()
    {
        return $this->render('User/user.html.twig');
    }
}
