<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 14:05
 */

namespace App\DataFixtures\ORM;


use App\Entity\NoteSkin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadNoteSkin extends Fixture implements DependentFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $note = new NoteSkin();

        $note->setCreatedAt(new \DateTime());
        $note->setNote(10);
        $note->setUser($this->getReference('user1'));
        $note->setSkin($this->getReference('skin2'));

        $this->addReference('note1', $note);

        $manager->persist($note);

        $note = new NoteSkin();

        $note->setCreatedAt(new \DateTime());
        $note->setNote(15.1);
        $note->setUser($this->getReference('user3'));
        $note->setSkin($this->getReference('skin5'));

        $this->addReference('note2', $note);

        $manager->persist($note);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            LoadUser::class,
            LoadWeaponSkin::class
        );
    }
}