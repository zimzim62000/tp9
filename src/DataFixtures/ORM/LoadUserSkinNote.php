<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 18/12/17
 * Time: 14:01
 */

namespace App\DataFixtures\ORM;

use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
class LoadUserSkinNote extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $note=new NoteSkin();
        $note->setNote(5.3);
        $note->setUser($this->getReference('user0'));
        $note->setSkin($this->getReference('skin1'));
        $manager->persist($note);

        $note1=new NoteSkin();
        $note1->setNote(10.5);
        $note1->setUser($this->getReference('user1'));
        $note1->setSkin($this->getReference('skin2'));
        $manager->persist($note1);
        $manager->flush();

    }
}