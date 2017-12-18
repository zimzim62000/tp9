<?php
/**
 * Created by PhpStorm.
 * User: geoffrey.polan
 * Date: 18/12/17
 * Time: 14:57
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class NoteSkinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("note", IntegerType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData'])->getForm();
    }
    public function onPreSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();
        $noteSkin = $formEvent->getData();
        if($noteSkin->getId() === null){
            $form->add("save", SubmitType::class, ["label" => "Créer"]);
        } else{
            $form->add("save", SubmitType::class, ["label" => "Modifier"]);
        }
    }
}