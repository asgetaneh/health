<?php

namespace App\Form;

use App\Entity\Goal;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Helper\Helper;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class GoalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)

    {
        $locales = Helper::locales();
        $data = $options['data'];
        foreach ($locales as $key => $value) {
            $builder
                ->add($value, null, ['mapped' => false, 'label' => $key . " Translation Goal Name", 'required' => $value == "en", 'data' => $data->translate($value)->getName(),
                'attr' => ['class' => 'form-control']])
                ->add($value."outPut", TextareaType::class, ['mapped' => false, 'label' => $key . " Translation outPut", 'required' => $value == "en", 'data' => $data->translate($value)->getOutPut(),
                'attr' => ['class' => 'autosize-transition form-control']])
                ->add($value."outCome", TextareaType::class, ['mapped' => false, 'label' => $key . " Translation outCome", 'required' => $value == "en", 'data' => $data->translate($value)->getOutCome(),
                'attr' => ['class' => 'autosize-transition form-control'],
                ])
                ->add($value."description", TextareaType::class, ['mapped' => false, 'label' => $key . "Translation Description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                'attr' => ['class' => 'autosize-transition form-control']]);
        }
        
       
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Goal::class,
        ]);
    }
}
