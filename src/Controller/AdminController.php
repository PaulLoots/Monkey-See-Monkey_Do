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
    public function viewAdmin(Request $request)
    {

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
                    
                if($action == 'RemoveAdmin'){
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

            //Not working yet
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

            //Not Working
            //Delete Reported Answer
            if($target == "ReportedAnswerDelete"){
                $AnswerId = $_POST['id'];
                $action = $_POST['action'];

                $AnswerReported = $entityManager->getRepository(Answer::class)->find($AnswerId);
                $AssosiatedComment = $entityManager->getRepository(Comment::class)->findby(array('Answer_id' => $AnswerId));
                
                if($action == 'deleteAnswer'){
                    $entityManager->remove($AssosiatedComment);
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
            'Profiles' => $Profiles,
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