<?php
/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 18/12/17
 * Time: 14:32
 */

namespace App\DataFixtures\ORM;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\NoteSkin;


class LoadNoteSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setNote("12.31");
        $note->setUser("user1");
        $note->setSkin("P250 Supernova");
        $manager->persist($note);

        $note = new NoteSkin();
        $note->setNote("17.01");
        $note->setUser("user1");
        $note->setSkin("AK-47 Version d'élite");
        $manager->persist($note);
    }
}