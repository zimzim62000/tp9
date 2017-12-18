<?php
/**
 * Created by PhpStorm.
 * User: emanuelevella
 * Date: 18/12/2017
 * Time: 14:01
 */

namespace App\DataFixtures\ORM;

use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSkin extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {




        $skin = new WeaponSkin();
        $skin->setName("Top kek version");
        $skin->setBeauty("légendary");
        $skin->setType("sniper");
        $skin->setPrice(90);
        $skin->setUser($this->getReference("user@user.fr"));
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("wattchadoing");
        $skin->setBeauty("common");
        $skin->setType("sniper");
        $skin->setPrice(43);
        $skin->setUser($this->getReference("user@user.fr"));
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("l2p");
        $skin->setBeauty("rare");
        $skin->setType("knife");
        $skin->setPrice(22);
        $skin->setUser($this->getReference("user@user.fr"));
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("umu");
        $skin->setBeauty("légendary");
        $skin->setType("sniper");
        $skin->setPrice(11);
        $this->setReference($skin->getName(), $skin);
        $manager->persist($skin);

        $skin = new WeaponSkin();
        $skin->setName("i like money");
        $skin->setBeauty("légendary");
        $skin->setType("pistol");
        $skin->setPrice(4);
        $this->setReference($skin->getName(), $skin);
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