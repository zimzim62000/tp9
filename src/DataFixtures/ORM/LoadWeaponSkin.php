<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 13:49
 */

namespace App\DataFixtures\ORM;

use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $skin = new WeaponSkin();
        $skin->setName("AK-47");
        $skin->setBeauty("common");
        $skin->setType("rifle");
        $skin->setPrice(5);
        $skin->setUser($this->getReference("toto"));
        $this->addReference('ak', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("M4A4");
        $skin->setText("M4 sans silencieux");
        $skin->setBeauty("rare");
        $skin->setType("rifle");
        $skin->setPrice(5);
        $skin->setUser($this->getReference("user"));
        $this->addReference('m4', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("AWP");
        $skin->setBeauty("légendary");
        $skin->setType("sniper");
        $skin->setPrice(10);
        $skin->setUser($this->getReference("hadrien"));
        $this->addReference('awp', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("Desert Eagle");
        $skin->setBeauty("épik");
        $skin->setType("pistol");
        $skin->setPrice(2);
        $skin->setUser($this->getReference("toto"));
        $this->addReference('deagle', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("M9 Bayonet");
        $skin->setBeauty("légendary");
        $skin->setType("knife");
        $skin->setPrice(1);
        $skin->setUser($this->getReference("hadrien"));
        $this->addReference('knife', $skin);
        $manager->persist($skin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [LoadUser::class];
    }
}