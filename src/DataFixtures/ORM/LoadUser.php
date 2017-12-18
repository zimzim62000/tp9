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
        $user->setEmail('user@user.fr');
        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD);
        $user->setPassword($password);

        $user2 = new User();
        $user2->setEmail('user1@user.fr');
        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD);
        $user2->setPassword($password);

        $user3 = new User();
        $user3->setEmail('user2@user.fr');
        $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD);
        $user3->setPassword($password);

        $users= [$user,$user2,$user3];

        foreach ($users as $user) {

            $this->addReference($user->getEmail(), $user);
            $manager->persist($user);

        }

        $manager->flush();

    }




}
