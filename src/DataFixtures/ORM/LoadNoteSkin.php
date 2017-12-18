<?php
/**
 * Created by PhpStorm.
 * User: bastien.cornu
 * Date: 18/12/17
 * Time: 14:07
 */

namespace App\DataFixtures\ORM;


use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();
        $note->setNote("35.50");
        $note->setCreatedAt(new \DateTime());
        $note->setUser($this->getReference("user3"));
        $note->setSkin($this->getReference("skin4"));
    }

    public function getDependencies()
    {
        return [
            LoadUser::class,
            LoadWeaponSkin::class
        ];
    }


}