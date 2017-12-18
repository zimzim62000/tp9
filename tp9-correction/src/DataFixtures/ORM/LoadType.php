<?php

namespace App\DataFixtures\ORM;
use App\Entity\Beauty;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class LoadType extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $type = new Type();
        $type->setName('sniper');
        $manager->persist($type);

        $type = new Type();
        $type->setName('rifle');
        $manager->persist($type);

        $type = new Type();
        $type->setName('pistol');
        $manager->persist($type);

        $type = new Type();
        $type->setName('knife');
        $manager->persist($type);

        $manager->flush();
    }
}