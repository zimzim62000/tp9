<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUser extends Fixture
{
    //const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        //User
        $user = new User();
        $user->setFirstname('User');
        $user->setLastname('User');
        $user->setEmail('user@user.fr');
        $user->setBirthday(new \DateTime('2000/01/01'));

        $password = $this->container->get('security.password_encoder')->encodePassword($user, 'user');
        $user->setPassword($password);

        $this->addReference('user', $user);

        $manager->persist($user);
        $manager->flush();

        //Valentin
        $user = new User();
        $user->setFirstname('Valentin');
        $user->setLastname('Papin');
        $user->setEmail('valentin.papin1@gmail.com');
        $user->setBirthday(new \DateTime('1995/08/18'));

        $password = $this->container->get('security.password_encoder')->encodePassword($user, 'valentin');
        $user->setPassword($password);

        $this->addReference('valentin', $user);

        $manager->persist($user);
        $manager->flush();

        //Robin
        $user = new User();
        $user->setFirstname('Robin');
        $user->setLastname('De Ruyck');
        $user->setEmail('robin.deruyck@test.fr');
        $user->setBirthday(new \DateTime('1945/05/08'));

        $password = $this->container->get('security.password_encoder')->encodePassword($user, 'robin');
        $user->setPassword($password);

        $this->addReference('robin', $user);

        $manager->persist($user);
        $manager->flush();
    }
}
