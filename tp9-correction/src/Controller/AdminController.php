<?php

namespace App\Controller;


use App\Entity\LogAction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_admin_index"
     * )
     */
    public function indexdAction()
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('Admin/index.html.twig', ['logs' => $logs]);
    }
}
