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

        $user->setFirstname('User');
        $user->setLastname('User');
        $user->setEmail('user@user.fr');
        $user->setBirthday(new \DateTime('2000/01/01'));
        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD);
        $user->setPassword($password);
        $this->addReference('user', $user);
        $manager->persist($user);

        $user1 = new User();
        $user1->setFirstname('User1');
        $user1->setLastname('User1');
        $user1->setEmail('user1@user.fr');
        $user1->setBirthday(new \DateTime('2001/02/12'));
        $password = $this->container->get('security.password_encoder')->encodePassword($user1, self::USER_PASSWORD);
        $user1->setPassword($password);
        $this->addReference('user1', $user1);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setFirstname('User2');
        $user2->setLastname('User2');
        $user2->setEmail('user2@user.fr');
        $user2->setBirthday(new \DateTime('1999/11/22'));
        $password = $this->container->get('security.password_encoder')->encodePassword($user2, self::USER_PASSWORD);
        $user2->setPassword($password);
        $this->addReference('user2', $user2);
        $manager->persist($user2);

        $manager->flush();
    }
}
