<?php

namespace App\Form;

use App\Entity\Initiative;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\PrincipalOffice;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitiativeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('maximumValue')
            ->add('minimumValue')
            ->add('initiativeBehaviour')
            ->add('keyPerformanceIndicator',EntityType::class,[
                 'class' => KeyPerformanceIndicator::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->andWhere('g.isActive = 1')
                        ->orderBy('g.id', 'ASC');
                },
                
            ])
            ->add('principalOffice',EntityType::class,[
                 'class' => PrincipalOffice::class,
                'query_builder' => function (EntityRepository $pr) {
                    return $pr->createQueryBuilder('p')
                        ->andwhere('p.isActive = 1')
                        ->orderBy('p.id', 'ASC');
                },
                'multiple'=>true,
            ])
            ->add('socialAtrribute')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Initiative::class,
        ]);
    }
}
