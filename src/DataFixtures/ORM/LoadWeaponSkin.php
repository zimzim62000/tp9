<?php
/**
 * Created by PhpStorm.
 * User: quentin.geeraert
 * Date: 18/12/17
 * Time: 13:29
 */

namespace App\DataFixtures\ORM;

use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 5;$i++) {
            $skin = new WeaponSkin();

            $skin->setName("skin".$i);

            $user1 = $this->getReference('user1');
            $user2 = $this->getReference('user2');
            $user3 = $this->getReference('user3');

            $user = [$user1,$user2,$user3];

            $skin->setUser($user[rand(0,sizeof($user)-1)]);

            $beauty = ["common", "rare", "épik", "légendary"];
            $type = ["sniper", "rifle", "pistol", "knife"];

            $skin->setBeauty($beauty[rand(0,sizeof($beauty)-1)]);
            $skin->setType($type[rand(0,sizeof($type)-1)]);
            $skin->setPrice(rand($i*1000, $i*2000));

            $this->addReference('skin'.$i, $skin);

            $manager->persist($skin);
            $manager->flush();
        }
    }
}