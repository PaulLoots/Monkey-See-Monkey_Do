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
use App\Form\CreateRiddleType;

class MyRiddlesController extends AbstractController
{
    /**
    * @Route("/myriddles/{id}", name="myriddles_view")
    */
    public function viewMyRiddles($id = "1", Request $request)
    {
        $session = new Session();
        $session->start();

        $profileId = (int) $id;

        $profile = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);

        $session->set('profile', $profile);

        //UNCOMMENT to let this page work with sessions
        //$profile = $session->get('profile');
        //$profileId = $profile->getId();

        $riddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findBy(array('profile_id' => $profileId));


        $answers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findBy(array('correct' => NULL));

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
                
            if($vote == 'Correct'){
                $answer->setCorrect(true);
            } else {
                $answer->setCorrect(false);
            }

            $entityManager->flush();

            return true; 
         }
         
        $model = array('profile' => $profile,'riddles' => $riddles, 'answers' => $answers, 'form' => $form->createView());
        $view = 'myriddles.html.twig';

        return $this->render($view, $model);
    }
}

?>