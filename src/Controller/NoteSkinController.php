<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 14:57
 */

namespace App\Controller;


use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class WeaponSkinController
 * @package App\Controller
 * @Route(path="/note")
 */
class NoteSkinController extends Controller
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * WeaponSkinController constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @Route(path="/", name="note_new")
     */
    public function newAction(){
        return $this->render('Note/new.html.twig');
    }
}