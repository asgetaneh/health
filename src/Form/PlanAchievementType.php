<?php

namespace App\Form;

use App\Entity\PlanAchievement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanAchievementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accomplishmentValue')
            ->add('year')
            ->add('goal')
            ->add('Objective')
            ->add('kpi')
            ->add('initiative')
            ->add('strategy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlanAchievement::class,
        ]);
    }
}
