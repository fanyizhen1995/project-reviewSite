<?php

namespace AppBundle\Form\Type;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CandidatureCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class)
            ->add('introduction', TextareaType::class)
            ->add(
                'poster',FileType::class,
                array(
                    'mapped'    => false,
                )

            )
            ->add(
                'other_photos',FileType::class,
                array(
                    'multiple'  => true,
                    'mapped'    => false,
                    'required'  => false,
                )

            )
            ->add('register', SubmitType::class, array('label' => 'Create'));
    }
}