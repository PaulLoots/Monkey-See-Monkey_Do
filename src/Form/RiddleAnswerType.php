<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Riddle;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\HttpFoundation\Session\Session;

class RiddleAnswerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('profileId', EntityType::class, array(
                'class' => Profile::class,
                'query_builder' => function (EntityRepository $er) {
                    $session = new Session(); 
                    $profile = $session->get('profile');
                    $profileID = $profile->getId();
                    return $er->createQueryBuilder('u')
                        ->where("u.id = $profileID");
                },
                'choice_label' => 'id'
            ))
            ->add('riddleId', EntityType::class, array(
                'class' => Riddle::class,
                'query_builder' => function (EntityRepository $er) {
                    $session = new Session(); 
                    $riddleID = $session->get('riddleId');
                    return $er->createQueryBuilder('u')
                        ->where("u.id = $riddleID");
                },
                'choice_label' => 'id'
            ))
            ->add('answerTxt', TextType::class)
            ->add('time', HiddenType::class, array(
                'data' => date("d M")
            ))
            ->add('likes', HiddenType::class, array(
                'data' => 0
            ))
            ->add('dislikes', HiddenType::class, array(
                'data' => 0
            ))
            ->add('correct', HiddenType::class, array(
                'data' => 0
            ))
            ->add('submitAnswerRiddle', SubmitType::class, ['label' => 'Answer'])
        ;
    }
}
?>