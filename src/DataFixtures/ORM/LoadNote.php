<?php
/**
 * Created by PhpStorm.
 * User: antoine.lefevre
 * Date: 18/12/17
 * Time: 13:46
 */

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNote extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $noteskin = new NoteSkin();

        $noteskin->setNote(10);
        $noteskin->setUser($this->getReference('user2'));
        $noteskin->setSkin($this->getReference('Dragon'));

        $manager->persist($noteskin);

        $noteskin = new NoteSkin();

        $noteskin->setNote(7.5);
        $noteskin->setUser($this->getReference('user2'));
        $noteskin->setSkin($this->getReference('Singe'));

        $manager->persist($noteskin);

        $noteskin = new NoteSkin();

        $noteskin->setNote(6);
        $noteskin->setUser($this->getReference('user'));
        $noteskin->setSkin($this->getReference('Rat'));

        $manager->persist($noteskin);

        $noteskin = new NoteSkin();

        $noteskin->setNote(8);
        $noteskin->setUser($this->getReference('user'));
        $noteskin->setSkin($this->getReference('Singe'));

        $manager->persist($noteskin);

        $noteskin = new NoteSkin();

        $noteskin->setNote(9);
        $noteskin->setUser($this->getReference('user3'));
        $noteskin->setSkin($this->getReference('Dragon'));

        $manager->persist($noteskin);

        $noteskin = new NoteSkin();

        $noteskin->setNote(7);
        $noteskin->setUser($this->getReference('user3'));
        $noteskin->setSkin($this->getReference('Serpent'));

        $manager->persist($noteskin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LoadSkin::class,LoadUser::class
        );
    }
}