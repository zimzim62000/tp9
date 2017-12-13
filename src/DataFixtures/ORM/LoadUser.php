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

        $user2 = new User();

        $user2->setFirstname('User2');
        $user2->setLastname('User2');
        $user2->setEmail('user2@user.fr');
        $user2->setBirthday(new \DateTime('2000/01/01'));

        $password = $this->container->get('security.password_encoder')->encodePassword($user2, self::USER_PASSWORD);
        $user2->setPassword($password);

        $this->addReference('user2', $user2);

        $manager->persist($user2);

        $user3 = new User();

        $user3->setFirstname('User3');
        $user3->setLastname('User3');
        $user3->setEmail('user3@user.fr');
        $user3->setBirthday(new \DateTime('2000/01/01'));

        $password = $this->container->get('security.password_encoder')->encodePassword($user3, self::USER_PASSWORD);
        $user3->setPassword($password);

        $this->addReference('user3', $user3);

        $manager->persist($user3);

        $manager->flush();
    }
}
