<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Profile;

use App\Form\EditProfileType;

class EditProfileController extends AbstractController
{
    /**
    * @Route("/editprofile", name="editProfile_view")
    */
    public function updateProfile(Request $request)
    {
        $session = new Session();
        $session->start();

        $userProfile = new Profile();
        $EditProfileform = $this->createForm(EditProfileType::class, $userProfile);
        $EditProfileform->handleRequest($request);
        
        if ($EditProfileform->isSubmitted() && $EditProfileform->isValid()) {
            // $form->getData() holds the submitted values
            $userProfile = $EditProfileform->getData();

            $profileEmail = $userProfile->getEmail();
            

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);
            $entityManager->flush();

            $profile = $this->getDoctrine()
            ->getRepository(Profile::class)
            ->findOneBy(['email' => $profileEmail]);

            $session->set('profile', $profile);

            return $this->redirectToRoute('editProfile_view');
        }

      $view = 'editProfile.html.twig';
        $model = array('EditProfileform' => $EditProfileform->createView());

        return $this->render($view, $model);

    }

}
?>