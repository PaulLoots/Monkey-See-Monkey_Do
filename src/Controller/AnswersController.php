<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Answer;
use App\Entity\Riddle;
use App\Entity\Profile;
//use App\Form\RiddleAnswerType;

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

        //$session = new Session();
        //$session->start();

        //UNCOMMENT to let this page work with sessions
        //$profile = $session->get('profile');
        //$profileId = $profile->getId();

        //$profileId = 1;

        //$profile = $this->getDoctrine()
        //->getRepository(Profile::class)
        //->find($profileId);

        //$session->set('profile', $profile);
        //$session->set('riddleId', $riddleId);

        //form
        //$createAnswer = new Answer();
        //$form = $this->createForm(RiddleAnswerType::class, $createAnswer);
        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid()) {
           
        //    $createAnswer = $form->getData();
        //    $entityManager = $this->getDoctrine()->getManager();
        //    $entityManager->persist($createAnswer);
        //    $entityManager->flush();
        //    return $this->redirectToRoute('discover_view');
        //}        

        $model = array(
            'profile' => $questionProfile,'riddle' => $riddle, 'answers' => $answers
            //'form' => $form->createView()
        );
        $view = 'answers.html.twig';

        return $this->render($view, $model);
    }
}

?>