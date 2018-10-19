<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

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

        $riddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findBy(array('profile_id' => $profileId));

        //form
        $createRiddle = new Riddle();
        $form = $this->createForm(CreateRiddleType::class, $createRiddle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $createRiddle = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($createRiddle);
            $entityManager->flush();
            return $this->redirectToRoute('myriddles_view');
        }
         
        $model = array('profile' => $profile,'riddles' => $riddles,'form' => $form->createView());
        $view = 'myriddles.html.twig';

        return $this->render($view, $model);
    }
}

?>