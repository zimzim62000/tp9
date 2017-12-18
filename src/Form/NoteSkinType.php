<?php

/**
 * Created by PhpStorm.
 * User: quentin.geeraert
 * Date: 18/12/17
 * Time: 15:12
 */

namespace App\Form;

use App\Entity\Player;
use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class NoteSkinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){



        $builder
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('note', IntegerType::class)
            ->add('skin',EntityType::class, [
                'class' => WeaponSkin::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('save', SubmitType::class);;
    }
}