<?php

namespace AuthBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends AbstractAuthController
{
	
	const 
	/**
	 * @var string error message for authentification
	 */
	ERROR_MESSAGE_AUTH = "Incorrect email or password";
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * @Route("/auth", name="auth")
	 */
	public function AuthAction(Request $request)
	{

		if ($this->hasGlobalAccess()) {
			return $this->redirectToHomePage();
		}
		$message = "";	
		$form = $this->getAuthAndJoinForm(
			"Sign in"
		);
		$form ->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			 $user = $this->readUser($form);
			
			if ($user && password_verify(
					$form->getData() ["password"],
					$user->getPassword()		
				)) {
				$this->setGlobalAccess($user);
				return $this->redirectToHomePage();
			}
			$message = self::ERROR_MESSAGE_AUTH;
		}
		
	    return $this->render(
			'@AuthBundle/Resources/views/sign.html.twig', [
					"title" => "Sign in",
					"form"	=> $form->CreateView(),
					"legend" => "New to Sprint-io?",
					"link" => "Create an account",
					"route" => "join",
					"url" => $this->generateUrl ("join"),
					"message" => isset($message) ? $message : "",
			]
	    );
	}
	    
}
