<?php

namespace App\Form;

use App\Entity\InitiativeBehaviour;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitiativeBehaviourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
          
            ->add('code',ChoiceType::class,[
                'choice'=>[
                    'CONSTANT'=>0,
                    'ADDITIVE'=>1,
                    'INCREMENTAL'=>2,
                    'DECREMENTAL'=>3,
                    'RATIO'=>4
                     
                ]
            ])
            ->add('description')
         
            
           
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InitiativeBehaviour::class,
        ]);
    }
}
