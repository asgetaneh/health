<?php

namespace App\Form;

use App\Entity\OperationalOffice;
use App\Entity\Performer;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerformerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
              ->add('performer',EntityType::class,[
                 'class'=>User::class,
                 'choice_label' => 'userInfo',
                
            
        ])
            ->add('operationalOffice',EntityType::class,[
                'class'=>OperationalOffice::class,
                 'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->andWhere('g.isActive = 1')
                        ->orderBy('g.id', 'ASC');
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Performer::class,
        ]);
    }
}
