<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNote extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setCreatedAt(new \DateTime());
        $note->setNote(12.5);
        $manager->persist($note);
        $manager->flush();
    }
}
