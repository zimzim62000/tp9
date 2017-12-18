<?php

namespace App\Form;

use App\Entity\NoteSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{IntegerType, SubmitType};
use Symfony\Component\Form\{FormBuilderInterface, FormEvent, FormEvents};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class WeaponSkinType extends AbstractType {
    protected $token;
    protected $weaponSkin;

    public function __construct(TokenStorageInterface $storage)
    {
        $this->token = $storage;
    }

    public function buildForm(FormBuilderInterface $builder, array $options) {
            $builder
                ->add('name')
                ->addEventListener( FormEvents::PRE_SET_DATA,
                    array($this, 'onPreSetData') );

    }

    public function onPreSetData(FormEvent $event) {

        $player = $event->getData();
        $form = $event->getForm();

        if ($player->getId() !== null) {
            if ($this->getUser()->getIsSuperAdmin() == true) {
                $form
                    ->add('name')
                    ->add('text')
                    ->add('created_at')
                    ->add('uploaded_at')
                    ->add('beauty')
                    ->add('type')
                    ->add('price')
                    ->add('user');
            } elseif($this->getUser()->getIsAdmin() == true) {
                $form
                    ->add('beauty')
                    ->add('type');
            } else {
                $form
                    ->add('price');
            }
        }

        $form->add('submit');
    }
}