<?php
/**
 * Created by PhpStorm.
 * User: bastien.cornu
 * Date: 18/12/17
 * Time: 13:53
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
        $skin->setName("arme1");
        $skin->setBeauty("rare");
        $skin->setText("Ca va piquer");
        $skin->setType("sniper");
        $skin->setPrice("2.22");
        $skin->setCreatedAt(new \DateTime());
        $skin->setUser($this->getReference("user1"));

        $this->addReference("skin",$skin);
        $manager->persist($skin);

        $skin2 = new WeaponSkin();
        $skin2->setName("arme2");
        $skin2->setBeauty("common");
        $skin2->setText("Ca va piquer moins fort");
        $skin2->setType("pistol");
        $skin2->setPrice("0.52");
        $skin2->setCreatedAt(new \DateTime());
        $skin2->setUser($this->getReference("user2"));

        $this->addReference("skin2",$skin2);
        $manager->persist($skin2);

        $skin3 = new WeaponSkin();
        $skin3->setName("arme3");
        $skin3->setBeauty("epik");
        $skin3->setText("Ca va faire bobo");
        $skin3->setType("rifle");
        $skin3->setPrice("4.70");
        $skin3->setCreatedAt(new \DateTime());
        $skin3->setUser($this->getReference("user3"));

        $this->addReference("skin3",$skin3);
        $manager->persist($skin3);

        $skin4 = new WeaponSkin();
        $skin4->setName("arme4");
        $skin4->setBeauty("légendary");
        $skin4->setText("J'aimerais pas être devant");
        $skin4->setType("rifle");
        $skin4->setPrice("7.70");
        $skin4->setCreatedAt(new \DateTime());
        $skin4->setUser($this->getReference("user1"));

        $this->addReference("skin4",$skin4);
        $manager->persist($skin4);

        $skin5 = new WeaponSkin();
        $skin5->setName("arme5");
        $skin5->setBeauty("common");
        $skin5->setText("Même pas peur");
        $skin5->setType("knife");
        $skin5->setPrice("1.3");
        $skin5->setCreatedAt(new \DateTime());
        $skin5->setUser($this->getReference("user2"));

        $this->addReference("skin5",$skin5);
        $manager->persist($skin5);

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            LoadUser::class,
        ];
    }

}