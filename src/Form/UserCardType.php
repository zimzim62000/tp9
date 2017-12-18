<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Card;
use App\Entity\UserCard;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class UserCardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('actionPoint', IntegerType::class)
            ->add('attack', IntegerType::class)
            ->add('defence', IntegerType::class)
            ->addEventListener( FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
        ;
    }

    public function onPreSetData(FormEvent $event)
    {
        $user = $event->getData();
        $form = $event->getForm();
        if ($user->getId() !== null){


        }
        $form->add("submit", SubmitType::class, array("label"=>"Creer"));
    }


}