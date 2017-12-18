<?php
/**
 * Created by PhpStorm.
 * User: adrie
 * Date: 18/12/2017
 * Time: 13:26
 */

namespace App\DataFixtures\ORM;

use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSkin extends Fixture{
	
	public function load(ObjectManager $manager){
		
		for($i = 0; $i < count(WeaponSkin::BEAUTY); $i++){
			$weaponSkin = new WeaponSkin();
			
			$weaponSkin->setName("weapon skin " . $i);
			$weaponSkin->setText("La description de weapon skin " . $i );
			$weaponSkin->setPrice($i + 5);
			$weaponSkin->setBeauty(WeaponSkin::BEAUTY[$i]);
			$weaponSkin->setType(WeaponSkin::TYPE[$i]);
			
			$user = $manager->getRepository(User::class)->findOneBy(["firstname" => "User1"]);
			$weaponSkin->setUser($user);
			
			$this->addReference('weaponSkin' + $i, $weaponSkin);
			
			$manager->persist($weaponSkin);
			$manager->flush();
			
		}
	}
	
	
}