<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture {

    public function load(ObjectManager $manager) {

        $noteSkin = new NoteSkin();
        $noteSkin->setNote('15.5');
        $noteSkin->setUser('Paul');
        $manager->persist($noteSkin);

        $noteSkin = new NoteSkin();
        $noteSkin->setNote('12.44');
        $noteSkin->setUser('Henry');
        $manager->persist($noteSkin);

        $noteSkin = new NoteSkin();
        $noteSkin->setUser('Jack');
        $manager->persist($noteSkin);

        $noteSkin = new NoteSkin();
        $noteSkin->setUser('Jack');
        $manager->persist($noteSkin);

        $noteSkin = new NoteSkin();
        $noteSkin->setUser('Paul');
        $manager->persist($noteSkin);

        $manager->flush();
    }
}