<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Answer;
use App\Entity\Comment;
use App\Entity\Riddle;
use App\Entity\Profile;
use App\Form\AnswerCommentType;

class AnswersController extends AbstractController
{
    /**
    * @Route("/answers", name="answers_view")
    */
    public function viewAnswers(Request $request)
    {
        $session = new Session();
        $session->start();
    
        $riddleId = $session->get('riddleId');

        $riddle = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->find($riddleId);

        $questionProfileId = $riddle->getProfileId(); 

        $questionProfile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($questionProfileId);

        //$answerId = $riddle->getAnswerId(); 

        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findAll();

        $comments = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findAll();

        //$session = new Session();
        //$session->start();

        //UNCOMMENT to let this page work with sessions
        //$profile = $session->get('profile');
        //$profileId = $profile->getId();

        $profileId = 1;

        $profile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);        

        $model = array(
            'profile' => $questionProfile,'riddle' => $riddle, 'answers' => $answers, 'comments' => $comments
        );
        $view = 'answers.html.twig';

        return $this->render($view, $model);
    }
}

?>