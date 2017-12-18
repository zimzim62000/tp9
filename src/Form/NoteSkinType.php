<?php
/**
 * Created by PhpStorm.
 * User: maxime.maillot
 * Date: 18/12/17
 * Time: 15:06
 */

namespace App\Form;


use App\Entity\NoteSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NoteSkinType extends AbstractType
{
    private $token;

    public function __construct(TokenStorage $token)
    {
        $this->token = $token;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => NoteSkin::class));
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('note', NumberType::class, array('scale' => 2))
            ->add('captcha', CheckboxType::class, array('label' => 'Are you a robot ?', 'required' => true , 'mapped' => false))
            ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
    }

    public function onPreSetData(FormEvent $event)
    {
        $form = $event->getForm();
        if ($this->token->getToken()->getRoles() == 'ROLE_ADMIN'){
            $form->remove('captcha');
        }
        $form->add('submit', SubmitType::class);
    }
}