<?php

namespace App\DataFixtures\ORM;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\WeaponSkin;
use APp\Entity\Beauty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWeaponSkin extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('Premier Skin');
        $weaponSkin->setText('Description du premier skin.');
        $weaponSkin->setBeauty($manager->getRepository(Beauty::class)->findOneBy(array('name' => 'common')));
        $weaponSkin->setType($manager->getRepository(Type::class)->findOneBy(array('name' => 'sniper')));
        $weaponSkin->setPrice(10.51);
        $weaponSkin->setUser($manager->getRepository(User::class)->findOneBy(array('email' => 'user1@user.fr')));
        $manager->persist($weaponSkin);

        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('Deuxième Skin');
        $weaponSkin->setText('Description du deuxième skin.');
        $weaponSkin->setBeauty($manager->getRepository(Beauty::class)->findOneBy(array('name' => 'rare')));
        $weaponSkin->setType($manager->getRepository(Type::class)->findOneBy(array('name' => 'rifle')));
        $weaponSkin->setPrice(20.51);
        $weaponSkin->setUser($manager->getRepository(User::class)->findOneBy(array('email' => 'user2@user.fr')));
        $manager->persist($weaponSkin);

        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('Troisième Skin');
        $weaponSkin->setText('Description du troisème skin.');
        $weaponSkin->setBeauty($manager->getRepository(Beauty::class)->findOneBy(array('name' => 'épik')));
        $weaponSkin->setType($manager->getRepository(Type::class)->findOneBy(array('name' => 'pistol')));
        $weaponSkin->setPrice(30.51);
        $weaponSkin->setUser($manager->getRepository(User::class)->findOneBy(array('email' => 'user3@user.fr')));
        $manager->persist($weaponSkin);

        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('Quatrième Skin');
        $weaponSkin->setText('Description du quatrième skin.');
        $weaponSkin->setBeauty($manager->getRepository(Beauty::class)->findOneBy(array('name' => 'légendary')));
        $weaponSkin->setType($manager->getRepository(Type::class)->findOneBy(array('name' => 'knife')));
        $weaponSkin->setPrice(40.51);
        $weaponSkin->setUser($manager->getRepository(User::class)->findOneBy(array('email' => 'admin@admin.fr')));
        $manager->persist($weaponSkin);

        $weaponSkin = new WeaponSkin();
        $weaponSkin->setName('Cinquième Skin');
        //$weaponSkin->setText('Description du quatrième skin.');  //Pas de description ici car text peut être null
        $weaponSkin->setBeauty($manager->getRepository(Beauty::class)->findOneBy(array('name' => 'rare')));
        $weaponSkin->setType($manager->getRepository(Type::class)->findOneBy(array('name' => 'pistol')));
        $weaponSkin->setPrice(50.51);
        $weaponSkin->setUser($manager->getRepository(User::class)->findOneBy(array('email' => 'user1@user.fr')));
        $manager->persist($weaponSkin);

        $manager->flush();
    }
}