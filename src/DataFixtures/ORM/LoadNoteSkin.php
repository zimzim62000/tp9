<?php
namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setNote(10);
        $note->setUser($this->getReference("user"));
        $note->setSkin($this->getReference("ak"));
        $manager->persist($note);

        $note = new NoteSkin();
        $note->setNote(5);
        $note->setUser($this->getReference("hadrien"));
        $note->setSkin($this->getReference("ak"));
        $manager->persist($note);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [LoadUser::class, LoadWeaponSkin::class];
    }
}