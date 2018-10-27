<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Riddle;
use App\Entity\Profile;
use App\Entity\Answer;

class DiscoverController extends AbstractController
{
    /**
    * @Route("/discover", name="discover_view")
    */
    public function viewDiscover(Request $request)
    {
        $session = new Session();
        $session->start();

        //UNCOMMENT to let this page work with sessions
        //$profile = $session->get('profile');
        //$profileId = $profile->getId();

        $profileId = 8;

        $profile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);

        $riddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findAll();

        shuffle($riddles);

        $profiles = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findAll();

        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findAll();

        
        //AJAX
        if ($request->isXmlHttpRequest()) {  
            $filter = $_POST['filter'];

            if($filter == "user"){
                $username = $_POST['username'];
                $session->set('filterUsername', $username );
            }

            $model = array('filterItem' => $filter,'profile' => $profile, 'profiles' => $profiles, 'answers' => $answers,'riddles' => $riddles);
            $view = 'discover.html.twig';

            $session->set('filter', $filter );
            
            return $this->render($view, $model); 
            

         } else {

            $filter = $session->get('filter');
            $username = $session->get('filterUsername');
        
        $model = array('filterUsername' => $username, 'filterItem' => $filter,'profile' => $profile, 'profiles' => $profiles, 'answers' => $answers,'riddles' => $riddles);
        $view = 'discover.html.twig';

        return $this->render($view, $model);

         }
    }
}

?>