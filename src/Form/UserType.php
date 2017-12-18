<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserCard;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserType extends AbstractType{
	
	protected $token;
	protected $card;
	
	public function __construct(TokenStorageInterface $storage){
		$this->token = $storage;
	}
	
	public function configureOptions(OptionsResolver $resolver){
		$resolver->setDefaults([
			'data_class' => User::class,
			'card' => null,
			'validation_groups' => function (FormInterface $form){
				if($form->getData()->getId() === null){
					return ["new"];
				}
				
				return ["edit"];
			},
		]);
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options){
		
		$this->card = $options["card"];
		
		$builder->add("email", EmailType::class)
			->add("password", PasswordType::class)
			->add("Créer", SubmitType::class, ["label" => "Créer"]);
	}
	
}