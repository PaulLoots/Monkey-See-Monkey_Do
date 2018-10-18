<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Riddle;

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

        $model = array('riddles' => $riddles);
        $view = 'discover.html.twig';

        return $this->render($view, $model);
    }
}

?>