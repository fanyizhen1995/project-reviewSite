<?php

namespace AppBundle\Form\Type;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

Class UserCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'username', EmailType::class,
                array('label'   => 'Addresse Mail')
            )
            ->add(
                'password',RepeatedType::class,
                array(
                    'type'  =>  PasswordType::class,
                    'invalid_message'   => 'The password fields must match.',
                    'options'           => array('attr' => array('class' => 'password-field')),
                    'first_options'     => array('label' => 'Password'),
                    'second_options'    => array('label' => 'Repeat'),
                )
            )
        ->add(
            'nom', TextType::class)
        ->add('prenom',TextType::class)
        ->add('pseudo',TextType::class)
        ->add('Resigter',SubmitType::class, array('label'=> 'Create'));
    }
}