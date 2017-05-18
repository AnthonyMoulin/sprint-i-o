<?php

namespace AuthBundle\Controller;

use AppBundle\Controller\AbstractAppController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AuthBundle\Entity\User;
use Symfony\Component\Form\Form;

abstract class AbstractAuthController extends AbstractAppController
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	protected function readUser(Form $form)
	{
		return $this->getDoctrine()
		->getManager()
		->getRepository(User::class)
		->findOneBy([
				"email" => $form->getData() ["email"]
		]);
	}
	
	
	protected function getAuthAndJoinForm($submitLabel)
	{
	  
		$builder = $this->createFormBuilder();
		
		
		$builder->add(
				"email",
				EmailType::class,[
						"label"=>"Email adress",
						"constraints" => [
								new Email([
										"message" => "Incorrect email adress",
								]),
								
								new NotBlank([
										"message" => "Incorrect email adress"
								]),
// 								"attr" => [
// 										"class" => "form_spacing"
// 								]
						]
				]
				);
		
		$builder->add(
				"password",
				TextType::class,[
						"label"=>"Password",
						"constraints" => [
								new Regex([
										"pattern" => "/^[\w]{6,32}$/",
										"message" => "Incorrect password"
								]),
								new NotBlank([
										"message" => "Password is required"
								]),
// 								"attr" => [
// 										"class" => "form_spacing"
// 								]
						]
				]
				
		);
		$builder->add(
				"create", SubmitType::class, [
				"label"=> $submitLabel,
				"attr" => [
						"class" => "btn btn-info col-xs-12"
				]
		]);
		return $builder->getForm();
		
	}

	
}