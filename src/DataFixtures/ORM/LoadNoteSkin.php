<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        //NOTE SKIN 1
        $noteSkin = new NoteSkin();
        $noteSkin->setNote('1.1');
        $noteSkin->setCreatedAt(new \DateTime('2015/12/01'));
        $noteSkin->setUpdatedAt(new \DateTime('2015/12/02'));
        $noteSkin->setUser($this->getReference('User'));
        $noteSkin->setSkin($this->getReference('Weapon'));
        $manager->persist($noteSkin);


        //NOTE SKIN 2
        $noteSkin = new NoteSkin();
        $noteSkin->setNote('1.1');
        $noteSkin->setCreatedAt(new \DateTime('2015/12/01'));
        $noteSkin->setUpdatedAt(new \DateTime('2015/12/02'));
        $noteSkin->setUser($this->getReference('User3'));
        $noteSkin->setSkin($this->getReference('Weapon3'));
        $manager->persist($noteSkin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LoadUser::class,
            LoadWeaponSkin::class,
        );
    }
}
