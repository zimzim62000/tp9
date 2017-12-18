<?php
/**
 * Created by PhpStorm.
 * User: nicolas.horn
 * Date: 13/12/17
 * Time: 09:31
 */

namespace App\Controller;

use App\Entity\User;
use ClassesWithParents\F;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType
{
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array(
            'data_class' => User::class,
            //'validation_groups' => function (FormInterface $form)

    ));
    }

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("email",EmailType::class)
            ->add("password",PasswordType::class);
    }

}