<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\UserProfileType;
use App\Form\LoginType;


class LoginController extends AbstractController
{
    /**
    * @Route("/login", name="login_view")
    */
    public function newProfile(Request $request)
    {

        $userProfile = new User();
        $SignUpform = $this->createForm(UserProfileType::class, $userProfile);
        $SignUpform->handleRequest($request);

        
        if ($SignUpform->isSubmitted() && $SignUpform->isValid()) {
            // $form->getData() holds the submitted values
            $userProfile = $SignUpform->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);
       //     $entityManager->flush();


       //SHould redirect to DISCOVER PAGE!!!!!
            return $this->redirectToRoute('profile_success');
        }

        $loginProfile = new User();
        $loginform = $this->createForm(LoginType::class, $loginProfile);
        $loginform->handleRequest($request);

        
        if ($loginform->isSubmitted() && $loginform->isValid()) {
            // $form->getData() holds the submitted values
            $loginProfile = $loginform->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loginProfile);
       //     $entityManager->flush();


       //SHould redirect to DISCOVER PAGE!!!!!
            return $this->redirectToRoute('profile_success');
        }


        $view = 'login.html.twig';
        $model = array('SignUpform' => $SignUpform->createView(), 'loginform' => $loginform->createView());

        return $this->render($view, $model);
    }

    // /**
    // * @Route("/login", name="login_view")
    // */
    // public function loginProfile(Request $request)
    // {

    //     $loginProfile = new User();
    //     $loginform = $this->createForm(LoginType::class, $loginProfile);
    //     $loginform->handleRequest($request);

        
    //     if ($loginform->isSubmitted() && $loginform->isValid()) {
    //         // $form->getData() holds the submitted values
    //         $loginProfile = $loginform->getData();

    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($loginProfile);
    //    //     $entityManager->flush();


    //    //SHould redirect to DISCOVER PAGE!!!!!
    //         return $this->redirectToRoute('profile_success');
    //     }


    //     $view = 'login.html.twig';
    //     $model = array('loginform' => $loginform->createView());

    //     return $this->render($view, $model);
    // }






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