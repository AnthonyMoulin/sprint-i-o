<?php

namespace SprintBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DeleteController extends AbstractSprintController
{
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * @Route("/delete", name="delete")
	 */
	public function DeleteAction()
	{
// 		die("delete controller");
	
	if (!$this->hasGlobalAccess()) {
		return $this->redirectToHomePage();
	}
	else if (!$this->hasSprintAccess() 
			|| !$this->hasScrumMasterAccess()) {
		return $this->redirectToSprint();
	}
	else {
		
		$sprint = $this->readSprint();
		
// 		recuperer tous les users qui travaillent sur le sprint
		$users = $this
		->getDoctrine()
		->getManager()
		->getRepository(\AuthBundle\Entity\User::class)
		->findBy(
				["sprint" => $this->getSprintAccess()	
				]);
		
// 		nettoyer la colonne sprint des utilisateurs
		foreach ($users as $user) {
			$user->setSprint();
			$this->getDoctrine()->getManager()->flush();
		}
		
// 		récupérer le sprint
// 		Remove le sprint
// 		$sprint->getUser()->setSprint();
// 		$this->getDoctrine()->getManager()->flush();
		$this->getDoctrine()->getManager()->remove($sprint);
		$this->getDoctrine()->getManager()->flush();
		
// 	    il faut révoquer les droits !!!
		$this->session->remove("sprint");
		$this->session->remove("master");
		return $this->redirectToCreate();
		
		
		
// 		$sprint = $this->readUserSprint();
// 		$user = $sprint->getUser();
// 		$user -> setSprint(null);
// 		$user -> Flush();
// 		$user -> remove($sprint);
// 		$user -> Flush();
		
	return $this->render(
	'@SprintBundle/Resources/views/create.html.twig', [
	 "form"=> $form->createView(),
				]);
			
			}	
	}
}
	

