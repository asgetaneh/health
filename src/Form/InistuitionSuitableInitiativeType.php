<?php

namespace App\Form;

use App\Entity\InistuitionSuitableInitiative;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InistuitionSuitableInitiativeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('initiative')
            ->add('year')
            ->add('inistuition')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InistuitionSuitableInitiative::class,
        ]);
    }
}
