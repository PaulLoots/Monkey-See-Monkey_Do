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

      $view = 'editProfile.html.twig';
        $model = array('form' => $form->createView());

        return $this->render($view, $model);

    }


}
?>