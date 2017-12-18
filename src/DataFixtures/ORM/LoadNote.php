<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\DateTime;

class LoadNote extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setNote(5);
        $note->setCreatedAt(new DateTime());
        $note->setUser($this->getReference('user1'));
        $note->setSkin($this->getReference('skin5'));
        $manager->persist($note);

        $note2 = new NoteSkin();
        $note2->setNote(1);
        $note2->setCreatedAt(new DateTime());
        $note2->setUser($this->getReference('user4'));
        $note2->setSkin($this->getReference('skin1'));
        $manager->persist($note2);

        $manager->flush();
    }
}
