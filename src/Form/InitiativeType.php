<?php

namespace App\Form;

use App\Entity\Initiative;
use App\Entity\InitiativeAttribute;
use App\Entity\InitiativeBehaviour;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\PrincipalOffice;
use App\Entity\CoreTask;
use App\Entity\UnitOfMeasurement;
use App\Helper\Helper;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitiativeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locales = Helper::locales();
        $data = $options['data'];
        foreach ($locales as $key => $value) {
            $builder

                ->add($value, null, [
                    'mapped' => false, 'label' => $key . " Translation initiative Name", 'required' => $value == "en", 'data' => $data->translate($value)->getName(),
                    'attr' => ['class' => 'form-control']
                ])


             
                ->add('minimumValue', null, [
                    'attr' => ['class' => 'form-control']
                ])
                ->add('weight', null, [
                    'attr' => ['class' => 'form-control']
                ])
                
                ->add('maximumValue', null, [
                    'attr' => ['class' => 'form-control']
                ])
//                 ->add('initiativeNumber', NumberType::class, [
//                   
//                    'attr' => ['class' => 'form-control'],
//                    
//                //    'required' => false,
//
//                ])
                
                ->add('weight', null, [
                   
                    'attr' => ['class' => 'form-control'],
                    
                  

                ])
                 
                ->add('category', null, [
                   
                    'attr' => ['class' => 'form-control'],
                    
                  

                ])
//                 ->add('weight', null, [
//                    'attr' => ['class' => 'form-control']
//                ])
//                 ->add('coreTask', EntityType::class, [
//                    'class' => CoreTask::class,
//                   
//                    'attr' => ['class' => 'select2 form-control'],
//                    'placeholder'=>'choose Core Task ',
//                    'required'=>false
                    // 'multiple'=>true,
//                ])
                // ->add('baseline', null, [
                   
                //     'attr' => ['class' => 'form-control'],
                    
                   

                // ])
                ->add($value."description", CKEditorType::class, [
                    'mapped' => false, 'label' => $key . " Translation description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                    'attr' => ['class' => 'autosize-transition form-control'],
                     'required'=>false,
                ])
                ->add('initiativeBehaviour', EntityType::class, [
                    'class' => InitiativeBehaviour::class,
                   
                    'attr' => ['class' => 'select2 form-control'],
                    'placeholder'=>'choose initiative behaviour',
                    // 'multiple'=>true,
                ])
                ->add('keyPerformanceIndicator', EntityType::class, [
                    'class' => KeyPerformanceIndicator::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            ->andWhere('g.isActive = 1')
                            ->orderBy('g.id', 'ASC');
                    },
                    'attr' => ['class' => 'select2 form-control'],
                     'placeholder'=>'choose keyPerformanceIndicator',

                ])
                ->add('principalOffice', EntityType::class, [
                    'class' => PrincipalOffice::class,
                    'query_builder' => function (EntityRepository $pr) {
                        return $pr->createQueryBuilder('p')
                            ->andwhere('p.isActive = 1')
                            ->orderBy('p.id', 'ASC');
                    },
                    'multiple' => true,
                    'attr' => ['class' => 'select2 form-control'],
                     'placeholder'=>'select Principal Office',
                ])
//                ->add('socialAtrribute', EntityType::class, [
//                    'class' => InitiativeAttribute::class,
//                    'attr' => ['class' => 'select2 form-control'],
//                     'multiple'=>true,
//                   'required' => false,
//                    'placeholder'=>'select Social Attribute',
//                   
//
//                ])
                ->add('measurement',ChoiceType::class,[
                    'choices'=>[
                        'Numerical'=>Initiative::NUMERICAL,
//                        'Ratio'=>Initiative::RATIO,
                        'Percent'=>Initiative::PERCENT
                    ],
                     'attr' => ['class' => 'select2 form-control'],
                     'required' => false,
                      'placeholder'=>'choose measurement',

                ])
                  ->add('unitOfMeasurement', EntityType::class, [
                    'class' => UnitOfMeasurement::class,
                    'attr' => ['class' => 'select2 form-control'],
                   'required' => false,
                    'placeholder'=>'select Unit of Measurement',
                   

                ])
                ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Initiative::class,
        ]);
    }
}
