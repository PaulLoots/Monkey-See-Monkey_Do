<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Profile;
use App\Entity\ProfileImage;
use App\Form\EditProfileType;
use App\Form\ProfileImageType;


class EditProfileController extends AbstractController
{
    /**
    * @Route("/editprofile/{id}", name="editProfile_view")
    */
    public function updateProfile($id = "1", Request $request)
    {
        $session = new Session();
        $session->start();


        // update Profile handle

        $profile = $this->getDoctrine()
            ->getRepository(Profile::class)
            ->find($id);
        
        $form = $this->createForm(EditProfileType::class, $profile);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            $userProfile = $form->getData();

            $profileName = $userProfile->getName();
            $profileEmail = $userProfile->getEmail();
            $profilePassword = $userProfile->getPassword();
            
            $entityManager = $this->getDoctrine()->getManager();

            $profile->setName($profileName);
            $profile->setEmail($profileEmail);
            $profile->setPassword($profilePassword);

            $session->set('profile', $profile);

            $entityManager->persist($profile);
            $entityManager->flush();

            return $this->redirectToRoute('discover_view');
        }

        // upload Image handle

        $profileId=1;

        $profilesImage = $this->getDoctrine()
        ->getRepository(Profile::class)
        ->find($profileId);

        $session->set('profile', $profilesImage);

        //UNCOMMENT to let this page work with sessions
        //$profile = $session->get('profile');
        //$profileId = $profile->getId();
        
        $profileImage = new ProfileImage();
        $Uploadform = $this->createForm(ProfileImageType::class, $profileImage);
        $Uploadform->handleRequest($request);


            if ($Uploadform->isSubmitted() && $Uploadform->isValid()) {

                $entityManager = $this->getDoctrine()->getManager();

                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                // $file=$profileImage->getImagePath();
                $file=$Uploadform->get('image_path')->getData();

                $fileName = "test1234.".$file->guessExtension();

                // $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('profileImages_directory'),
                        $fileName
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                $profileImage->setImagePath($fileName);

                $entityManager->persist($profileImage);
                $entityManager->flush();

                return $this->redirectToRoute('editProfile_view');
            }



      $view = 'editProfile.html.twig';
        $model = array('form' => $form->createView(), 'Uploadform' => $Uploadform->createView());

        return $this->render($view, $model);

    }

}
?>