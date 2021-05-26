<?php

namespace App\Form;

use App\Entity\OperationalTask;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationalTaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('taskName')
            ->add('description')
                       ->add('weight')
                         ->add('quarter')
                // ->add('startDate')
                // ->add('endDate',NULL, array('attr'=>array('class'=>'popupDatepicker1 form-control'), 'required' => TRUE))
                //   ->add('timeGap')


        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OperationalTask::class,
        ]);
    }
}
