<?php

namespace App\Form;

use App\Entity\NoteSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{IntegerType, SubmitType};
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NoteSkinType extends AbstractType {
    protected $token;
    protected $noteSkin;

    public function __construct(TokenStorageInterface $storage)
    {
        $this->token = $storage;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(
            [
                'data_class' => NoteSkin::class,
                'noteSkin' => null,
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $this->noteSkin = $options["noteSkin"];

        $builder->add("note", IntegerType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData'])->getForm();
    }

    public function onPreSetData(FormEvent $formEvent) {
        $form = $formEvent->getForm();
        $noteSkin = $formEvent->getData();

        if($noteSkin->getId() === null){
            $noteSkin->setUser($this->token->getToken()->getUser());
            $form->add("save", SubmitType::class, ["label" => "Créer"]);
        } else{
            $form->add("save", SubmitType::class, ["label" => "Modifier"]);
        }
    }
}