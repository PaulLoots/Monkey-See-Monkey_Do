<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Riddle;
use App\Entity\User;

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

        forEach($riddles as $riddle){
            echo $riddle-> getId();
            $userID = $riddle -> getUserId();

            $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($userID);

            $userName = $user-> getName();

            array_push($riddle,$userName);

        }

        $model = array('riddles' => $riddles);
        $view = 'discover.html.twig';

        return $this->render($view, $model);
    }
}

?>