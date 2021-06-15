<?php

namespace App\Form;

use App\Entity\KeyPerformanceIndicator;
use App\Entity\Strategy;
use App\Helper\Helper;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KeyPerformanceIndicatorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locales = Helper::locales();
        $data = $options['data'];
        foreach ($locales as $key => $value) {
            $builder
                ->add($value, null, [
                    'mapped' => false, 'label' => $key . " Translation KPI Name", 'required' => $value == "en", 'data' => $data->translate($value)->getName(),
                    'attr' => ['class' => 'form-control']
                ])

                ->add('weight', NumberType::class, [
                    'attr' => ['class' => 'form-control']
                ])

                ->add('kpiNumber', NumberType::class, [
                   
                    'attr' => ['class' => 'form-control'],
                    
                //    'required' => false,

                ])
                 
                ->add('strategy', EntityType::class, [
                    'class' => Strategy::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('s')
                            ->where('s.isActive =1')
                            ->orderBy('s.id', 'ASC');
                    },
                    'attr' => ['class' => 'select2 form-control']
                ])
                ->add($value . "description", CKEditorType::class, [
                    'mapped' => false, 'label' => $key . " Translation description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                    'attr' => ['class' => 'autosize-transition form-control']
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => KeyPerformanceIndicator::class,
        ]);
    }
}
