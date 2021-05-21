<?php

namespace App\Form;

use App\Entity\TaskAssign;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskAssignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('status')
            ->add('assignedAt')
            ->add('operationalTask')
            ->add('PerformerTask')
            ->add('assignedBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TaskAssign::class,
        ]);
    }
}
