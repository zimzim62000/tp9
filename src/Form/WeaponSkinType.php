<?php

namespace App\Form;

use App\Entity\NoteSkin;
use App\Entity\User;
use App\Entity\WeaponSkin;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class WeaponSkinType extends AbstractType{
	
	protected $token;
	
	public function __construct(TokenStorageInterface $storage){
		$this->token = $storage;
	}
	
	public function configureOptions(OptionsResolver $resolver){
		$resolver->setDefaults([
			'data_class' => WeaponSkin::class
		]);
	}
	
	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add("name")
			->add("price")
			->add("text")
			->add("type", ChoiceType::class, ["choices" => WeaponSkin::TYPE])
			->add("beauty", ChoiceType::class, ["choices" => WeaponSkin::BEAUTY])
			->addEventListener(FormEvents::PRE_SET_DATA, [$this, 'onPreSetData'])->getForm();
	}
	
	public function onPreSetData(FormEvent $formEvent){
		
		/** @var FormBuilder $form */
		$form = $formEvent->getForm();
		
		/** @var WeaponSkin $weaponSkin */
		$weaponSkin = $formEvent->getData();
		
		/** @var User $user */
		$user = $this->token->getToken()->getUser();
		
		if($weaponSkin->getId() === null ){
			
			$weaponSkin->setUser($user);
			
			$form->add("save", SubmitType::class, ["label" => "Créer"]);
		}
		else{
			if($user->isAdmin()){
				$form->remove("price");
				$form->remove("text");
				$form->remove("name");
			}
			else if(!$user->isSuperAdmin()){
				$form->remove("name");
				$form->remove("text");
				$form->remove("type");
				$form->remove("beauty");
			}
			$form->add("save", SubmitType::class, ["label" => "Modifier"]);
		}
	}
}