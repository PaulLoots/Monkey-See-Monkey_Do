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
use App\Entity\RiddleLikes;
use App\Entity\Profile;
use App\Form\AnswerCommentType;

class AnswersController extends AbstractController
{
    /**
    * @Route("/answers/{id}", name="answers_view")
    */
    public function viewAnswers($id = "33", Request $request)
    {
        $session = new Session();
        $session->start();
    
        $riddleId = (int) $id;

        $session->set('riddleId', $riddleId);

        $riddle = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->find($riddleId);

        $questionProfileId = $riddle->getProfileId(); 

        $questionProfile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($questionProfileId);

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

        $profileId = 2;

        $profile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);        

        //AJAX

        if ($request->isXmlHttpRequest()) {  
            $entity = $_POST['entity'];
            $vote = $_POST['vote'];

            $likes = 0;
            $dislikes = 0;
            
            $entityManager = $this->getDoctrine()->getManager();

            if($entity == 'Riddle'){
                $riddleId = $_POST['id'];
                $riddle = $entityManager->getRepository(Riddle::class)->find($riddleId);

                $riddleProfileID = $riddle->getProfileId();
                $riddleProfile = $entityManager->getRepository(Profile::class)->find($riddleProfileID);
                $score = $riddleProfile->getRiddlingScore();
                
                if($vote == 'Like'){
                    $likes = $riddle->getLikes();
                    $riddle->setLikes($likes + 1);
                    $riddleProfile->setRiddlingScore($score + 82);
                } else {
                    $dislikes = $riddle->getDislikes();
                    $riddle->setDislikes($dislikes + 1);
                    $riddleProfile->setRiddlingScore($score + 27);
                }
            }

            if($entity == 'Answer'){
                $answerId = $_POST['id'];
                $answer = $entityManager->getRepository(Answer::class)->find($answerId);

                $answerProfileID = $answer->getProfileId();
                $answerProfile = $entityManager->getRepository(Profile::class)->find($answerProfileID);
                $score = $answerProfile->getRiddlingScore();

                if($vote == 'Like'){
                    $likes = $answer->getLikes();
                    $answer->setLikes($likes + 1);
                    $answerProfile->setRiddlingScore($score + 36);
                } else {
                    $dislikes = $answer->getDislikes();
                    $answer->setDislikes($dislikes + 1);
                    $answerProfile->setRiddlingScore($score + 11);
                }
            }

            if($entity == 'Comment'){
                $commentId = $_POST['id'];
                $comment = $entityManager->getRepository(Comment::class)->find($commentId);
                $commentProfileID = $comment->getProfileId();
                $commentProfile = $entityManager->getRepository(Profile::class)->find($commentProfileID);
                $score = $commentProfile->getRiddlingScore();

                if($vote == 'Like'){
                    $likes = $comment->getLikes();
                    $comment->setLikes($likes + 1);
                    $commentProfile->setRiddlingScore($score + 16);
                } else {
                    $dislikes = $comment->getDislikes();
                    $comment->setDislikes($dislikes + 1);
                    $commentProfile->setRiddlingScore($score + 5);
                }
            }
            $entityManager->flush();

            return $likes + $dislikes +1; 
         }

        $model = array(
            'user' => $profile,'profile' => $questionProfile,'riddle' => $riddle, 'answers' => $answers, 'comments' => $comments
        );
        $view = 'answers.html.twig';

        return $this->render($view, $model);
    }
}

?>