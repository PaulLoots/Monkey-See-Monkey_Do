<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class LeaderboardController extends AbstractController
{
    /**
    * @Route("/leaderboard", name="leaderboard_view")
    */
    public function showLeaderboard(Request $request)
    {


        $view = 'leaderboard.html.twig';
        $model = array();

        
        return $this->render($view, $model);
    }

}
?>