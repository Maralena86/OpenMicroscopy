<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('username', TextType::class, [
            'label' => false,
            'attr'=>array(
                'placeholder' => 'Pseudo',
                'autofocus' => true, 
            ), 
                         
            'required' => true
        ])
        
        ->add('email', EmailType::class, [
            'label' => false,
            'attr' => array(
                'placeholder' => 'Email'
            ),               
            'required' => true
        ])           
        ->add('password', RepeatedType::class, [
            'type' => PasswordType::class,
            'required' => true,
            'constraints' =>[
                new Regex('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[#?!@$%^&*-]).{8,}$/', "The password must be at least 8 characters and contain at least 1 uppercase letter, 1 lowercase letter and 1 special character (!*#)")                    
                ],
            'first_options' => [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Your password'
                ),
            ],
            'second_options' => [
                'label' => false,
                'attr' => array(
                    'placeholder' => 'Repeat your password'
                )
            ]
        ])
        ->add('send', SubmitType::class, [
            'label' => "S'inscrire",
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
