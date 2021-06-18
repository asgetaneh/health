<?php

namespace App\Form;

use App\Entity\QuarterAccomplishment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuarterAccomplishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('achievementValue')
            ->add('quarter')
            ->add('kpi')
            ->add('objective')
            ->add('goal')
            ->add('initiative')
            ->add('year')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => QuarterAccomplishment::class,
        ]);
    }
}
