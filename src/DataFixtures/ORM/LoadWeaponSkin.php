<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    const ADMIN_PASSWORD = 'admin';

    public function load(ObjectManager $manager)
    {
        $skin = new WeaponSkin();
        $skin->setName("Numeric");
        $skin->setBeauty("common");
        $skin->setType("sniper");
        $skin->setPrice(50);
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("Noob");
        $skin->setBeauty("common");
        $skin->setType("pistol");
        $skin->setPrice(25);

        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("Noob+");
        $skin->setBeauty("rare");
        $skin->setType("rifle");
        $skin->setPrice(75);

        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("Carambit");
        $skin->setBeauty("légendary");
        $skin->setType("knife");
        $skin->setPrice(90);

        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("Dragon Lore");
        $skin->setBeauty("légendary");
        $skin->setType("sniper");
        $skin->setPrice(99);

        $manager->persist($skin);



        $manager->flush();
    }
}
