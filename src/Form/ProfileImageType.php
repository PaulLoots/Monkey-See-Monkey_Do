<?php

// src/Form/ProfileImageType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Profile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\HttpFoundation\Session\Session;

class ProfileImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('profileId', EntityType::class, array(
            // looks for choices from this entity
            'class' => Profile::class,
            'query_builder' => function (EntityRepository $er) {
                $session = new Session(); 
                $profile = $session->get('profile');
                $profileID = $profile->getId();
                return $er->createQueryBuilder('u')
                    //->from('Profile', 'u')
                    ->where("u.id = $profileID");
                    //->orderBy('u.id', 'ASC');
            },
            'choice_label' => 'id'
        ))
            ->add('image_path', FileType::class)
            ->add('submit', SubmitType::class, ['label' => 'Upload'])
            ->add('active_state', HiddenType::class, array(
                'data' => 1
            ))
            ;
    }

    
}

?>