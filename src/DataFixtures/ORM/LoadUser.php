<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends Fixture
{
    const USER_PASSWORD = 'user';
    const ADMIN_PASSWORD = "admin";

    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail('user@user.fr');
        $user1->setIsAdmin(false);
        $password = $this->container->get('security.password_encoder')->encodePassword($user1, self::USER_PASSWORD);
        $user1->setPassword($password);
        $manager->persist($user1);


        $user2 = new User();
        $user2->setEmail('user1@user.fr');
        $user2->setIsAdmin(false);
        $password = $this->container->get('security.password_encoder')->encodePassword($user2, self::USER_PASSWORD);
        $user2->setPassword($password);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setEmail('user2@user.fr');
        $user3->setIsAdmin(false);
        $password = $this->container->get('security.password_encoder')->encodePassword($user3, self::USER_PASSWORD);
        $user3->setPassword($password);
        $manager->persist($user3);

        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $admin->setIsAdmin(true);
        $password = $this->container->get('security.password_encoder')->encodePassword($admin, self::ADMIN_PASSWORD);
        $admin->setPassword($password);
        $manager->persist($admin);

        $manager->flush();
    }
}
