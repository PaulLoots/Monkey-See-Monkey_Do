<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use App\Entity\Profile;
use App\Entity\ProfileImage;
use App\Form\EditProfileType;
use App\Form\ProfileImageType;


class EditProfileController extends AbstractController
{
    /**
    * @Route("/editprofile", name="editProfile_view")
    */
    public function updateProfile(Request $request, SessionInterface $session)
    {
        if($session->has('profile') == false){
            return $this->redirectToRoute('login_view');
        }

        $profile = $session->get('profile');
        $profileId = $profile->getId();

        $profileImg = $this->getDoctrine()
        ->getRepository(ProfileImage::class)
        ->findOneBy(array('active_state' => true, 'profile_id' => $profileId));

        // update Profile handle
        $profile = $this->getDoctrine()
            ->getRepository(Profile::class)
            ->find($profileId);
        
        $form = $this->createForm(EditProfileType::class, $profile);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $userProfile = $form->getData();

            $profileName = $userProfile->getName();
            $profileEmail = $userProfile->getEmail();
            
            $entityManager = $this->getDoctrine()->getManager();

            $profile->setName($profileName);
            $profile->setEmail($profileEmail);

            $session->set('profile', $profile);

            $entityManager->persist($profile);
            $entityManager->flush();

            return $this->redirectToRoute('discover_view');
        }

        // upload Image handle

        $profilesImage = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);
        
        $profileImage = new ProfileImage();
        $Uploadform = $this->createForm(ProfileImageType::class, $profileImage);
        $Uploadform->handleRequest($request);

        $oldImages = $this->getDoctrine()
        ->getRepository(ProfileImage::class)
        ->findBy(array("profile_id"=>$profileId));

            if ($Uploadform->isSubmitted() && $Uploadform->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();

                forEach($oldImages as $oldImage){
                    $oldImage->setActiveState(false);  
                }

                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                // $file=$profileImage->getImagePath();
                $file=$Uploadform->get('image_path')->getData();

                $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                $bucket->upload(
                    file_get_contents($_FILES[$file]['tmp_name']),
                    [
                        'name' => $_FILES[$file][$fileName]
                    ]
                );
                // Move the file to the directory where brochures are stored
                // try {
                //     $file->move(
                //         $this->getParameter('profileImages_directory'),
                //         $fileName
                //     );
                // } catch (FileException $e) {
                //     // ... handle exception if something happens during file upload
                // }

                $profileImage->setImagePath($fileName);

                $entityManager->persist($profileImage);
                $entityManager->flush();

                return $this->redirectToRoute('editProfile_view');
            }


            if ($request->isXmlHttpRequest()) {  
                $action = $_POST['action'];
                $imageId = $_POST['id'];

                $entityManager = $this->getDoctrine()->getManager();

                $otherImages = $entityManager->getRepository(ProfileImage::class)->findby(array('profile_id' => $profileId));
                $image = $entityManager->getRepository(ProfileImage::class)->find($imageId);
    
                if($action == "changeImage"){

                    forEach($otherImages as $otherImage){
                        $otherImage->setActiveState(false);  
                    }
                    $image->setActiveState(true);
                }
                $entityManager->flush();
                return true; 
             }

      $view = 'editProfile.html.twig';
        $model = array('form' => $form->createView(), 'Uploadform' => $Uploadform->createView(), 'profileImage' => $profileImg, 'oldImages' => $oldImages, 'profile' => $profile);

        return $this->render($view, $model);

    }

     /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }

}
?>