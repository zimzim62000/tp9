<?php
/**
 * Created by PhpStorm.
 * User: jeremyclerot
 * Date: 18/12/2017
 * Time: 13:32
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

        $skin->setName("test");
        $skin->setText("test");
        $skin->setBeauty("common");
        $skin->setType("rifle");
        $skin->setPrice(2.2);
        $skin->setCreatedAt(new DateTime('now'));
        $skin->setUpdatedAt(new DateTime('now'));
        $skin->setUser($this->getReference('user'));

        $this->addReference('skin', $skin);

        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setName("test2");
        $skin->setText("test2");
        $skin->setBeauty("rare");
        $skin->setType("pistol");
        $skin->setPrice(5.2);
        $skin->setCreatedAt(new DateTime('now'));
        $skin->setUpdatedAt(new DateTime('now'));
        $skin->setUser($this->getReference('user1'));

        $this->addReference('skin2', $skin);

        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setName("test3");
        $skin->setText("test3");
        $skin->setBeauty("épik");
        $skin->setType("knife");
        $skin->setPrice(10.3);
        $skin->setCreatedAt(new DateTime('now'));
        $skin->setUpdatedAt(new DateTime('now'));
        $skin->setUser($this->getReference('user2'));

        $this->addReference('skin3', $skin);

        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setName("test4");
        $skin->setText("test4");
        $skin->setBeauty("légendary");
        $skin->setType("sniper");
        $skin->setPrice(20.5);
        $skin->setCreatedAt(new DateTime('now'));
        $skin->setUpdatedAt(new DateTime('now'));
        $skin->setUser($this->getReference('user2'));

        $this->addReference('skin4', $skin);

        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setName("test5");
        $skin->setText("test5");
        $skin->setBeauty("common");
        $skin->setType("rifle");
        $skin->setPrice(3.2);
        $skin->setCreatedAt(new DateTime('now'));
        $skin->setUpdatedAt(new DateTime('now'));
        $skin->setUser($this->getReference('user'));

        $this->addReference('skin5', $skin);

        $manager->persist($skin);
        $manager->flush();
    }
}