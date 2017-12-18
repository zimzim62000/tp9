<?php

namespace App\DataFixtures\ORM;

use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {
        //WEAPON SKIN 1
        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('BlueSkin');
        $weaponSkin->setText('text');
        $weaponSkin->setCreatedAt(new \DateTime('2015/12/01'));
        $weaponSkin->setUpdatedAt(new \DateTime('2015/12/02'));
        $weaponSkin->setBeauty('common');
        $weaponSkin->setType('sniper');
        $weaponSkin->setPrice('1.1');
        $weaponSkin->setUser($this->getReference('User'));

        $this->addReference('Weapon', $weaponSkin);

        $manager->persist($weaponSkin);


        //WEAPON SKIN 2
        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('RedSkin');
        $weaponSkin->setText('text');
        $weaponSkin->setCreatedAt(new \DateTime('2015/12/01'));
        $weaponSkin->setUpdatedAt(new \DateTime('2015/12/02'));
        $weaponSkin->setBeauty('rare');
        $weaponSkin->setType('rifle');
        $weaponSkin->setPrice('2.2');
        $weaponSkin->setUser($this->getReference('User2'));

        $this->addReference('Weapon2', $weaponSkin);

        $manager->persist($weaponSkin);



        //WEAPON SKIN 3
        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('YellowSkin');
        $weaponSkin->setText('text');
        $weaponSkin->setCreatedAt(new \DateTime('2015/12/01'));
        $weaponSkin->setUpdatedAt(new \DateTime('2015/12/02'));
        $weaponSkin->setBeauty('épik');
        $weaponSkin->setType('pistol');
        $weaponSkin->setPrice('3.3');
        $weaponSkin->setUser($this->getReference('User3'));

        $this->addReference('Weapon3', $weaponSkin);

        $manager->persist($weaponSkin);


        //WEAPON SKIN 4
        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('PurpleSkin');
        $weaponSkin->setText('text');
        $weaponSkin->setCreatedAt(new \DateTime('2015/12/01'));
        $weaponSkin->setUpdatedAt(new \DateTime('2015/12/02'));
        $weaponSkin->setBeauty('légendary');
        $weaponSkin->setType('knife');
        $weaponSkin->setPrice('4.4');
        $weaponSkin->setUser($this->getReference('User'));

        $this->addReference('Weapon4', $weaponSkin);

        $manager->persist($weaponSkin);


        //WEAPON SKIN 5
        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('GreenSkin');
        $weaponSkin->setText('text');
        $weaponSkin->setCreatedAt(new \DateTime('2015/12/01'));
        $weaponSkin->setUpdatedAt(new \DateTime('2015/12/02'));
        $weaponSkin->setBeauty('rare');
        $weaponSkin->setType('rifle');
        $weaponSkin->setPrice('5.5');
        $weaponSkin->setUser($this->getReference('User3'));

        $this->addReference('Weapon5', $weaponSkin);

        $manager->persist($weaponSkin);


        $manager->flush();
    }
}
