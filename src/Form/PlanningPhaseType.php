<?php

namespace App\Form;

use App\Entity\PlanningPhase;
use App\Entity\PlanningYear;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningPhaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('quarter')
            ->add('startAt',DateTimeType::class,[
                'widget'=>'single_text',
                'required'=>false
            ])
            ->add('endAt',DateTimeType::class,[
                'widget'=>'single_text',
                'required'=>false
            ])
            ->add('message')
            ->add('guide')
            ->add('otherinfo')
            ->add('description')
        
            ->add('planningYear',EntityType::class,[
                'class'=>PlanningYear::class,
                'query_builder'=>function(EntityRepository $er){
                    return $er->createQueryBuilder('p')
                    ->andWhere('p.isActive = 1');
                },
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PlanningPhase::class,
        ]);
    }
}
