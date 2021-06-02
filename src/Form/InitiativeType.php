<?php

namespace App\Form;

use App\Entity\Initiative;
use App\Entity\InitiativeAttribute;
use App\Entity\InitiativeBehaviour;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\PrincipalOffice;
use App\Helper\Helper;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
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
                ->add('maximumValue', null, [
                    'attr' => ['class' => 'form-control']
                ])
                ->add($value . "description", TextareaType::class, [
                    'mapped' => false, 'label' => $key . " Translation description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                    'attr' => ['class' => 'autosize-transition form-control']
                ])
                ->add('initiativeBehaviour', EntityType::class, [
                    'class' => InitiativeBehaviour::class,
                    'attr' => ['class' => 'select2 form-control'],
                    'multiple'=>true,
                ])
                ->add('keyPerformanceIndicator', EntityType::class, [
                    'class' => KeyPerformanceIndicator::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            ->andWhere('g.isActive = 1')
                            ->orderBy('g.id', 'ASC');
                    },
                    'attr' => ['class' => 'select2 form-control']

                ])
                ->add('principalOffice', EntityType::class, [
                    'class' => PrincipalOffice::class,
                    'query_builder' => function (EntityRepository $pr) {
                        return $pr->createQueryBuilder('p')
                            ->andwhere('p.isActive = 1')
                            ->orderBy('p.id', 'ASC');
                    },
                    'multiple' => true,
                    'attr' => ['class' => 'select2 form-control']
                ])
                ->add('socialAtrribute', EntityType::class, [
                    'class' => InitiativeAttribute::class,
                    'attr' => ['class' => 'select2 form-control'],
                    'multiple'=>true,
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Initiative::class,
        ]);
    }
}
