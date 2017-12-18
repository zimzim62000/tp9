<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('user1@user.fr');
        $password = self::USER_PASSWORD;
        $user->setPassword($password);
        $this->addReference('user1', $user);
        $manager->persist($user);


        $user = new User();
        $user->setEmail('user2@user.fr');
        $password = self::USER_PASSWORD;
        $user->setPassword($password);
        $this->addReference('user2', $user);
        $manager->persist($user);

        $user = new User();
        $user->setEmail('user3@user.fr');
        $password = self::USER_PASSWORD;
        $user->setPassword($password);
        $this->addReference('user3', $user);
        $manager->persist($user);
        $manager->flush();
    }
}
