<?php

namespace App\Form;

use App\Entity\TaskAccomplishment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskAccomplishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('expectedValue')
            ->add('accomplishmentValue')
            ->add('note')
            ->add('taskAssign')
            ->add('measurement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TaskAccomplishment::class,
        ]);
    }
}
