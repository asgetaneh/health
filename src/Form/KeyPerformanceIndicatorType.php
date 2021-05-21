<?php

namespace App\Form;

use App\Entity\KeyPerformanceIndicator;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KeyPerformanceIndicatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('isActive')
            ->add('weight')
            ->add('createdAt')
            ->add('strategy')
            ->add('createdBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => KeyPerformanceIndicator::class,
        ]);
    }
}
