<?php
namespace App\Form;

use App\Entity\WeaponSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: alexis.delarre
 * Date: 18/12/17
 * Time: 15:32
 */
class WeaponSkinType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name")
            ->add("text")
            ->add("beauty", ChoiceType::class, array(
                'choices'  => array(
                    "common" => "common",
                    "rare" => "rare",
                    "épique" => "épique",
                    "légendary"=>"légendary"
                    )))
            ->add("type",ChoiceType::class, array(
                'choices'  => array(
                    "sniper" => "sniper",
                    "rifle" => "rifle",
                    "pistol" => "pistol",
                    "knife" => "knife"
                )))
            ->add("price")
            ->add("save", SubmitType::class, array("label"=>"Creer"));
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>WeaponSkin::class,
        ]);
    }
}