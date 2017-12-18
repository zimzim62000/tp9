<?php
namespace App\Form;

use App\Entity\NoteSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;


class NoteSkinType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            "data-class"=>NoteSkin::class,
        ]);
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("note")
            ->addEventListener(FormEvents::PRE_SET_DATA,
                 array($this, 'onPreSetData'));
    }

    public function onPreSetData(FormEvent $event)
    {
        $note = $event->getData();
        $form = $event->getForm();

        if ($note->getId() !== null) {

        }
        $form->add('submit',SubmitType::class);

    }



}