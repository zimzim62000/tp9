<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 16:21
 */

namespace App\Controller;


use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


/**
 * Class RandomSkinController
 * @package App\Controller
 * @Route(path="/random")
 */
class RandomSkinController extends Controller
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
     * @Route(path="/", name="random_index")
     */
    public function indexAction(){
        $weaponSkin = $this->get(WeaponSkin::class);
        $user = $this->get(User::class);

        $id = $this->em->getRepository(WeaponSkin::class)->createQueryBuilder('s')
            ->select('s.id')->getQuery()->getArrayResult();
    }
}