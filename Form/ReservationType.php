<?php

namespace Ovesco\APMBSBundle\Form;

use Ovesco\APMBSBundle\Entity\Cabane;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cabane', EntityType::class, [
                'class' => Cabane::class,
            ])
            ->add('start', DateTimeType::class)
            ->add('end', DateTimeType::class)
            ->add('prenon', TextType::class)
            ->add('nom', TextType::class)
            ->add('email', EmailType::class)
            ->add('phone', TextType::class)
            ->add('unite', TextType::class)
            ->add('description', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ReservationType::class
        ]);
    }
}