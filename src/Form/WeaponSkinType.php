<?php
/**
 * Created by PhpStorm.
 * User: hadrienchatelet
 * Date: 18/12/2017
 * Time: 14:27
 */

namespace App\Form;


use App\Entity\WeaponSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WeaponSkinType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => WeaponSkin::class,
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("name")
            ->add("text")
            ->add("beauty")
            ->add("beauty", ChoiceType::class, array(
                'choices' =>array(
                    'common' => 'common',
                    'rare' => 'rare',
                    'épik' => 'épik',
                    'légendary' => 'légendary',
                )
            ))
            ->add("type", ChoiceType::class, array(
                'choices' =>array(
                    'sniper' => 'sniper',
                    'rifle' => 'rifle',
                    'pistol' => 'pistol',
                    'knife' => 'knife',
                )
            ))
            ->add("price")
            ->add("save", SubmitType::class, ["label" => "Créer"])
        ;
    }
}