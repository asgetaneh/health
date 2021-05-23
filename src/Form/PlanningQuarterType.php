<?php

namespace App\Form;

use App\Entity\PlanningQuarter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningQuarterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug',ChoiceType::class,[
                'choices'=>[  
                  'First Quarter'=>1,
                  'Second Quarter'=>2,
                  'Third Quarter'=>3,
                  'Fourth Quarter'=>4,
                  'Yearly'=>5]
            ])
            ->add('description')
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlanningQuarter::class,
        ]);
    }
}
