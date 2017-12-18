<?php

namespace App\DataFixtures\ORM;

use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadSkin extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $skin = new WeaponSkin();
        $skin->setName("awp dragon lore");
        $skin->setType("sniper");
        $skin->setBeauty("legendary");
        $skin->setText("200dmg");
        $skin->setPrice(4500);
        $skin->setCreatedAt(new DateTime());
        $skin->setUpdatedAt(new DateTime());
        $skin->setUser($this->getReference('user1'));
        $manager->persist($skin);

        $skin2 = new WeaponSkin();
        $skin2->setName("ak-47 neon revolution");
        $skin2->setType("rifle");
        $skin2->setBeauty("legendary");
        $skin2->setText("150dmg");
        $skin2->setPrice(2500);
        $skin2->setCreatedAt(new DateTime());
        $skin2->setUpdatedAt(new DateTime());
        $skin2->setUser($this->getReference('user2'));
        $manager->persist($skin2);

        $skin3 = new WeaponSkin();
        $skin3->setName("glock water");
        $skin3->setType("pistol");
        $skin3->setBeauty("common");
        $skin3->setText("50dmg");
        $skin3->setPrice(500);
        $skin3->setCreatedAt(new DateTime());
        $skin3->setUpdatedAt(new DateTime());
        $skin3->setUser($this->getReference('user3'));
        $manager->persist($skin3);

        $skin4 = new WeaponSkin();
        $skin4->setName("ssg 666");
        $skin4->setType("sniper");
        $skin4->setBeauty("epik");
        $skin4->setText("100dmg");
        $skin4->setPrice(3200);
        $skin4->setCreatedAt(new DateTime());
        $skin4->setUpdatedAt(new DateTime());
        $skin4->setUser($this->getReference('user4'));
        $manager->persist($skin4);

        $skin5 = new WeaponSkin();
        $skin5->setName("karambit doppler saphire");
        $skin5->setType("knife");
        $skin5->setBeauty("legendary");
        $skin5->setText("plus de maison plus d argent mais un couteau");
        $skin5->setPrice(8500);
        $skin5->setCreatedAt(new DateTime());
        $skin5->setUpdatedAt(new DateTime());
        $skin5->setUser($this->getReference('user5'));
        $manager->persist($skin5);

        $manager->flush();
    }
}
