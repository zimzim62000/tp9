<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 13:27
 */

namespace App\DataFixtures\ORM;


use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $skin = new WeaponSkin();

        $skin->setBeauty("common");
        $skin->setName("piou");
        $skin->setPrice("0.92");
        $skin->setText("Best piou of the game");
        $skin->setType("pistol");
        $skin->setCreatedAt(new \DateTime());
        $skin->setUpdateAt(new \DateTime());
        $skin->setUser($this->getReference('user1'));

        $this->addReference('skin1', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setBeauty("épik");
        $skin->setName("eh");
        $skin->setPrice("1.12");
        $skin->setText(null);
        $skin->setType("rifle");
        $skin->setCreatedAt(new \DateTime());
        $skin->setUpdateAt(new \DateTime());
        $skin->setUser($this->getReference('user1'));

        $this->addReference('skin2', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setBeauty("légendary");
        $skin->setName("golder");
        $skin->setPrice("100");
        $skin->setText(null);
        $skin->setType("knife");
        $skin->setCreatedAt(new \DateTime());
        $skin->setUpdateAt(new \DateTime());
        $skin->setUser($this->getReference('user2'));

        $this->addReference('skin3', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setBeauty("légendary");
        $skin->setName("golden");
        $skin->setPrice("250");
        $skin->setText("test");
        $skin->setType("knife");
        $skin->setCreatedAt(new \DateTime());
        $skin->setUpdateAt(new \DateTime());
        $skin->setUser($this->getReference('user3'));

        $this->addReference('skin4', $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();

        $skin->setBeauty("rare");
        $skin->setName("360noscope");
        $skin->setPrice("50.1");
        $skin->setText(null);
        $skin->setType("sniper");
        $skin->setCreatedAt(new \DateTime());
        $skin->setUpdateAt(new \DateTime());
        $skin->setUser($this->getReference('user3'));

        $this->addReference('skin5', $skin);
        $manager->persist($skin);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LoadUser::class,
        );
    }

}