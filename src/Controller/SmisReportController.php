<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\Initiative;
use App\Entity\OperationalSuitableInitiative;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Form\PlanningYearType;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\PlanningQuarter as EntityPlanningQuarter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SmisReportController extends AbstractController
{
    /**
     * @Route("/smis/report", name="smis_report")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $time = new DateTime('now');
        $quarterId = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time <= $quarter->getEndDate()) {
                $quarterId = $quarter->getId();
            }
        }
        // dd($quarterId);
        $form = $this->createFormBuilder()


            ->add('principalOffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "All",

                'required' => false
            ])
             ->add('planningQuarter', EntityType::class, [
                'class' => PlanningQuarter::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "All",

                'required' => false
            ])
             ->add('planningYear', EntityType::class, [
                'class' => PlanningYear::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "All",

                'required' => false
            ])

            ->getForm();
        $form->handleRequest($request);
        $custom = 0;
        $percent = 0;
        $average = 0;
        $count = 0;
        $principalOffice=0;




        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipalReports($form->getData(), $quarterId);
            foreach ($principalReports->getResult() as $value) {
                $sum = 0;
                $count = $count + 1;
                $accomplish = $value->getAccompValue();
                $plan = $value->getPlanValue();
                $sum = ($accomplish * 100) / $plan;
                $percent = $percent + $sum;

                # code...
            }
            $average = $percent / $count;
            // dd($average);
            $principalOffice=$form->getData()['principalOffice']->getName();
            $custom=1;

            
        } else {
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findBy(['quarter' => $quarterId]);
        }

        $operational_Reports = $em->getRepository(OperationalSuitableInitiative::class)->findBy(['quarter' => $quarterId]);
        // dd($principalReports);
        $data = $paginator->paginate(
            $principalReports,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('smis_report/index.html.twig', [
            'principal_reports' => $data,
            'operational_Reports' => $operational_Reports,
            'form' => $form->createView(),
            'custom'=>$custom,
            'average'=>$average,
            'principalOffice'=>$principalOffice
        ]);
    }
}
