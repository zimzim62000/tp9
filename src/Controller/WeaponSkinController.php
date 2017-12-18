<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 14:17
 */

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class WeaponSkinController
 * @package App\Controller
 * @Route(path="/skin")
 */
class WeaponSkinController extends Controller
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
     * @Route(path="/", name="skin_index")
     */
    public function indexAction(){
        $skins = $this->em->getRepository(WeaponSkin::class)->findBy(array(), array('updated_at' => 'DESC'));
        return $this->render('Skin/index.html.twig', array('skins' => $skins));
    }

    /**
     * @Route(path="/{id}", name="skin_show")
     */
    public function showAction($id){
        $skin = $this->em->getRepository(WeaponSkin::class)->find($id);
        $notes = $this->em->getRepository(NoteSkin::class)->findBy(array('skin' => $skin), array('note' => 'DESC'));
        return $this->render('Skin/show.html.twig', array('skin' => $skin, 'notes' => $notes));
    }
}