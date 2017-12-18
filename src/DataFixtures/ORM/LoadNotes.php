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
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class LoadNotes extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setUser($this->getReference("user@user.fr"));
        $note->setSkin($this->getReference("i like money"));
        $note->setNote(10);
        $manager->persist($note);

        $note = new NoteSkin();
        $note->setUser($this->getReference("user@user.fr"));
        $note->setSkin($this->getReference("umu"));
        $note->setNote(10);
        $manager->persist($note);

        $manager->flush();

    }

    public function getDependencies()
    {
        return array(
            LoadUser::class,
        );
    }


}