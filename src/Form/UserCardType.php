<?php

namespace App\Form;
use App\Entity\Card;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use App\Entity\UserCard;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;


/**
 * Created by PhpStorm.
 * User: nael.durand
 * Date: 13/11/17
 * Time: 16:14
 */
class UserCardType extends AbstractType
{
    private $token;
    private $card;

    public function __construct(TokenStorage $token)
    {
        $this->token = $token;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => UserCard::class,
            'card' => null));

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->card = $options['card'];
        $builder
            ->add('actionPoint', NumberType::class)
            ->add('attack', NumberType::class)
            ->add('defence', NumberType::class)
            ->addEventListener( FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
            ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmitData'))
            ->add('save', SubmitType::class, array('label' =>"créer"))
            ->getForm();
    }
    public function onPreSetData(FormEvent $event)
    {
        $usercard = $event->getData();
        $form = $event->getForm();

        if ($usercard->getId() !== null){


        }
        else{

            $usercard->setUser($this->token->getToken()->getUser());
            $usercard->setCard($this->card);

        }




    }
    public function onPreSubmitData(FormEvent $event){
       /* $form = $event->getForm();
        $usercadValue = $form->getData();
        $dataForm = $event->getData();*/


    }



}