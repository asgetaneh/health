<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\College;
use App\Entity\Department;
use App\Entity\Disablity;
use App\Entity\EnrollmentType;
use App\Entity\Nationality;
use App\Entity\Program;
use App\Entity\ProgramLevel;
use App\Entity\ProgramType;
use App\Entity\Region;
use App\Entity\Sposnsorship;
use App\Entity\StudentStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(Request $request): Response
    {
        $form=$this->createFormBuilder()
        ->add('campus',EntityType::class,[
            'class'=>Campus::class,
            'multiple'=>true,
        ])
         ->add('college',EntityType::class,[
            'class'=>College::class,
            'multiple'=>true,
        ])
         ->add('programLevel',EntityType::class,[
            'class'=>ProgramLevel::class,
            'multiple'=>true,
        ])
         ->add('programType',EntityType::class,[
            'class'=>ProgramType::class,
            'multiple'=>true,
        ])
         ->add('enrollmentType',EntityType::class,[
            'class'=>EnrollmentType::class,
            'multiple'=>true,
        ])
         ->add('department',EntityType::class,[
            'class'=>Department::class,
            'multiple'=>true,
        ])
         ->add('program',EntityType::class,[
            'class'=>Program::class,
            'multiple'=>true,
        ])
         ->add('region',EntityType::class,[
            'class'=>Region::class,
            'multiple'=>true,
        ])
         ->add('disablity',EntityType::class,[
            'class'=>Disablity::class,
            'multiple'=>true,
        ])
         ->add('semister',ChoiceType::class,[
            'choices'=>[
                'All'=>null,
                '1'=>1,
                '2'=>2,
                '3'=>3,
                '4'=>4,
                '5'=>5,
                '6'=>6,
                '7'=>7,
                '8'=>8,

                
            ],
            'multiple'=>true,
        ])
        ->add('year',ChoiceType::class,[
            'choices'=>[
                'All'=>null,
                '1'=>1,
                '2'=>2,
                '3'=>3,
                '4'=>4,
                '5'=>5,
                '6'=>6,
                '7'=>7
               

                
            ],
            'multiple'=>true,
        ])
         ->add('sex',ChoiceType::class,[
            'choices'=>[
                'All'=>null,
                'Male'=>'M',
                'Female'=>'F',
            ],
            'multiple'=>true,
        ])
        ->add('sposnsorship',EntityType::class,[
            'class'=>Sposnsorship::class,
            'multiple'=>true,
        ])
        ->add('studentStatus',EntityType::class,[
            'class'=>StudentStatus::class,
            'multiple'=>true,
        ])
          ->add('nationality',EntityType::class,[
            'class'=>Nationality::class,
            'multiple'=>true,
        ])
        ->getForm();
        $form->handleRequest($request);

        return $this->render('student/index.html.twig', [
            'controller_name' => 'StudentController',
            'form'=>$form->createView()
        ]);
    }
}
