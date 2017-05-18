<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AuthBundle\Entity\User;
use Symfony\Component\HttpFoundation\Session\Session;


abstract class AbstractAppController extends Controller
{
	
	protected $session;
	
	/**
	 * 
	 */
	public function __construct()
	{
		$this->session = new Session();
	}
	
	/**
	 * 
	 * @return \Symfony\Component\HttpFoundation\RedirectResponse
	 */
	protected function redirectToHomePage()
	{
		return $this->redirectToRoute("homepage");
	}
	
	/**
	 * 
	 * @return bool
	 */
	protected function hasGlobalAccess(): bool
	{
		return (bool) $this->getGlobalAccess();
		
	}
	
	/**
	 * 
	 * @param User $user
	 */
	protected function setGlobalAccess(User $user)
	{
		$this->session->set("id", $user->getId());
		
	}
	
	/**
	 * 
	 * @return mixed
	 */
	protected function getGlobalAccess()
	{
		return $this->session->get("id");
	}

	
}