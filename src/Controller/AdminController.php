<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Profile;
use App\Entity\Riddle;
use App\Entity\Answer;
use App\Entity\Comment;
use App\Entity\ProfileImage;

class AdminController extends AbstractController
{
    /**
    * @Route("/admin", name="admin_view")
    */
    public function viewAdmin(Request $request, SessionInterface $session)
    {
        if($session->has('profile') == false){
            return $this->redirectToRoute('login_view');
        }
        $profile = $session->get('profile');
        $profileId = $profile->getId();

        if($profile->getAdmin() != true){
            return $this->redirectToRoute('discover_view');
        }

        $profileImages = $this->getDoctrine()
        ->getRepository(ProfileImage::class)
        ->findBy(array('active_state' => true));

        $profileImage = $this->getDoctrine()
        ->getRepository(ProfileImage::class)
        ->findOneBy(array('active_state' => true, 'profile_id' => $profileId));

        $Profiles = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->findAll();

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

        //Admin ajax

        if ($request->isXmlHttpRequest()) {  
            $target = $_POST['target'];

            $entityManager = $this->getDoctrine()->getManager();

            //Remove Admin
            if($target == "AdminList"){
                $adminId = $_POST['id'];
                $action = $_POST['action'];

                $profileAdmin = $entityManager->getRepository(Profile::class)->find($adminId);
                $allAdmin = $this->getDoctrine()
                ->getRepository(Profile::class)
                ->findBy(array('admin' => true));
                    
                if(sizeof($allAdmin) > 1){
                    $profileAdmin->setAdmin(false);
                } else {
                    $profileAdmin->setAdmin(true);
                    }
            }

            //Unbanned User from list
            if($target == "BannedList"){
                $BannedId = $_POST['id'];
                $action = $_POST['action'];

                $ProfileBanned = $entityManager->getRepository(Profile::class)->find($BannedId);
                    
                if($action == 'UnbanProfile'){
                    $ProfileBanned->setBanned(false);
                } else {
                    $ProfileBanned->setBanned(true);
                    }
            }

            //Add User to Admin
            if($target == "UsersList"){
                $UserId = $_POST['id'];
                $action = $_POST['action'];

                $UserProfile = $entityManager->getRepository(Profile::class)->find($UserId);
                    
                if($action == 'AddAdmin'){
                    $UserProfile->setAdmin(true);
                } else {
                    $UserProfile->setAdmin(false);
                    }
            }

            //Ignore Reported Riddle
            if($target == "ReportedRiddle"){
                $RiddleId = $_POST['id'];
                $action = $_POST['action'];

                $RiddleReported = $entityManager->getRepository(Riddle::class)->find($RiddleId);
                    
                if($action == 'dismissRiddle'){
                    $RiddleReported->setReported(false);
                } else {
                    $RiddleReported->setReported(true);
                    }
            }

            if($target == "ReportedRiddleDelete"){
                $RiddleId = $_POST['id'];
                $action = $_POST['action'];

                $RiddleReported = $entityManager->getRepository(Riddle::class)->find($RiddleId);
                $AssosiatedAnswers = $entityManager->getRepository(Answer::class)->findby(array('riddle_id' => $RiddleId));
                
                if($action == 'deleteRiddle'){
                    foreach ($AssosiatedAnswers as $AssosiatedAnswer)
                    {
                        $AssosiatedComments = $AssosiatedAnswer->getComments();

                        foreach ($AssosiatedComments as $AssosiatedComment)
                        {
                           $entityManager->remove($AssosiatedComment);
                        }
                        $entityManager->remove($AssosiatedAnswer);
                    }
                    //$entityManager->remove($AssosiatedComment);
                    $entityManager->remove($RiddleReported);
                } else {
                    $AnswerReported->setReported(true);
                    }
            }

            //Ignore Reported Answer
            if($target == "ReportedAnswer"){
                $AnswerId = $_POST['id'];
                $action = $_POST['action'];

                $AnswerReported = $entityManager->getRepository(Answer::class)->find($AnswerId);
                    
                if($action == 'dismissAnswer'){
                    $AnswerReported->setReported(false);
                } else {
                    $AnswerReported->setReported(true);
                    }
            }

            //Delete Reported Answer
            if($target == "ReportedAnswerDelete"){
                $AnswerId = $_POST['id'];
                $action = $_POST['action'];

                $AnswerReported = $entityManager->getRepository(Answer::class)->find($AnswerId);
                $AssosiatedComments = $entityManager->getRepository(Comment::class)->findby(array('answer_id' => $AnswerId));
                
                if($action == 'deleteAnswer'){
                    foreach ($AssosiatedComments as $AssosiatedComment)
                    {
                        $entityManager->remove($AssosiatedComment);
                    }
                    $entityManager->remove($AnswerReported);
                } else {
                    $AnswerReported->setReported(true);
                    }
            }

            //Ignore Reported Comment
            if($target == "ReportedComment"){
                $CommentId = $_POST['id'];
                $action = $_POST['action'];

                $CommentReported = $entityManager->getRepository(Comment::class)->find($CommentId);
                    
                if($action == 'dismissComment'){
                    $CommentReported->setReported(false);
                } else {
                    $CommentReported->setReported(true);
                    }
            }

            //Delete Reported Comment
            if($target == "ReportedCommentDelete"){
                $CommentId = $_POST['id'];
                $action = $_POST['action'];

                $CommentReported = $entityManager->getRepository(Comment::class)->find($CommentId);
                    
                if($action == 'deleteComment'){
                    $entityManager->remove($CommentReported);
                } else {
                    $CommentReported->setReported(true);
                    }
            }

            $entityManager->flush();

            return true; 
         }

        $model = array(
            'profile' => $profile,
            'Profiles' => $Profiles,
            'reportedRiddles' => $reportedRiddles,
            'reportedAnswers' => $reportedAnswers,
            'reportedComments' => $reportedComments,
            'profilesReported' => $profilesReported,
            'profileImages' => $profileImages,
            'profileImage' => $profileImage,
        );
        $view = 'admin.html.twig';

        return $this->render($view, $model);
    }


}

?>