<?php

namespace App\Form;

use App\Entity\NoteSkin;
use App\Entity\User;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class NoteSkinType extends AbstractType{
	
	protected $token;
	protected $weaponSkin;
	protected $captcha;
	
	public function __construct($captcha, TokenStorageInterface $storage){
		$this->token = $storage;
		$this->captcha = $captcha;
	}
	
	public function configureOptions(OptionsResolver $resolver){
		$resolver->setDefaults([
			'data_class' => NoteSkin::class,
			'weaponskin' => null,
		]);
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options){
		
		$this->weaponSkin = $options["weaponskin"];
		
		$builder->add("Note", IntegerType::class)
			->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData'])->getForm();
	}
	
	public function onPreSetData(FormEvent $formEvent){
		
		/** @var FormBuilder $form */
		$form = $formEvent->getForm();
		
		/** @var NoteSkin $noteSkin */
		$noteSkin = $formEvent->getData();
		
		/** @var User $user */
		$user = $this->token->getToken()->getUser();
		
		if($noteSkin->getId() === null ){
			
			$noteSkin->setUser($user);
			$noteSkin->setWeaponSkin($this->weaponSkin);
			
			$form->add("save", SubmitType::class, ["label" => "Créer"]);
		}
		else{
			$form->add("save", SubmitType::class, ["label" => "Modifier"]);
		}
	}
}