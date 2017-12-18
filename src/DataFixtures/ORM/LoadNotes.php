<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 18/12/2017
 * Time: 14:21
 */

namespace App\DataFixtures\ORM;


use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class LoadNotes extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setUser($this->getReference("user1@user.fr"));
        $note->setSkin($this->getReference("i like money"));
        $manager->persist($note);

        $note = new NoteSkin();
        $note->setUser($this->getReference("user@user.fr"));
        $note->setSkin($this->getReference("umu"));
        $manager->persist($note);

        $manager->flush();

    }


}