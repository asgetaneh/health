<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
 


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
//            ->add('roles')
//              ->  add('plainPassword', PasswordType::class, [
//                        'type' => PasswordType::class,
//                        'first_options'  => ['label' => 'Password', 'hash_property_path' => 'password'],
//                         'second_options' => ['label' => 'Repeat Password'],
//                          'mapped' => false,
//])
       ->add('Password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
//            ->add('locale')
//            ->add('status')
            ->add('mobile')
            ->add('alternativeEmail')
//            ->add('lastLogin')
            ->add('userGroup')
//            ->add('userInfo')
            ->add('staffType')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
