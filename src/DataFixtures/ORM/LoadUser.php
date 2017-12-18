<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUser extends Fixture
{
	const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
	    for($i = 1; $i < 4; $i++){
		
		    $user = new User();
		
		    $user->setFirstname('User'.$i);
		    $user->setLastname('User'.$i);
		    $user->setEmail('user'.$i.'@user.fr');
		    $user->setBirthday(new \DateTime('2000/01/01'));
		
		    $password = $this->container->get('security.password_encoder')->encodePassword($user, self::USER_PASSWORD.$i);
		    $user->setPassword($password);
		
		    $this->addReference('user'.$i, $user);
		
		    $manager->persist($user);
		    $manager->flush();
	    }
    }
}
