<?php
/**
 * Created by PhpStorm.
 * User: jeremyclerot
 * Date: 18/12/2017
 * Time: 15:43
 */

namespace App\Form;

use App\Entity\NoteSkin;
use Doctrine\DBAL\Types\DecimalType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NoteSkinType extends AbstractType
{
    protected $token;

    public function __construct(TokenStorageInterface $storage)
    {
        $this->token = $storage;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => NoteSkin::class
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add("note", DecimalType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData'])->getForm();
    }

    public function onPreSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();
        $noteskin = $formEvent->getData();

        if($noteskin->getId() === null){
            $noteskin->setUser($this->token->getToken()->getUser());
            $noteskin->setCreatedAt(new \DateTime());
            $noteskin->setSkin($this->token->getToken()->getWeapon());
            $form->add("save", SubmitType::class, ["label" => "Créer"]);
        } else{
            $form->add("save", SubmitType::class, ["label" => "Modifier"]);
        }
    }

}