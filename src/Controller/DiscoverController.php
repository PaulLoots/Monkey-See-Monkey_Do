<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Riddle;
use App\Entity\Profile;

class DiscoverController extends AbstractController
{
    /**
    * @Route("/discover", name="discover_view")
    */
    public function viewDiscover()
    {
        $riddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findAll();

        $profiles = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findAll();

        //forEach($riddles as $riddle){
            //echo $riddle-> getId();
            //$profileID = $riddle -> getProfileId();

            //$profile = $this->getDoctrine()
            //->getRepository(Profile::class)
            //->find($profileID);

            //$profileName = $profile-> getName();

            //$riddle->append($profileName);

        //}

        $model = array('profiles' => $profiles,'riddles' => $riddles);
        $view = 'discover.html.twig';

        return $this->render($view, $model);
    }
}

?>