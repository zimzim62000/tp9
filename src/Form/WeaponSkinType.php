<?php
/**
 * Created by PhpStorm.
 * User: nicolas.horn
 * Date: 13/12/17
 * Time: 09:31
 */

namespace App\Form;

use App\Entity\User;
use ClassesWithParents\F;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeaponSkinType
{
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => User::class,
            //'validation_groups' => function (FormInterface $form)

    ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("name",TextType::class)
            ->add("text",TextareaType::class)
            ->add("beauty",TextType::class, array(
                'choices'  => array(
                    'sniper' => 'sniper',
                    'rifle' => 'rifle',
                    'pistol' => 'pistol',
                    'knife' => 'knife',
                ),
            ))
            ->add("beauty",TextType::class, array(
                'choices'  => array(
                    'common' => 'common',
                    'rare' => 'rare',
                    'epik' => 'epik',
                    'legendary' => 'legendary',
                ),
            ))
            ->add("price",NumberType::class)
            ->add("user",EntityType::class, array(
                'class' => User::class,
                'choice_label' => 'email',
            ));
    }

}