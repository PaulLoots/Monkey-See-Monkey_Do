<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Profile;

class LeaderboardController extends AbstractController
{
    /**
    * @Route("/leaderboard", name="leaderboard_view")
    */
    public function showLeaderboard(Request $request, SessionInterface $session)
    {
        //UNCOMMENT to let this page work with sessions
        $profile = $session->get('profile');
        $profileId = $profile->getId();

        $profiles = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findAll();
        
        usort($profiles, function ($a, $b) { return $b->getRiddlingScore() - $a->getRiddlingScore(); });
        //$last_5_feedbacks = array_slice ($feedbacks, -5);

        $view = 'leaderboard.html.twig';
        $model = array('myProfile' => $profile, 'profiles' => $profiles);

        return $this->render($view, $model);
    }

}
?>