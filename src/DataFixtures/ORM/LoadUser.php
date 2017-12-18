<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends Fixture
{
    const USER_PASSWORD1 = 'user';
    const USER_PASSWORD2 = 'username';
    const USER_PASSWORD3 = 'myuser';

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD1);
        $user->setPassword($password);

        $this->addReference('user1', $user);

        $manager->persist($user);

        $user = new User();

        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD2);
        $user->setPassword($password);

        $this->addReference('user2', $user);

        $manager->persist($user);

        $user = new User();

        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD3);
        $user->setPassword($password);

        $this->addReference('user3', $user);

        $manager->persist($user);

        $manager->flush();


    }
}
