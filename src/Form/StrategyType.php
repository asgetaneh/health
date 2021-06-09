<?php

namespace App\Form;

use App\Entity\Objective;
use App\Entity\Strategy;
use App\Helper\Helper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class StrategyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $locales = Helper::locales();
        $data = $options['data'];
        foreach ($locales as $key => $value) {
            $builder
               
                ->add($value, null, [
                    'mapped' => false, 'label' => $key . " Translation Strategy Name", 'required' => $value == "en", 'data' => $data->translate($value)->getName(),
                    'attr' => ['class' => 'form-control'],
                    'required'=>true,
                ])
                
                ->add($value . "description", TextareaType::class, [
                    'mapped' => false, 'label' => $key . " Translation description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                    'attr' => ['class' => 'autosize-transition form-control'],
                    
                ])
                 ->add('objective', EntityType::class, [
                    'class' => Objective::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            ->where('g.isActive = 1')
                            ->orderBy('g.id', 'ASC');
                    },
                    'attr' => ['class' => 'select2 form-control']
                ])
               ;
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Strategy::class,
        ]);
    }
}
