<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
/**
* @Route("/user/{id}", name="user_view")
*/
public function viewUser($id = "1")
{
$userId = (int) $id;
$users = [
array("id" => 1, "name" => "Mark"),
array("id" => 2, "name" => "Grace"),
array("id" => 3, "name" => "Bill")
];

$model = array();
$view = 'user.html.twig';

foreach ($users as $user) {
    if ($userId === $user['id']) {
        $model['user'] = $user;
    }
}
return $this->render($view, $model);
}
}
?>