<?php

namespace BarBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class DefaultController extends Controller
{
    /**
     * @Route("/bar/{id}/{nic}",
     * 		name="bar",
     * 		requirements={
     * 			"id": "[0-9]{2}",
     * 			"nic": "[0-9]{4,6}"
     * 		})
     */
    public function indexAction($id)
    {
    	return $this->redirectToroute("baz");
    }
    	
   
    /**
     * @Route ("/baz", name="baz")
     */
    
    public function baz()
    {
    	
    	die ("oui oui");
    	
    	return $this->render(
    			'@BarBundle/Resources/views/Default/index.html.twig', [
    					"hello" => "Hello Lyon"
    					
    			]
    			
    			);
    }
}

