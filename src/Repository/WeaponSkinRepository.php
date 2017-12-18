<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 18/12/17
 * Time: 15:24
 */

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

class WeaponSkinRepository extends EntityRepository {

public function getSkinByDateUpdate() : array {
        return $this->getEntityManager()
            ->createQuery('SELECT wp FROM App:WeaponSkin wp ORDER BY wp.updated_at DESC')
            ->getArrayResult();
    }
}