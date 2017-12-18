<?php
/**
 * Created by PhpStorm.
 * User: manuel.renaudineau
 * Date: 18/12/17
 * Time: 15:22
 */

namespace App\Form;


use App\Entity\NoteSkin;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NoteSkinType extends AbstractType
{
    protected $weapon;
    protected $token;
    public function __construct(TokenStorageInterface $storage)
    {
        $this->token = $storage;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => NoteSkin::class,
                'weapon' => null,
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->weapon = $options["weapon"];

        $builder->add("note", IntegerType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData'])->getForm();
    }

    public function onPreSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();
        $note = $formEvent->getData();

        if($note->getId() === null){
            $note->setUser($this->token->getToken()->getUser());
            $note->setSkin($this->weapon);
            $form->add("save", SubmitType::class, ["label" => "Créer"]);
        } else{
            $form->add("save", SubmitType::class, ["label" => "Modifier"]);
        }
    }
}