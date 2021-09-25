<?php

namespace App\Form;

use App\Entity\Delegation;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DelegationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
       
        
        $builder
            ->add('startAt', DateType::class, [

                'widget' => 'single_text',
                // 'input_format'=>'Y-m-d'
            ])
            ->add('endAt', DateType::class, [

                'widget' => 'single_text',
                // 'input_format'=>'Y-m-d'
            ])
            ->add('reason', CKEditorType::class)
            ->add('delegatedUser', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) use ($options) {
                    return $er->createQueryBuilder('u')
                    ->andWhere('u.id not in (:userid)')
                    ->setParameter('userid',$options['user'])
                        ->orderBy('u.username', 'ASC');
                },
                'choice_label' => 'userInfo',
                'placeholder' => 'Choose an option',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Delegation::class,
            'user' => 'int',
        ]);
        $resolver->setAllowedTypes('user','int');
    }
}
