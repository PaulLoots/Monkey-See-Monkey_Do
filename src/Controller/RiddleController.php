<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Riddle;
use App\Entity\Profile;

class RiddleController extends AbstractController
{
    /**
    * @Route("/riddle/{id}", name="riddle_view")
    */
    public function viewRiddle($id = "1")
    {
        $riddleId = (int) $id;

        $riddle = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->find($riddleId);

        $profileId = $riddle->getProfileId(); 

        $profile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);
        
        $model = array('profile' => $profile,'riddle' => $riddle);
        $view = 'riddle.html.twig';

        return $this->render($view, $model);
    }
}

?>