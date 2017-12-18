<?php

namespace App\DataFixtures\ORM;

use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends Fixture
{
    const USER_PASSWORD = 'user';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user2 = new User();
        $user3 = new User();
        $user4 = new User();

        $user1->setEmail('user1@msn.fr');
        $password = $this->container->get('security.password_encoder')->encodePassword($user1, self::USER_PASSWORD);
        $user1->setPassword($password);

        $user2->setEmail('user2@msn.fr');
        $password = $this->container->get('security.password_encoder')->encodePassword($user2, self::USER_PASSWORD);
        $user2->setPassword($password);

        $user3->setEmail('user3@msn.fr');
        $password = $this->container->get('security.password_encoder')->encodePassword($user3, self::USER_PASSWORD);
        $user3->setPassword($password);

        $user4->setEmail('user4@msn.fr');
        $password = $this->container->get('security.password_encoder')->encodePassword($user4, self::USER_PASSWORD);
        $user4->setPassword($password);

        $this->addReference(self::ROLE_USER, $user1);
        $this->addReference(self::ROLE_USER, $user2);
        $this->addReference(self::ROLE_USER, $user3);
        $this->addReference(self::ROLE_ADMIN, $user4);

        $manager->persist($user1);
        $manager->persist($user2);
        $manager->persist($user3);
        $manager->persist($user4);
        $manager->flush();
    }
}
