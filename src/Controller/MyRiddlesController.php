<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Answer;
use App\Entity\Riddle;
use App\Entity\Profile;
use App\Form\CreateRiddleType;
use App\Entity\ProfileImage;

class MyRiddlesController extends AbstractController
{
    /**
    * @Route("/myriddles", name="myriddles_view")
    */
    public function viewMyRiddles(Request $request, SessionInterface $session)
    {
        if($session->has('profile') == false){
            return $this->redirectToRoute('login_view');
        }
        //UNCOMMENT to let this page work with sessions
        $profile = $session->get('profile');
        $profileId = $profile->getId();

        $profileImage = $this->getDoctrine()
        ->getRepository(ProfileImage::class)
        ->findOneBy(array('active_state' => true, 'profile_id' => $profileId));

        $riddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findBy(array('profile_id' => $profileId));

        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findBy(array('correct' => NULL));

        $answersAll = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findAll();

        //form
        $createRiddle = new Riddle();
        $form = $this->createForm(CreateRiddleType::class, $createRiddle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $createRiddle = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($createRiddle);
            $entityManager->flush();
            return $this->redirectToRoute('myriddles_view');
        }

        //ajax

        if ($request->isXmlHttpRequest()) {  
            $answerId = $_POST['id'];
            $vote = $_POST['vote'];
            
            $entityManager = $this->getDoctrine()->getManager();

            $answer = $entityManager->getRepository(Answer::class)->find($answerId);

            $answerProfileID = $answer->getProfileId();
            $answerProfile = $entityManager->getRepository(Profile::class)->find($answerProfileID);
            $answerScore = $answerProfile->getRiddlingScore();

            $myScore = $profile->getRiddlingScore();
            $profile->setRiddlingScore($myScore + 186);
                
            if($vote == 'Correct'){
                $answer->setCorrect(true);
                $answerProfile->setRiddlingScore($answerScore + 186);
            } else {
                $answer->setCorrect(false);
            }

    
                if($vote == "reportAnswer"){
                    $answerId = $_POST['id'];
    
                    $AnswerReported = $entityManager->getRepository(Answer::class)->find($answerId);
                    $AnswerReported->setReported(true);
                }
    

    

            $entityManager->flush();

            return true; 
         }
         
        $model = array('profileImage' => $profileImage, 'profile' => $profile,'riddles' => $riddles, 'answers' => $answers, 'answersAll' => $answersAll, 'form' => $form->createView());
        $view = 'myriddles.html.twig';

        return $this->render($view, $model);
    }
}

?>