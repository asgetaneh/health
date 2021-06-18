<?php

namespace App\Form;

use App\Entity\OperationalManager;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationalManagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          
            ->add('manager',EntityType::class,[
                 'class'=>User::class,
                 'choice_label' => 'userInfo',
                
            
        ])
            ->add('operationalOffice')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OperationalManager::class,
        ]);
    }
}
