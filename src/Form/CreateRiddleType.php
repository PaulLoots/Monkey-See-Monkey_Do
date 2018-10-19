<?php

namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\HttpFoundation\Session\Session;

class CreateRiddleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $session = new Session();
        $profile = $session->get('profile');
        $builder
            //->add('profile_id', HiddenType::class)
            ->add('profileId', EntityType::class, array(
                // looks for choices from this entity
                'class' => Profile::class,
                'choice_label' => 'id'
            ))
            //->add('profileId', HiddenType::class, $profile)
            ->add('question', TextareaType::class)
            ->add('correct_answer', TextareaType::class)
            ->add('date', DateTimeType::class)
            ->add('colour', HiddenType::class)
            //->add('icon', HiddenType::class)
            ->add('submitCreateRiddle', SubmitType::class, ['label' => 'Create'])
        ;
    }
}
?>