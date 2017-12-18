<?php

namespace App\DataFixtures\ORM;

use App\Entity\User;
use App\Entity\WeaponSkin;
use App\Entity\NoteSkin;
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

        $skin = new WeaponSkin();
        $skin->setName('banane');
        $skin->setText('tout est dans le nom');
        $skin->setCreatedAt(new \DateTime());
        $skin->setUpdatedAt(new \DateTime());
        $skin->setBeauty('common');
        $skin->setType('rifle');
        $skin->setPrice(12.30);
        $skin->setUser($this->getReference('david'));
        $manager->persist($skin);
        $manager->flush();

        $skin2 = new WeaponSkin();
        $skin2->setName('nova blue dragon');
        $skin2->setText('tout est dans le nom');
        $skin2->setCreatedAt(new \DateTime());
        $skin2->setUpdatedAt(new \DateTime());
        $skin2->setBeauty('rare');
        $skin2->setType('pistol');
        $skin2->setPrice(45.30);
        $skin2->setUser($this->getReference('user'));
        $this->addReference('Bdragon', $skin2);
        $manager->persist($skin2);
        $manager->flush();

        $skin3 = new WeaponSkin();
        $skin3->setName('nova red dragon');
        $skin3->setText('Non c\'est pas la même chose que le blue!!');
        $skin3->setCreatedAt(new \DateTime());
        $skin3->setUpdatedAt(new \DateTime());
        $skin3->setBeauty('rare');
        $skin3->setType('pistol');
        $skin3->setPrice(45.40);
        $skin3->setUser($this->getReference('admin'));
        $this->addReference('Rdragon', $skin3);
        $manager->persist($skin3);
        $manager->flush();

        $skin4 = new WeaponSkin();
        $skin4->setName('tempest darkSasuke');
        $skin4->setText('c\'est juste pour faire cela plus kikoo!!');
        $skin4->setCreatedAt(new \DateTime());
        $skin4->setUpdatedAt(new \DateTime());
        $skin4->setBeauty('rare');
        $skin4->setType('sniper');
        $skin4->setPrice(45.40);
        $skin4->setUser($this->getReference('user'));
        $manager->persist($skin4);
        $manager->flush();

        $skin5 = new WeaponSkin();
        $skin5->setName('here we go again... (blank version)');
        $skin5->setText('tout est dans le nom');
        $skin5->setCreatedAt(new \DateTime());
        $skin5->setUpdatedAt(new \DateTime());
        $skin5->setBeauty('rare');
        $skin5->setType('knife');
        $skin5->setPrice(45.30);
        $skin5->setUser($this->getReference('all'));
        $manager->persist($skin5);
        $manager->flush();

        $note = new NoteSkin();
        $note->setCreatedAt(new \DateTime());
        $note->setNote(12.5);
        $note->setUser($this->getReference('david'));
        $note->setSkin($this->getReference('Rdragon'));
        $manager->persist($note);
        $manager->flush();

        $note2 = new NoteSkin();
        $note2->setCreatedAt(new \DateTime());
        $note2->setNote(8.5);
        $note2->setUser($this->getReference('admin'));
        $note2->setSkin($this->getReference('Bdragon'));
        $manager->persist($note2);
        $manager->flush();
    }
}
