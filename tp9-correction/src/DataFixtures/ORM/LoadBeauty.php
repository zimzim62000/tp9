<?php

namespace App\DataFixtures\ORM;
use App\Entity\Beauty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class LoadBeauty extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $beauty = new Beauty();
        $beauty->setName('common');
        $manager->persist($beauty);

        $beauty = new Beauty();
        $beauty->setName('rare');
        $manager->persist($beauty);

        $beauty = new Beauty();
        $beauty->setName('épik');
        $manager->persist($beauty);

        $beauty = new Beauty();
        $beauty->setName('légendary');
        $manager->persist($beauty);

        $manager->flush();
    }
}