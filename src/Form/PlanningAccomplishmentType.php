<?php

namespace App\Form;

use App\Entity\PlanningAccomplishment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningAccomplishmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('accompValue')
            ->add('denominator')
            ->add('accompNoye')
            ->add('plan')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlanningAccomplishment::class,
        ]);
    }
}
