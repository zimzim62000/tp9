<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 16:54
 */

namespace App\Form;


use App\Entity\User;
use Doctrine\DBAL\Types\StringType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class WeaponSkinType
{
    private $token;

    public function __construct(TokenStorage $token)
    {
        $this->token = $token;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => WeaponSkinType::class));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        if ($this->token->getToken()->getRoles() == 'ROLE_USER'){
            $form->add('price', NumberType::class, array('scope' => 2));
        }
        if ($this->token->getToken()->getRoles() == 'ROLE_ADMIN'){
            $form->remove('price');
            $form->add('beauty', StringType::class)
                ->add('type', StringType::class);
        }
        if ($this->token->getToken()->getRoles() == 'ROLE_SUPER_ADMIN'){
            $form->add('name', StringType::class)
                ->add('text', TextType::class)
                ->add('createdAt', DateType::class)
                ->add('updatedAt', DateType::class)
                ->add('user', EntityType::class, array('class' => User::class, 'choice_label' => 'email'));
        }
        $form->add('submit', SubmitType::class);
    }
}