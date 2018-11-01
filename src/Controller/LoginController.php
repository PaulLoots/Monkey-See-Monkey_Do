<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;

use App\Entity\Profile;
use App\Entity\ProfileImage;

use App\Form\UserProfileType;
use App\Form\LoginType;

class LoginController extends AbstractController
{
    /**
    * @Route("/login", name="login_view")
    */
    public function newProfile(Request $request, SessionInterface $session)
    {
        $userProfile = new Profile();
        $SignUpform = $this->createForm(UserProfileType::class, $userProfile);
        $SignUpform->handleRequest($request);
        
        if ($SignUpform->isSubmitted() && $SignUpform->isValid()) {
            // $form->getData() holds the submitted values
            $userProfile = $SignUpform->getData();

            $profileEmail = $userProfile->getEmail();

            $encoder = new BCryptPasswordEncoder(12);
            $userProfile->setPassword($encoder->encodePassword($userProfile->getPassword(), null));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($userProfile);

            $entityManager->flush();

            $profile = $this->getDoctrine()
            ->getRepository(Profile::class)
            ->findOneBy(['email' => $profileEmail]);

            //set default profileImage
            $entityManager = $this->getDoctrine()->getManager();

            $profileImage = new ProfileImage();
            $profileImage->setProfileId($profile);
            $profileImage->setImagePath('monkey.png');
            $profileImage->setActiveState(true);

            $entityManager->persist($profileImage);
            $entityManager->flush();

            $session->set('profile', $profile);
            $session->set('filter', 'all');

            return $this->redirectToRoute('discover_view');
        }

        $profile = $this->getDoctrine()
            ->getRepository(Profile::class)
            ->findAll();
        
        $loginProfile = new Profile();
        $loginform = $this->createForm(LoginType::class, $loginProfile);
        $loginform->handleRequest($request);
        
        if ($loginform->isSubmitted()) {
            $loginProfile = $loginform->getData();

            $loginEmail = $loginProfile->getEmail();
            //$loginPassword = $loginProfile->getPassword();

            $profileMatchingEmail = $this->getDoctrine()
            ->getRepository(Profile::class)
            ->findOneBy(['email' => $loginEmail]);

            $encoder = new BCryptPasswordEncoder(12);

            if($profileMatchingEmail != NULL){
                if($encoder->isPasswordValid($profileMatchingEmail->getPassword(), $loginProfile->getPassword(), null)){
                $session->set('filter', 'all');
                $session->set('profile', $profileMatchingEmail);
                $session->set('loginError', false);
                return $this->redirectToRoute('discover_view');
                } else {
                    $session->set('loginError', true);  
                }
            } else {
                $session->set('loginError', true);
            }
        }

        $loginError = $session->get('loginError');

        $view = 'login.html.twig';
        $model = array('SignUpform' => $SignUpform->createView(), 'loginform' => $loginform->createView(), 'loginError' => $loginError);

        return $this->render($view, $model);
    }

    /**
    * @Route("/logout", name="logout_view")
    */
    public function logout(Request $request, SessionInterface $session)
    {
        $session->clear();
        $session->invalidate();
        return $this->redirectToRoute('login_view');
    }

}
?>