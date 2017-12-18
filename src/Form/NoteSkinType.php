<?php

namespace App\Form;

use App\Entity\NoteSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoteSkinType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('data_class' => NoteSkin::class));
    }
    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("note")
            ->add("save", SubmitType::class, array("label"=>"Ajouter"));
    }
}