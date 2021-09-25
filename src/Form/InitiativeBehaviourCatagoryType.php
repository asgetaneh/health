<?php

namespace App\Form;

use App\Entity\InitiativeBehaviourCatagory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitiativeBehaviourCatagoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('code',ChoiceType::class,[
                'choices' => [
                    'Numerical' => 1,
                    'Ration' => 2,
                    'Social Behavior' => 3,
                    ],
            ]
    
            )
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InitiativeBehaviourCatagory::class,
        ]);
    }
}
