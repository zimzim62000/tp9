<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
/*        $note1 = new NoteSkin();
        $note2 = new NoteSkin();

        $note1->setUser($this->getReference('user1'))->setSkin($this->getReference('skin1'));
        $note2->setUser($this->getReference('user2'))->setSkin($this->getReference('skin1'));

        $manager->persist($note1);
        $manager->persist($note2);

        $manager->flush();*/
    }
}
