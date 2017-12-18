<?php
/**
 * Created by PhpStorm.
 * User: antoine.lefevre
 * Date: 18/12/17
 * Time: 13:32
 */

namespace App\DataFixtures\ORM;

use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $weaponskin = new WeaponSkin();

        $weaponskin->setName('Dragon');
        $weaponskin->setText('');
        $weaponskin->setBeauty('legendary');
        $weaponskin->setType('sniper');
        $weaponskin->setPrice(150.55);
        $weaponskin->setUser($this->getReference('user'));

        $this->addReference('Dragon', $weaponskin);

        $manager->persist($weaponskin);


        $weaponskin = new WeaponSkin();

        $weaponskin->setName('Tortue');
        $weaponskin->setText('');
        $weaponskin->setBeauty('common');
        $weaponskin->setType('pistol');
        $weaponskin->setPrice(0.99);
        $weaponskin->setUser($this->getReference('user'));

        $this->addReference('Tortue', $weaponskin);

        $manager->persist($weaponskin);


        $weaponskin = new WeaponSkin();

        $weaponskin->setName('Rat');
        $weaponskin->setText('');
        $weaponskin->setBeauty('common');
        $weaponskin->setType('rifle');
        $weaponskin->setPrice(2.58);
        $weaponskin->setUser($this->getReference('user2'));

        $this->addReference('Rat', $weaponskin);

        $manager->persist($weaponskin);


        $weaponskin = new WeaponSkin();

        $weaponskin->setName('Serpent');
        $weaponskin->setText('');
        $weaponskin->setBeauty('epik');
        $weaponskin->setType('knife');
        $weaponskin->setPrice(50);
        $weaponskin->setUser($this->getReference('user2'));

        $this->addReference('Serpent', $weaponskin);

        $manager->persist($weaponskin);

        $weaponskin = new WeaponSkin();

        $weaponskin->setName('Singe');
        $weaponskin->setText('');
        $weaponskin->setBeauty('rare');
        $weaponskin->setType('rifle');
        $weaponskin->setPrice(15.68);
        $weaponskin->setUser($this->getReference('user3'));

        $this->addReference('Singe', $weaponskin);

        $manager->persist($weaponskin);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LoadUser::class
        );
    }
}