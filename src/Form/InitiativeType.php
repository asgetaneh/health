<?php

namespace App\Form;

use App\Entity\Initiative;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitiativeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('maximumValue')
            ->add('minimumValue')
            ->add('createdAt')
            ->add('initiativeBehaviour')
            ->add('keyPerformanceIndicator')
            ->add('createdBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Initiative::class,
        ]);
    }
}
