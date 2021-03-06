<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends AbstractAppController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render(
        		'@AppBundle/Resources/views/Default/home.html.twig',
        		[
        				"global_access" => $this->hasGlobalAccess()
        				
        		]
        		);
        		
    }
}
