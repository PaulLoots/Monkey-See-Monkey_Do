<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
/**
* @Route("/login", name="login_view")
*/
public function Login()
{


$model = array();
$view = 'login.html.twig';


return $this->render($view, $model);
}
}
?>