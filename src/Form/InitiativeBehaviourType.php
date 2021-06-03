<?php

namespace App\Form;

use App\Entity\InitiativeBehaviour;
use App\Helper\Helper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InitiativeBehaviourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locales = Helper::locales();
        $data = $options['data'];
        foreach ($locales as $key => $value) {
            $builder
               
                ->add($value, null, [
                    'mapped' => false, 'label' => $key . " Translation  initiative behavior Name", 'required' => $value == "en", 'data' => $data->translate($value)->getName(),
                    'attr' => ['class' => 'form-control']
                ])
                
                ->add($value . "description", TextareaType::class, [
                    'mapped' => false, 'label' => $key . " Translation description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                    'attr' => ['class' => 'autosize-transition form-control']
                ])
                ->add('code',ChoiceType::class,[
                'choices'=>[
                    'CONSTANT'=>0,
                    'ADDITIVE'=>1,
                    'INCREMENTAL'=>2,
                    'DECREMENTAL'=>3,
                    'RATIO'=>4

                     
                ],
                 'attr' => ['class'=>'select2 '],
               
                
               
            ]) ;
        }
            
       
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InitiativeBehaviour::class,
        ]);
    }
}
