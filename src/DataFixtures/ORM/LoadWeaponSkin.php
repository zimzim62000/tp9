<?php
/**
 * Created by PhpStorm.
 * User: samuel.bigard
 * Date: 18/12/17
 * Time: 13:51
 */

namespace App\DataFixtures\ORM;


use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $skin1 = new WeaponSkin();
        $skin1->setName("slaughter");
        $skin1->setText("skin rouge, plutot jolie");
        $skin1->setBeauty("légendary");
        $skin1->setType("knife");
        $skin1->setPrice(100.99);
        $skin1->setUser($this->getReference("user"));
        $this->addReference('skin1', $skin1);
        $manager->persist($skin1);

        $skin2 = new WeaponSkin();
        $skin2->setName("case hardened");
        $skin2->setText("skin pas beau");
        $skin2->setBeauty("rare");
        $skin2->setType("rifle");
        $skin2->setPrice(30.92);
        $skin2->setUser($this->getReference("user"));
        $this->addReference('skin2', $skin2);
        $manager->persist($skin2);

        $skin3 = new WeaponSkin();
        $skin3->setName("fade");
        $skin3->setText("skin très rare mais chere");
        $skin3->setBeauty("légendary");
        $skin3->setType("knife");
        $skin3->setPrice(199.00);
        $skin3->setUser($this->getReference("user1"));
        $this->addReference('skin3', $skin3);
        $manager->persist($skin3);

        $skin4 = new WeaponSkin();
        $skin4->setName("safary");
        $skin4->setText("skin pas beau mais pas chere");
        $skin4->setBeauty("common");
        $skin4->setType("pistol");
        $skin4->setPrice(1.31);
        $skin4->setUser($this->getReference("user2"));
        $this->addReference('skin4', $skin4);
        $manager->persist($skin4);

        $skin5 = new WeaponSkin();
        $skin5->setName("redline");
        $skin5->setBeauty("épik");
        $skin5->setType("sniper");
        $skin5->setPrice(40.41);
        $skin5->setUser($this->getReference("user2"));
        $this->addReference('skin5', $skin5);
        $manager->persist($skin5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [LoadUser::class];
    }
}