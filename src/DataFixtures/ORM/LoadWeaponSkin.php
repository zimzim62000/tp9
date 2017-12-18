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
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /*$skin = new WeaponSkin();


        $this->addReference('user1', $user);
        $manager->persist($user);*/
    }

}