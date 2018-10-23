<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Profile;

use App\Form\UserProfileType;
use App\Form\LoginType;

class LoginController extends AbstractController
{
    /**
    * @Route("/login", name="login_view")
    */
    public function newProfile(Request $request)
    {
        $session = new Session();
        $session->start();

        $userProfile = new Profile();
        $SignUpform = $this->createForm(UserProfileType::class, $userProfile);
        $SignUpform->handleRequest($request);
        
        if ($SignUpform->isSubmitted() && $SignUpform->isValid()) {
            // $form->getData() holds the submitted values
            $userProfile = $SignUpform->getData();

            $profileEmail = $userProfile->getEmail();
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);
            $entityManager->flush();

            $profile = $this->getDoctrine()
            ->getRepository(Profile::class)
            ->findOneBy(['email' => $profileEmail]);

            $session->set('profile', $profile);

            return $this->redirectToRoute('discover_view');
        }

        $loginProfile = new Profile();
        $loginform = $this->createForm(LoginType::class, $loginProfile);
        $loginform->handleRequest($request);
        
        if ($loginform->isSubmitted() && $loginform->isValid()) {
            // $loginform->getData() holds the submitted values
            $loginProfile = $loginform->getData();

            // $loginEmail = $loginProfile->getEmail();
            // $loginPassword = $loginProfile->getPassword();

            // $profile = $this->getDoctrine()
            // ->getRepository(Profile::class)
            // ->findOneBy(['email' => $profileEmail]);

            



            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loginProfile);
       //     $entityManager->flush();

            return $this->redirectToRoute('discover_view');
        }


        $view = 'login.html.twig';
        $model = array('SignUpform' => $SignUpform->createView(), 'loginform' => $loginform->createView());

        return $this->render($view, $model);
    }

    //test signup
    /**
    * @Route("/success", name="profile_success")
    */
    public function successProfile(Request $request)
    {
        $view = 'success.html.twig';
        $model = array();
        return $this->render($view, $model);
    }

}
?>