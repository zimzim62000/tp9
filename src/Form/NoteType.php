<?php
/**
 * Created by PhpStorm.
 * User: nicolas.horn
 * Date: 13/12/17
 * Time: 09:31
 */

namespace App\Form;

use App\Entity\User;
use App\Entity\WeaponSkin;
use ClassesWithParents\F;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteType
{
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => User::class,
            //'validation_groups' => function (FormInterface $form)

    ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("note",NumberType::class);

            //->add("user",EntityType::class, array(
            //    'class' => User::class,
            //    'choice_label' => 'email'
            //))
            //->add("skin",EntityType::class, array(
            //    'class' => WeaponSkin::class,
            //   'choice_label' => 'name',
            //));
    }

}