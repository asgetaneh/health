<?php

namespace App\Form;

use App\Entity\Perspective;
use App\Helper\Helper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerspectiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locales = Helper::locales();
        $data = $options['data'];
        foreach ($locales as $key => $value) {
            $builder
               
                ->add($value, null, [
                    'mapped' => false, 'label' => $key . " Translation Perspective Name", 'required' => $value == "en", 'data' => $data->translate($value)->getName(),
                    'attr' => ['class' => 'form-control']
                ])
                
                ->add($value ."description", TextareaType::class, [
                    'mapped' => false, 'label' => $key . " Translation description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                    'attr' => ['class' => 'autosize-transition form-control']
                ])
                
               ;
        }
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Perspective::class,
        ]);
    }
}
