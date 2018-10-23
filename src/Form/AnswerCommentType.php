<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Answer;
use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\HttpFoundation\Session\Session;

class AnswerCommentType extends AbstractType
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
            ->add('answerId', EntityType::class, array(
                'class' => Answer::class,
                'query_builder' => function (EntityRepository $er) {
                    $session = new Session(); 
                    $answerID = $session->get('answerId');
                    return $er->createQueryBuilder('u')
                        ->where("u.id = $answerID");
                },
                'choice_label' => 'id'
            ))
            ->add('commentTxt', TextType::class)
            ->add('time', HiddenType::class)
            ->add('likes', HiddenType::class, array(
                'data' => 0
            ))
            ->add('dislikes', HiddenType::class, array(
                'data' => 0
            ))
            ->add('submitAnswerComment', SubmitType::class, ['label' => ''])
        ;
    }
}
?>