<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Profile;

class AdminController extends AbstractController
{
    /**
    * @Route("/admin", name="admin_view")
    */
    public function viewAdmin()
    {

        $admins = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findBy(array('admin' => true));

        // change to false
        $allProfiles = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findBy(array('admin' => NULL));

        $model = array('admins' => $admins, 'allProfiles' => $allProfiles);
        $view = 'admin.html.twig';

        return $this->render($view, $model);
    }


}

?>