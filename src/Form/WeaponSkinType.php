<?php
/**
 * Created by PhpStorm.
 * User: florian
 * Date: 18/12/17
 * Time: 16:16
 */

namespace App\Form;


use App\Entity\WeaponSkin;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\StringType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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

        $builder->add("name", StringType::class)
            ->add("text", TextareaType::class)
            ->add("beauty", StringType::class)
            ->add("type", StringType::class)
            ->add("price", IntegerType::class)
            ->add("save", SubmitType::class, ["label" => "Créer"]);
    }
}