<?php
// src/Form/UserProfileType.php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('image_path', FileType::class)
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('password', PasswordType::class)
            ->add('submitSignUp', SubmitType::class, ['label' => 'Create'])
            ->add('riddling_score', HiddenType::class, array(
                'data' => 0
            ))
            ->add('banned', HiddenType::class, array(
                'data' => 0
            ))
            ->add('admin', HiddenType::class, array(
                'data' => 0
            ))
        ;
    }
}
?>