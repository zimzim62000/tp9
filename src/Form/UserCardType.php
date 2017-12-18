<?php

namespace App\Form;
;
use App\Entity\UserCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserCardType extends AbstractType
{
    protected $token;
    protected $card;

    public function __construct(TokenStorageInterface $storage)
    {
        $this->token = $storage;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => UserCard::class,
                'card' => null,
            ]
        );
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->card = $options["card"];

        $builder->add("attack", IntegerType::class)
            ->add("defense", IntegerType::class)
            ->add("actionPoint", IntegerType::class)
            ->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData'])->getForm();
    }

    public function onPreSetData(FormEvent $formEvent)
    {
        $form = $formEvent->getForm();
        $userCard = $formEvent->getData();

        if($userCard->getId() === null){
            $userCard->setUser($this->token->getToken()->getUser());
            $userCard->setCard($this->card);
            $form->add("save", SubmitType::class, ["label" => "Créer"]);
        } else{
            $form->add("save", SubmitType::class, ["label" => "Modifier"]);
        }
    }
}