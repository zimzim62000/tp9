<?php

namespace App\Controller;


use App\Entity\LogUserCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route(
     *     path="",
     *     name="admin_index"
     * )
     */
    public function indexdAction()
    {
    	$logUserCard = $this->getDoctrine()->getManager()->getRepository(LogUserCard::class)->findAll();
    	
        return $this->render('Admin/index.html.twig', ["logUserCard" => $logUserCard]);
    }
}
