<?php

namespace App\Form;

use App\Entity\InistuitionPlan;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InistuitionPlanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plan')
            ->add('accomp')
            ->add('instuitionSuitable')
            ->add('quarter')
            ->add('socialAttribute')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InistuitionPlan::class,
        ]);
    }
}
