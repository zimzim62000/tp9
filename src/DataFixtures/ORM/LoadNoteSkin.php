<?php
/**
 * Created by PhpStorm.
 * User: jeremyclerot
 * Date: 18/12/2017
 * Time: 14:03
 */

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();

        $note->setNote(5);
        $note->setCreatedAt(new \DateTime('2000/01/01'));
        $note->setUser($this->getReference('user1'));
        $note->setSkin($this->getReference('skin2'));
        $this->addReference('note', $note);

        $manager->persist($note);

        $note = new NoteSkin();

        $note->setNote(10);
        $note->setCreatedAt(new \DateTime('2000/01/01'));
        $note->setUser($this->getReference('user'));
        $note->setSkin($this->getReference('skin'));
        $this->addReference('note1', $note);

        $manager->persist($note);
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