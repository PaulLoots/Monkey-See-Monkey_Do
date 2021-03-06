<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Riddle;
use App\Entity\Profile;
use App\Entity\ProfileImage;
use App\Entity\Answer;

class DiscoverController extends AbstractController
{
    /**
    * @Route("/discover", name="discover_view")
    */
    public function viewDiscover(Request $request, SessionInterface $session)
    {
        //UNCOMMENT to let this page work with sessions
        $profile = $session->get('profile');

        if($session->has('profile') == false){
            return $this->redirectToRoute('login_view');
        }
        $profileId = $profile->getId();

        $riddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findAll();

        shuffle($riddles);

        $profiles = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findAll();

        $profileImage = $this->getDoctrine()
        ->getRepository(ProfileImage::class)
        ->findOneBy(array('active_state' => true, 'profile_id' => $profileId));

        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findAll();

        $answersBadge = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findBy(array('correct' => NULL));

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
        
        $model = array('filterUsername' => $username, 'filterItem' => $filter, 'answersBadge' => $answersBadge, 'profileImage' => $profileImage, 'profile' => $profile, 'profiles' => $profiles, 'answers' => $answers,'riddles' => $riddles);
        $view = 'discover.html.twig';

        return $this->render($view, $model);

         }
    }
    /**
    * @Route("/monkeysays", name="monkeySays_view")
    */
    public function viewMonkeySays(Request $request, SessionInterface $session)
    {
        $model = array();
        $view = 'monkey_says.html.twig';

        return $this->render($view, $model);
    }
}

?>