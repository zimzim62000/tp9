<?php
/**
 * Created by PhpStorm.
 * User: adrien.leduc
 * Date: 18/12/17
 * Time: 13:56
 */
namespace App\DataFixtures\ORM;

use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    const USER_PASSWORD = 'user';

    public function load(ObjectManager $manager)
    {

        $weapon_skin1 = new WeaponSkin();
        $weapon_skin1->setName('Ak-47 vulcain');
        $weapon_skin1->setText('Une Ak-47 vraiment cool');
        $weapon_skin1->setCreatedAt(new \DateTime());
        $weapon_skin1->setUpdatedAt(new \DateTime());
        $weapon_skin1->setBeauty('épik');
        $weapon_skin1->setType('rifle');
        $weapon_skin1->setPrice(20.01);
        $weapon_skin1->setUser($this->getReference('user1'));


        $weapon_skin2 = new WeaponSkin();
        $weapon_skin2->setName('AWP militaire');
        $weapon_skin2->setText('Une AWP normal');
        $weapon_skin2->setCreatedAt(new \DateTime());
        $weapon_skin2->setUpdatedAt(new \DateTime());
        $weapon_skin2->setBeauty('common');
        $weapon_skin2->setType('sniper');
        $weapon_skin2->setPrice(1.20);
        $weapon_skin2->setUser($this->getReference('user2'));

        $weapon_skin3 = new WeaponSkin();
        $weapon_skin3->setName('Deagle banane');
        $weapon_skin3->setText('Un deagle qui donne faim');
        $weapon_skin3->setCreatedAt(new \DateTime());
        $weapon_skin3->setUpdatedAt(new \DateTime());
        $weapon_skin3->setBeauty('rare');
        $weapon_skin3->setType('pistol');
        $weapon_skin3->setPrice(5.00);
        $weapon_skin3->setUser($this->getReference('user3'));

        $weapon_skin4 = new WeaponSkin();
        $weapon_skin4->setName('Glock satan');
        $weapon_skin4->setText('le glock est né du diable');
        $weapon_skin4->setCreatedAt(new \DateTime());
        $weapon_skin4->setUpdatedAt(new \DateTime());
        $weapon_skin4->setBeauty('rare');
        $weapon_skin4->setType('pistol');
        $weapon_skin4->setPrice(6.66);
        $weapon_skin4->setUser($this->getReference('user1'));

        $weapon_skin5 = new WeaponSkin();
        $weapon_skin5->setName('Karambit doppler');
        $weapon_skin5->setText('Si tu le chopes un jour celui la ..');
        $weapon_skin5->setCreatedAt(new \DateTime());
        $weapon_skin5->setUpdatedAt(new \DateTime());
        $weapon_skin5->setBeauty('légendary');
        $weapon_skin5->setType('knife');
        $weapon_skin5->setPrice(9999.99);
        $weapon_skin5->setUser($this->getReference('user2'));

        $manager->persist($weapon_skin1);
        $manager->persist($weapon_skin2);
        $manager->persist($weapon_skin3);
        $manager->persist($weapon_skin4);
        $manager->persist($weapon_skin5);

        $manager->flush();
    }
}
