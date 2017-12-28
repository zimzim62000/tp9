<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;
use App\Entity\NoteSkin;

class LoadWeaponSkin extends Fixture
{
 
    public function load(ObjectManager $manager)
    {
        $skin1 = new WeaponSkin();
        $skin2 = new WeaponSkin();
        $skin3 = new WeaponSkin();

        $skin1->setName("Printemps")->setBeauty("rare")->setType("sniper")->setUpdateAt(new \DateTime())->setCreatedAt(new \DateTime())->setPrice(42.99)->setUser($this->getReference('user1'));
        $this->addReference('skin1', $skin1);
        $manager->persist($skin1);

        $skin2->setName("Hiver")->setBeauty("epik")->setType("pistol")->setUpdateAt(new \DateTime())->setCreatedAt(new \DateTime())->setPrice(422.99)->setUser($this->getReference('user2'));
        $this->addReference('skin2', $skin2);
        $manager->persist($skin2);

        $skin3->setName("Ete")->setBeauty("common")->setType("knife")->setUpdateAt(new \DateTime())->setCreatedAt(new \DateTime())->setPrice(2.99)->setUser($this->getReference('user3'));
        $this->addReference('skin3', $skin3);
        $manager->persist($skin3);

        $note1 = new NoteSkin();
        $note2 = new NoteSkin();

        $note1->setUser($this->getReference('user1'))->setSkin($this->getReference('skin1'))->setNote(12.23);
        $note2->setUser($this->getReference('user2'))->setSkin($this->getReference('skin1'))->setNote(9.3);

        $manager->persist($note1);
        $manager->persist($note2);

        $manager->flush();
    }
}
