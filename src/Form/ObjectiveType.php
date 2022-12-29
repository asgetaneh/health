<?php

namespace App\Form;

use App\Entity\Goal;
use App\Entity\Objective;
use App\Entity\Perspective;
use App\Helper\Helper;
use Doctrine\ORM\EntityRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjectiveType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $locales = Helper::locales();
        $data = $options['data'];
        foreach ($locales as $key => $value) {

            $builder

                ->add($value, null, [
                    'mapped' => false, 'label' => $key . " Translation Objective Name", 'required' => $value == "en", 'data' => $data->translate($value)->getName(),
                    'attr' => ['class' => 'form-control']
                ])
                ->add($value . "outPut", CKEditorType::class, [
                    'mapped' => false, 'label' => $key . " Translation outPut", 'required' => $value == "en", 'data' => $data->translate($value)->getOutPut(),
                    'attr' => ['class' => 'autosize-transition form-control']
                ])
                ->add($value . "outCome", CKEditorType::class, [
                    'mapped' => false, 'label' => $key . " Translation oucome", 'required' => $value == "en", 'data' => $data->translate($value)->getOutCome(),
                    'attr' => ['class' => 'autosize-transition form-control']
                ])
                ->add($value . "description", CKEditorType::class, [
                    'mapped' => false, 'label' => $key . " Translation description", 'required' => $value == "en", 'data' => $data->translate($value)->getDescription(),
                    'attr' => ['class' => 'autosize-transition form-control']
                ])
//                ->add('objectiveNumber', NumberType::class, [
//                   
//                    'attr' => ['class' => 'form-control'],
//                    
//                //    'required' => false,
//
//                ])


                ->add('weight',NumberType::class,[
                    'attr' => ['class' => ' form-control']
                ]
                )
                ->add('perspective',EntityType::class,[
                    'class'=>Perspective::class,
                    'attr' => ['class' => 'select2 form-control']
                ])
                ->add('goal', EntityType::class, [
                    'class' => Goal::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('g')
                            ->andWhere('g.isActive = 1')
                            ->orderBy('g.id', 'ASC');
                    },
                      'attr' => ['class' => 'select2 form-control']
                    
                ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Objective::class,
        ]);
    }
}
