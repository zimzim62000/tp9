<?php
namespace App\Form;

use App\Entity\NoteSkin;
use App\Entity\WeaponSkin;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SkinType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => WeaponSkin::class));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('text', TextType::class)
            ->add('createdAt', DateType::class)
            ->add('updatedAt', DateType::class)
            ->add('beauty', TextType::class)
            ->add('type', TextType::class)
            ->add('price', DecimalType::class)
            ->add('user', null)
            ->addEventListener( FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData'))
            ->getForm();
    }
    public function onPreSetData(FormEvent $event)
    {
        $skin = $event->getData();
        $form = $event->getForm();
        if ($skin->getId() === null){
            $form->add('save',SubmitType::class, array('label'=>"créer"));
        }
        else
        {
            $form->add('save',SubmitType::class, array('label'=>"modifier"));
        }
    }
}