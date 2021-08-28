<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\Initiative;
use App\Entity\OperationalOffice;
use App\Entity\OperationalSuitableInitiative;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Form\PlanningYearType;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
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
                $this->denyAccessUnlessGranted('pre_rep');

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


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $principalOffice = $form->getData()['principalOffice']->getId();
            $quarterId = $form->getData()['planningQuarter']->getId();
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($principalOffice, $quarterId);
            $percent = 0;
            $average = 0;
            $c = 0;
            $sum = 0;
            foreach ($principalReports as $value1) {
                $c = $c + 1;
                $accomplish = $value1->getAccompValue();
                $plan = $value1->getPlanValue();
                $sum = ($accomplish * 100) / $plan;
                $percent = $percent + $sum;
            }
            if ($percent > 0) {
                $average = $percent / $c;
                $accomp[] = $average;
            } else {
                $accomp[] = 0;
            }
            $principalOffice = $form->getData()['principalOffice']->getName();
            $principal[] = $principalOffice;
            // dd($principal,$accomp);

        } else {


            $principalOffices = $em->getRepository(PrincipalOffice::class)->findAll();
            foreach ($principalOffices as $value) {
                $prin = $value->getId();

                $pri = $em->getRepository(PlanningAccomplishment::class)->findPrincipal(
                    $prin,
                    $quarterId
                );
                $percent = 0;
                $average = 0;
                $c = 0;
                $sum = 0;
                foreach ($pri as $value1) {
                    $c = $c + 1;
                    $accomplish = $value1->getAccompValue();
                    $plan = $value1->getPlanValue();
                    $sum = ($accomplish * 100) / $plan;
                    $percent = $percent + $sum;
                }
                if ($percent > 0) {
                    $average = $percent / $c;
                    $accomp[] = $average;
                } else {
                    $accomp[] = 0;
                }
                $principalOffice = $value->getName();
                $principal[] = $principalOffice;
            }
        }

        $operational_Reports = $em->getRepository(OperationalSuitableInitiative::class)->findBy(['quarter' => $quarterId]);
        $operationalOffices = $em->getRepository(OperationalOffice::class)->findAll();

        // dd($operational_Reports);
        $data = $paginator->paginate(
            $principal,
            $request->query->getInt('page', 1),
            10
        );
        $dataac = $paginator->paginate(
            $accomp,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('smis_report/index.html.twig', [
            'principals' => $data,
            'accomp' => $dataac,
            'operational_Reports' => $operational_Reports,
            'form' => $form->createView(),
            
            'operationalOffices'=>$operationalOffices
        ]);
    }
}
