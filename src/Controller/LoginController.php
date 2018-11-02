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
            $profileMatchingEmail = $this->getDoctrine()
            ->getRepository(Profile::class)

            ->findOneBy(['email' => $profileEmail]);

            $session->set('loginError', false);
            
            if($profileMatchingEmail != NULL){
                $session->set('emailError', true);
                return $this->redirectToRoute('login_view');
            }

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
            $profileImage->setImagePath('monkey1.png');
            $profileImage->setActiveState(true);

            $entityManager->persist($profileImage);

            $profileImage2 = new ProfileImage();
            $profileImage2->setProfileId($profile);
            $profileImage2->setImagePath('monkey2.png');
            $profileImage2->setActiveState(false);

            $entityManager->persist($profileImage2);

            $profileImage3 = new ProfileImage();
            $profileImage3->setProfileId($profile);
            $profileImage3->setImagePath('monkey3.png');
            $profileImage3->setActiveState(false);

            $entityManager->persist($profileImage3);

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
                if($profileMatchingEmail->getBanned()){
                    $session->set('bannedError', true);
                } else {
                    if($encoder->isPasswordValid($profileMatchingEmail->getPassword(), $loginProfile->getPassword(), null)){
                    $session->set('filter', 'all');
                    $session->set('profile', $profileMatchingEmail);
                    $session->set('loginError', false);
                    return $this->redirectToRoute('discover_view');
                    } else {
                        $session->set('loginError', true);  
                    }
                }
            } else {
                $session->set('loginError', true);
            }
        }

        $loginError = $session->get('loginError');
        $emailError = $session->get('emailError');
        $bannedError = $session->get('bannedError');

        $view = 'login.html.twig';
        $model = array('SignUpform' => $SignUpform->createView(), 'loginform' => $loginform->createView(), 'bannedError' => $bannedError, 'loginError' => $loginError, 'emailError' => $emailError);

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