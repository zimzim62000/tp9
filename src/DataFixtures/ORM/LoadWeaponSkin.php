<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 18/12/17
 * Time: 14:03
 */

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\WeaponSkin;

class LoadWeaponSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $skin = new WeaponSkin();
        $skin->setName("P250 Supernova");
        $skin->setBeauty("rare");
        $skin->setType("pistol");
        $skin->setPrice("3.15");
        $skin->setUser($this->getReference("user3"));
        $manager->persist($skin);


        $skin = new WeaponSkin();
        $skin->setName("AK-47 Version d'élite");
        $skin->setBeauty("rare");
        $skin->setType("rifle");
        $skin->setPrice("3.13");
        $skin->setUser($this->getReference("user1"));
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("M4A1-S Bête déchainée");
        $skin->setBeauty("rare");
        $skin->setType("rifle");
        $skin->setPrice("80.00");
        $skin->setUser($this->getReference("user2"));
        $manager->persist($skin);


        $skin = new WeaponSkin();
        $skin->setName("AWP Asiimov");
        $skin->setBeauty("rare");
        $skin->setType("sniper");
        $skin->setPrice("59.00");
        $skin->setUser($this->getReference("user1"));
        $manager->persist($skin);


        $skin = new WeaponSkin();
        $skin->setName("AK-47 Vulcain");
        $skin->setBeauty("rare");
        $skin->setType("pistol");
        $skin->setPrice("64.14");
        $skin->setUser($this->getReference("user2"));
        $manager->persist($skin);


        $manager->flush();

    }

    public function getDependencies()
    {
        return [LoadUser::class];
    }

}