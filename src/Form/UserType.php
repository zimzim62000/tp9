<?php

namespace App\Form;
;

use App\Entity\User;
use App\Entity\UserCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
                'validation_groups' => function (FormInterface $form){
                    if(null=== $form->getData()->getId()){
                        return ['new'];
                    }
                    return ['edit'];
                }
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add("email", EmailType::class)
            ->add('password', PasswordType::class)
            ->add("save", SubmitType::class, ["label" => "Créer"]);
    }
}