<?php

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNote extends Fixture
{

    public function load(ObjectManager $manager)
    {

/*
        $skins= ["Articque","Desert","Sun"];

        $users = [ 'user@user.fr','user1@user.fr','user2@user.fr'];


        foreach ($skins as $skin) {
                $nb = rand(0,2);
                $note = new NoteSkin();
                $note->setNote(rand(0,20));
                $note->setUser($this->getReference($users[$nb]));
                $note->setSkin($this->getReference($skin));
                $manager->persist($note);



        }

        $manager->flush();*/


    }

    public function getDependencies()
    {
        return array(
            LoadUser::class,
            LoadSkin::class,
        );
    }
}
