<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 16:33
 */

namespace App\Controller;
use App\Entity\WeaponSkin;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Class RandomSkinController
 * @package App\Controller
 * @Route(path="/api")
 */
class ApiController extends Controller
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
     * @Route(path="/", name="api_index")
     */
    public function indexAction(){
        $weaponSkins = $this->em->getRepository(WeaponSkin::class)->findAll();
        $weaponSkinsJson = json_encode($weaponSkins, JSON_FORCE_OBJECT);

        return $this->render('Api/index.html.twig', array('api' => $weaponSkinsJson));
    }
}