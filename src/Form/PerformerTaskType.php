<?php

namespace App\Form;

use App\Entity\PerformerTask;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerformerTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('weight')
            ->add('startDate')
            ->add('endDate')
            ->add('timeGap')
            ->add('operationalTask')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PerformerTask::class,
        ]);
    }
}
