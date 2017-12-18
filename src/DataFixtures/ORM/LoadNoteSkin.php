<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture
{
    const ADMIN_PASSWORD = 'admin';

    public function load(ObjectManager $manager)
    {
        $noteSkin = new NoteSkin();
        $noteSkin->setNote(14);
        $user = $manager->getRepository(User::class)->find(1);
        $noteSkin->setUser($user);
        $weapon = $manager->getRepository(WeaponSkin::class)->find(1);
        $noteSkin->setWeaponSkin($weapon);

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
