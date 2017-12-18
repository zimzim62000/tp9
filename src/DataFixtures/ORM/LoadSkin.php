<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSkin extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $skin= new WeaponSkin();
        $skin->setName('Articque');
        $skin->setBeauty('Rare');
        $skin->setType('Sniper');
        $skin->setPrice(1.55);


        $skin2= new WeaponSkin();
        $skin2->setName('Desert');
        $skin2->setBeauty('Common');
        $skin2->setType('Rifle');
        $skin2->setPrice(0.45);

        $skin3= new WeaponSkin();
        $skin3->setName('Sun');
        $skin3->setBeauty('Epik');
        $skin3->setType('Knife');
        $skin3->setPrice(10.45);

        $skins= [$skin,$skin2,$skin3];

        $user = [ 'user@user.fr','user1@user.fr','user2@user.fr'];

        $n=0;
        foreach ($skins as $skin) {
            $skin->setUser($this->getReference($user[$n]));
            $this->addReference($skin->getName(), $skin);
            $manager->persist($skin);
            $n++;
        }

        $manager->flush();


    }

    public function getDependencies()
    {
        return array(
            LoadUser::class,
        );
    }
}
