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
        $manager->flush();

        $user2 = new User();
        $user2->setFirstname('All');
        $user2->setLastname('Coolique');
        $user2->setEmail('allcoolique@hotmail.fr');
        $user2->setBirthday(new \DateTime('2012/12/21'));
        $password = $this->container->get('security.password_encoder')->encodePassword($user2, self::USER_PASSWORD);
        $user2->setPassword($password);
        $this->addReference('all', $user2);
        $manager->persist($user2);
        $manager->flush();

        $user3 = new User();
        $user3->setFirstname('David');
        $user3->setLastname('Goodenough');
        $user3->setEmail('davidgoodenough@hotmail.fr');
        $user3->setBirthday(new \DateTime('1984/05/18'));
        $password = $this->container->get('security.password_encoder')->encodePassword($user3, self::USER_PASSWORD);
        $user3->setPassword($password);
        $this->addReference('david', $user3);
        $manager->persist($user3);
        $manager->flush();
    }
}
