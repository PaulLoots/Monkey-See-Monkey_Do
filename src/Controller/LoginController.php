<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\User;
use App\Form\UserProfileType;

class LoginController extends AbstractController
{
    /**
    * @Route("/login", name="login_view")
    */
    public function newProfile(Request $request)
    {

        $userProfile = new User();
        $form = $this->createForm(UserProfileType::class, $userProfile);
        $form->handleRequest($request);


        $view = 'login.html.twig';
        $model = array('form' => $form->createView());



        return $this->render($view, $model);
    }

}
?>