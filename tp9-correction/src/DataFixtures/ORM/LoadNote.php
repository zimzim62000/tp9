<?php

namespace App\DataFixtures\ORM;
use App\Entity\NoteSkin;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\WeaponSkin;
use APp\Entity\Beauty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class LoadNote extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setNote(12.52);
        $note->setSkin($manager->getRepository(WeaponSkin::class)->findOneBy(array('name' => 'Premier Skin')));
        $note->setUser($manager->getRepository(User::class)->findOneBy(array('email' => 'user2@user.fr')));
        $manager->persist($note);

        $note = new NoteSkin();
        $note->setNote(8.98);
        $note->setSkin($manager->getRepository(WeaponSkin::class)->findOneBy(array('name' => 'Deuxième Skin')));
        $note->setUser($manager->getRepository(User::class)->findOneBy(array('email' => 'user1@user.fr')));
        $manager->persist($note);

        $manager->flush();
    }
}