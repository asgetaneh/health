<?php

namespace App\Form;

use App\Entity\KeyPerformanceIndicatorBudget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KeyPerformanceIndicatorBudgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('adjusted_budget_amount')
            ->add('key_performance_indicator')
            ->add('plan_year')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => KeyPerformanceIndicatorBudget::class,
        ]);
    }
}
