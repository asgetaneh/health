<?php

namespace App\Form;

use App\Entity\SmisSetting;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SmisSettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sendToPrincipal')
            ->add('sendToPlan')
            ->add('maxPenalityDays')
            ->add('maxAllowedTasks')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SmisSetting::class,
        ]);
    }
}
