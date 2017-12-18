<?php
/**
 * Created by PhpStorm.
 * User: samuel.bigard
 * Date: 18/12/17
 * Time: 14:04
 */

namespace App\DataFixtures\ORM;


use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note1 = new NoteSkin();
        $note1->setNote(19.50);
        $note1->setUser($this->getReference("user1"));
        $note1->setSkin($this->getReference("skin3"));
        $manager->persist($note1);

        $note2 = new NoteSkin();
        $note2->setNote(3.50);
        $note2->setUser($this->getReference("user2"));
        $note2->setSkin($this->getReference("skin4"));
        $manager->persist($note2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [LoadUser::class,LoadWeaponSkin::class];
    }
}