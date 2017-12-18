<?php

namespace App\DataFixtures\ORM;

use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        /**
        protected $name;
        protected $text;
        protected $created_at;
        protected $updated_at;
        protected $beauty;
        protected $type;
        protected $price;
        protected $user;
         */
        $skin = new WeaponSkin();
        $skin->setName('banane');
        $skin->setText('tout est dans le nom');
        $skin->setCreatedAt(new \DateTime());
        $skin->setUpdatedAt(new \DateTime());
        $skin->setBeauty('common');
        $skin->setType('rifle');
        $skin->setPrice(12.30);
        $skin->setUser($this->getReference('david'));
        $manager->persist($skin);
        $manager->flush();

        $skin2 = new WeaponSkin();
        $skin2->setName('nova blue dragon');
        $skin2->setText('tout est dans le nom');
        $skin2->setCreatedAt(new \DateTime());
        $skin2->setUpdatedAt(new \DateTime());
        $skin2->setBeauty('rare');
        $skin2->setType('pistol');
        $skin2->setPrice(45.30);
        $skin2->setUser($this->getReference('user'));
        $manager->persist($skin2);
        $manager->flush();

        $skin3 = new WeaponSkin();
        $skin3->setName('nova red dragon');
        $skin3->setText('Non c\'est pas la même chose que le blue!!');
        $skin3->setCreatedAt(new \DateTime());
        $skin3->setUpdatedAt(new \DateTime());
        $skin3->setBeauty('rare');
        $skin3->setType('pistol');
        $skin3->setPrice(45.40);
        $skin3->setUser($this->getReference('admin'));
        $manager->persist($skin3);
        $manager->flush();

        $skin4 = new WeaponSkin();
        $skin4->setName('tempest darkSasuke');
        $skin4->setText('c\'est juste pour faire cela plus kikoo!!');
        $skin4->setCreatedAt(new \DateTime());
        $skin4->setUpdatedAt(new \DateTime());
        $skin4->setBeauty('rare');
        $skin4->setType('sniper');
        $skin4->setPrice(45.40);
        $skin4->setUser(null);
        $manager->persist($skin4);
        $manager->flush();

        $skin5 = new WeaponSkin();
        $skin5->setName('here we go again... (blank version)');
        $skin5->setText('tout est dans le nom');
        $skin5->setCreatedAt(new \DateTime());
        $skin5->setUpdatedAt(new \DateTime());
        $skin5->setBeauty('rare');
        $skin5->setType('knife');
        $skin5->setPrice(45.30);
        $skin5->setUser($this->getReference('all'));
        $manager->persist($skin5);
        $manager->flush();
    }
}
