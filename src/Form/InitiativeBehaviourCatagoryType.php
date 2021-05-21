<?php

namespace App\Form;

use App\Entity\InitiativeBehaviourCatagory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitiativeBehaviourCatagoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('code')
            ->add('cretedAt')
            ->add('createdBy')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InitiativeBehaviourCatagory::class,
        ]);
    }
}
