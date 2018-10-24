<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\HttpFoundation\Session\Session;

class CreateRiddleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            //->add('profile_id', HiddenType::class)
            ->add('profileId', EntityType::class, array(
                // looks for choices from this entity
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
            //->add('profileId', HiddenType::class, $profile)
            ->add('question', TextareaType::class)
            ->add('correct_answer', TextareaType::class)
            ->add('date', HiddenType::class, array(
                'data' => date("d M")
            ))
            ->add('colour', HiddenType::class)
            ->add('icon', HiddenType::class)
            ->add('likes', HiddenType::class, array(
                'data' => 0
            ))
            ->add('dislikes', HiddenType::class, array(
                'data' => 0
            ))
            ->add('submitCreateRiddle', SubmitType::class, ['label' => 'Create'])
        ;
    }
}
?>