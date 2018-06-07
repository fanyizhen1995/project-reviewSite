<?php

namespace AppBundle\Form\Type;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class VoteCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class)
            ->add('description', TextareaType::class)
            ->add('introduction',
                EntityType::class,array(
                    'class'         => 'AppBundle:Candidature',
                    'choice_label'  => 'introduction',
                    'label'         => 'Film',
                    'mapped'        => false,
                    'expanded'      => true,
                    'multiple'      => true,

                ))
            ->add('register', SubmitType::class, array('label' => 'Create'));
    }
}