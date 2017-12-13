<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{EmailType, PasswordType, SubmitType};
use Symfony\Component\Form\{
    FormBuilder, FormBuilderInterface, FormEvent, FormEvents, FormInterface
};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType {
    protected $card;
    protected $token;

    /**
     * UserType constructor.
     * @param $token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => User::class,
                'validation_groups' => function (FormInterface $form) {
                    if($form->getData()->getId() == null) {
                        return ['create'];
                    } return ['edit'];
                }
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add("email", EmailType::class)
            ->add("password", PasswordType::class)
            ->add("save", SubmitType::class, ["label" => "Modifier"]);
    }


}