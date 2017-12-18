<?php
/**
 * Created by PhpStorm.
 * User: quentin.geeraert
 * Date: 18/12/17
 * Time: 13:55
 */

namespace App\DataFixtures\ORM;


use App\Entity\NoteSkin;
use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadXNoteSkin extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 2; $i++) {
            $note = new NoteSkin();

            $note->setNote($i*2);

            $user1 = $this->getReference('user1');
            $user2 = $this->getReference('user2');
            $user3 = $this->getReference('user3');
            $user = [$user1,$user2,$user3];
            $note->setUser($user[rand(0,sizeof($user)-1)]);

            $skin1 = $this->getReference('skin1');
            $skin2 = $this->getReference('skin2');
            $skin3 = $this->getReference('skin3');
            $skin4 = $this->getReference('skin4');
            $skin5 = $this->getReference('skin5');
            $skin = [$skin1,$skin2,$skin3,$skin4,$skin5];
            $note->setSkin($skin[rand(0,sizeof($skin)-1)]);

            $this->addReference('note'.$i, $note);

            $manager->persist($note);
            $manager->flush();
        }
    }
}