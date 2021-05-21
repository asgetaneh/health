<?php

namespace App\Form;

use App\Entity\Objective;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('outPut')
            ->add('outCome')
            ->add('weight')
            ->add('isActive')
            ->add('createdAt')
            ->add('CreatedBy')
            ->add('perspective')
            ->add('goal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objective::class,
        ]);
    }
}
