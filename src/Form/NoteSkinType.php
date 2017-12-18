<?php

/**
 * Created by PhpStorm.
 * User: adrien.leduc
 * Date: 18/12/17
 * Time: 16:15
 */

use \Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class NoteSkinType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder
            ->add("note", IntegerType::class)
            ->add("save", SubmitType::class, array("label"=>"Modifier"));
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults(array('data_class' => NoteSkinType::class));
    }

}