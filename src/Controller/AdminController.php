<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Profile;
use App\Entity\Riddle;
use App\Entity\Answer;
use App\Entity\Comment;

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

        $allProfiles = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findBy(array('admin' => NULL));

        $reportedRiddles = $this->getDoctrine()
        ->getRepository(Riddle::class)
        ->findBy(array('reported' => true));

        $reportedAnswers = $this->getDoctrine()
        ->getRepository(Answer::class)
        ->findBy(array('reported' => true));

        $reportedComments = $this->getDoctrine()
        ->getRepository(Comment::class)
        ->findBy(array('reported' => true));


        $profilesReported = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findAll();

        $model = array(
            'admins' => $admins,
            'allProfiles' => $allProfiles,
            'reportedRiddles' => $reportedRiddles,
            'reportedAnswers' => $reportedAnswers,
            'reportedComments' => $reportedComments,
            'profilesReported' => $profilesReported
        );
        $view = 'admin.html.twig';

        return $this->render($view, $model);
    }


}

?>