<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadAdmin extends Fixture
{
    const ADMIN_PASSWORD = 'admin';

    public function load(ObjectManager $manager)
    {
        $admin = new User();

        $admin->setFirstname('Admin');
        $admin->setLastname('Admin');
        $admin->setEmail('admin@admin.fr');
        $admin->setBirthday(new \DateTime('2015/12/01'));
        $admin->setIsAdmin(true);

        $password = $this->container->get('security.password_encoder')->encodePassword($admin, self::ADMIN_PASSWORD);
        $admin->setPassword($password);

        $this->addReference('admin', $admin);

        $manager->persist($admin);
        $manager->flush();
    }
}
