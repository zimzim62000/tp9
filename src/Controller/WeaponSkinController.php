<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 18/12/2017
 * Time: 13:38
 */

namespace App\Controller;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/skin")
 */
class WeaponSkinController extends Controller{
	
	/**
	 * @Route(
	 *     path="/",
	 *     name="weapon_index"
	 * )
	 */
	public function indexAction()
	{
		$weaponSkins = $this->getDoctrine()->getRepository(WeaponSkin::class)->findBy([], ["updatedAt" => "DESC"]);
		
		return $this->render('Skin/index.html.twig', ["weaponSkins" => $weaponSkins]);
	}
	
	/**
	 * @Route(
	 *     path="/{id}",
	 *     name="weapon_show"
	 * )
	 */
	public function showAction(WeaponSkin $weaponSkin, $orderBy = null)
	{
		$orderByCondition = $orderBy === "true" ? [["note" => "DESC", "createdAt" => "DESC"]] :  ["note" => "DESC"];
		$weaponSkin = $this->getDoctrine()->getRepository(WeaponSkin::class)->find($weaponSkin);
		$noteSkin = $this->getDoctrine()->getRepository(NoteSkin::class)->findBy(["weaponSkin" => $weaponSkin], $orderByCondition);
		return $this->render('Skin/show.html.twig', ["weaponSkin" => $weaponSkin, "noteSkin" => $noteSkin]);
	}
}