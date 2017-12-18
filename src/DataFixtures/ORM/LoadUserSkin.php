<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 18/12/17
 * Time: 13:29
 */

namespace App\DataFixtures\ORM;
use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {

            $weaponSkin = new WeaponSkin();
            $weaponSkin->setName("Skin1");
            $weaponSkin->setText("test");
            $weaponSkin->setBeauty("common");
            $weaponSkin->setType("sniper");
            $weaponSkin->setPrice(2.4);
            $user1=$this->getReference('user1');

            $weaponSkin->setUser($user1);
            $manager->persist($weaponSkin);



            $this->addReference('skin1', $weaponSkin);


        $weaponSkin2 = new WeaponSkin();
        $weaponSkin2->setName("Skin3");
        $weaponSkin2->setText("test2");
        $weaponSkin2->setBeauty("épik");
        $weaponSkin2->setType("pistol");
        $weaponSkin2->setPrice(10);
        $weaponSkin2->setUser($this->getReference('user2'));
        $this->addReference('skin2', $weaponSkin2);
        $manager->persist($weaponSkin2);

        $weaponSkin3 = new WeaponSkin();
        $weaponSkin3->setName("Skin4");
        $weaponSkin3->setText("test4");
        $weaponSkin3->setBeauty("legendary");
        $weaponSkin3->setType("knife");
        $weaponSkin3->setPrice(10);
        $weaponSkin3->setUser($this->getReference('user1'));
        $this->addReference('skin3', $weaponSkin3);
        $manager->persist($weaponSkin3);


        $weaponSkin4 = new WeaponSkin();
        $weaponSkin4->setName("Skin5");
        $weaponSkin4->setText("test");
        $weaponSkin4->setBeauty("rare");
        $weaponSkin4->setType("rifle");
        $weaponSkin4->setPrice(3);
        $weaponSkin4->setUser($this->getReference('user2'));
        $manager->persist($weaponSkin4);


        $manager->flush();



        }

}