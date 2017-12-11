<?php

namespace App\DataFixtures\ORM;

use App\Entity\Card;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCard extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        $card = new Card();
        $card->setName('Aile de mort');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Cénarius');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Chante-esprit');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Chroniqueur Cho');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Serpent de la fosse');
        $manager->persist($card);

        $card = new Card();
        $card->setName('Archimonde');
        $manager->persist($card);

        $card = new Card();
        $card->setName("Gul'dan");
        $manager->persist($card);

        $card = new Card();
        $card->setName("Lich-King");
        $manager->persist($card);

        $card = new Card();
        $card->setName('Antorus');
        $manager->persist($card);

        $card = new Card();
        $card->setName("Vol'jin");
        $manager->persist($card);

        $card = new Card();
        $card->setName("Thrall");
        $manager->persist($card);


        $manager->flush();
    }
}
