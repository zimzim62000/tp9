<?php
namespace App\Form;

use App\Entity\NoteSkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NoteSkinType extends AbstractType
{
    private $token;
    private $weaponskin;
    /**
     * NoteSkinType constructor.
     * @param $token
     */
    public function __construct(TokenStorage $token)
    {
        $this->token = $token;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class' => NoteSkin::class,'weaponskin' => null));
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->weaponskin = $options["weaponskin"];
        $builder
            ->add('note', IntegerType::class)
            ->addEventListener( FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData'))
            ->getForm();
    }
    public function onPreSetData(FormEvent $event)
    {
        $note = $event->getData();
        $form = $event->getForm();
        if ($note->getId() === null){
            $note->setUser($this->token->getToken()->getUser());
            $note->setSkin($this->weaponskin);
            $form->add('save',SubmitType::class, array('label'=>"créer"));
        }
        else
        {
            $form->add('save',SubmitType::class, array('label'=>"modifier"));
        }
    }
}