<?php

namespace SprintBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use SprintBundle\Entity\Sprint;

class SprintController extends AbstractSprintController
{

	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * @Route("/sprint", name="sprint")
	 */
	public function SprintAction()
	{
		if (!$this->hasGlobalAccess()) {
			return $this->redirectToHomePage();
		}
		else if (!$this->hasSprintAccess()) {
			return $this->redirectToCreate();
		}
		else {

			$sprint = $this
			->getDoctrine()
			->getManager()
			->getRepository(Sprint::class)
			->findOneBy(
					["id" => $this->getSprintAccess()]
			);
		
		
// echo "Sprint Time: " . $sprint->getTime() . "<br>";
// echo "Sprint Days: " . $sprint->getDay() . "<br>";
// echo "Current Time: " . time() . "<br>";
// echo "<br>Donc<br><br>";

$lapsed = (time() - $sprint->getTime());
$duration = $sprint->getDay() * 86400;

// echo "Lapsed Time: " . $lapsed . "<br>";
// echo "Duration Time: " . $duration . "<br>";

// echo "<br>Alors<br>";

// echo "Pourcentage de temps passé: "
// 	. (round($lapsed / $duration * 100, 2))
// 	. "%"; 

	return $this->render(
			'@SprintBundle/Resources/views/sprint.html.twig', [

					"goal"=> $sprint->getGoal(),
					"description"=> $sprint->getDescription(),
					"day"=> $sprint->getDay(),
					"percent"=> (round($lapsed / $duration *100, 2)),
					"master_access"=> $this->hasScrumMasterAccess()
				
					]);
	
			}	
	}
}	
