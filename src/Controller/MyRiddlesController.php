<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Riddle;
use App\Entity\Profile;

class MyRiddlesController extends AbstractController
{
    /**
    * @Route("/myriddles/{id}", name="myriddles_view")
    */
    public function viewMyRiddles($id = "1")
    {
        $profileId = (int) $id;

        $profile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);

        $riddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findBy(array('profile_id' => $profileId));
         
        $model = array('profile' => $profile,'riddles' => $riddles);
        $view = 'myriddles.html.twig';

        return $this->render($view, $model);
    }
}

?>