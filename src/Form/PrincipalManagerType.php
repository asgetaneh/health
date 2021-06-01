<?php

namespace App\Form;

use App\Entity\PrincipalManager;
use App\Entity\PrincipalOffice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class PrincipalManagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
        ->add('principal')
        ->add('principalOffice',EntityType::class,[
             'class' => PrincipalOffice::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                        ->where('g.isActive =1')
                        ->orderBy('g.id', 'ASC');
                },
        ])
       
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PrincipalManager::class,
        ]);
    }
}
