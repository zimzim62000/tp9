<?php
/**
 * Created by PhpStorm.
 * User: bastien.cornu
 * Date: 18/12/17
 * Time: 15:45
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(path="/noteskin")
 */
class NoteSkinController extends Controller
{
    /**
     * @Route("/" , name="app_noteskin_index")
     */
    public function indexAction(){

    }
}