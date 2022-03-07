<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\Initiative;
use App\Entity\OperationalOffice;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\OperationalSuitableInitiative;
use App\Entity\PerformerTask;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\PrincipalManager;
use App\Entity\PrincipalOffice;
use App\Entity\SuitableInitiative;
use App\Entity\SuitableOperational;
use App\Entity\TaskAccomplishment;
use App\Entity\TaskAssign;
use App\Form\PlanningYearType;
use App\Helper\DomPrint;
use App\Helper\AmharicHelper;
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
     * @Route("/smis_report", name="smis_report")
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

            'operationalOffices' => $operationalOffices
        ]);
    }
    /**
     * @Route("/score_report", name="score_report")
     */
    public function score(Request $request, DomPrint $domPrint, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('pre_rep');
        $em = $this->getDoctrine()->getManager();
        $time = new DateTime('now');
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);

        $quarterId = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time <= $quarter->getEndDate()) {
                $quarterId = $quarter->getId();
            }
        }
        // dd($quarterId);
        $value = 1;
        $principalValue = 1;


        $form = $this->createFormBuilder()
            ->add('principalOffice', EntityType::class, [
                'class' => PrincipalOffice::class,
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

        if ($request->request->get("print")) {
            // dd(1);
            $data = $form->getData();
            $principalOffice = $form->getData()['principalOffice']->getId();
            $principalOffices = $em->getRepository(PrincipalOffice::class)->find($principalOffice);
            $princpalManager = $em->getRepository(PrincipalManager::class)->findOneBy(['principalOffice' => $principalOffice]);
            $principalOfficeName = $principalOffices->getName();
            $chifPrincipal = $principalOffices->getManagedBy()->getName();
            $princpalManager = $princpalManager->getPrincipal()->getUserInfo()->getFullName();
            $planningYear = $form->getData()['planningYear']->getId();
            $totalInitiative = $em->getRepository(Initiative::class)->findOfficeInitiative($principalOffices);
            // dd($totalInitiative);
            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(),$principalValue,$principalValue);

            // dd($suitableInitiatives);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(),$principalValue,$currentQuarter,$principalValue);
            $planningYear = $em->getRepository(PlanningYear::class)->find($planningYear);
            $ethYear = $planningYear->getEthYear();

            $domPrint->print('smis_report/score_print.html.twig', [
                'principalReports' => $principalReports,
                'date' => (new \DateTime())->format('y-m-d'),
                'chifPrincipal' => $chifPrincipal,
                'suitableInitiatives' => $suitableInitiatives,
                'principalOfficeName' => $principalOfficeName,
                'totalInitiative' => $totalInitiative,
                'ethYear' => $ethYear,
                'fullName' => $princpalManager,
            ], 'performance score card for ' . $principalOfficeName, 'landscape');

            // return $this->redirectToRoute('score_report');
        }
        if ($form->isSubmitted()) {
            $value = 1;
            $data = $form->getData();
            $principalOffice = $form->getData()['principalOffice']->getId();
            $planningYear = $form->getData()['planningYear']->getId();
            $totalInitiative = $em->getRepository(Initiative::class)->findOfficeInitiative($principalOffice);


            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(),$principalValue,$principalValue);
            // dd($suitableInitiatives);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(),$principalValue,$currentQuarter,$principalValue);
        } else {

            $value = 0;
            $principalReports[] = "";
            $suitableInitiatives[] = "";
            $totalInitiative = "";
            // $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal();
        }
        // dd($suitableInitiatives);
        $data = $paginator->paginate(
            $principalReports,
            $request->query->getInt('page', 1),
            10
        );
        // dd($data);

        return $this->render('smis_report/score.html.twig', [
            'principalReports' => $data,
            'totalInitiative' => $totalInitiative,
            'form' => $form->createView(),
            'suitableInitiatives' => $suitableInitiatives,
            'value' => $value

        ]);
    }
    /**
     * @Route("/score_progress", name="score_progress")
     */
    public function progress(Request $request, DomPrint $domPrint, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('pre_rep');
        $em = $this->getDoctrine()->getManager();
        $time = new DateTime('now');
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);
        $quarterId = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time <= $quarter->getEndDate()) {
                $quarterId = $quarter->getId();
            }
        }
        // dd($quarterId);
        $value = 1;

        $form = $this->createFormBuilder()
            ->add('principalOffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "Principal Office",

                'required' => false
            ])



            ->getForm();
        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            $prinOfId = $form->getData()['principalOffice']->getId();
            $principalOffices = $em->getRepository(PrincipalOffice::class)->findBy(['id' => $prinOfId]);
        } else {

            $value = 0;
            $principalReports[] = "";
            $currentYear = AmharicHelper::getCurrentYear();
            // dd($startYear);
            $suitableInitiatives[] = "";
            $totalInitiative = "";
            $principalOffices = $em->getRepository(PrincipalOffice::class)->findAll();
        }
        $data = $paginator->paginate(
            $principalOffices,
            $request->query->getInt('page', 1),
            10
        );
        // dd($data);

        return $this->render('smis_report/progress.html.twig', [

            'form' => $form->createView(),
            'currentYear' => AmharicHelper::getCurrentYear(),
            'principalOffices' => $data,

        ]);
    }
    /**
     * @Route("/plan_remove", name="plan_remove")
     */
    public function plan_remove(Request $request, DomPrint $domPrint, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('pre_rep');
        $em = $this->getDoctrine()->getManager();
        $time = new DateTime('now');
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);
        $quarterId = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time <= $quarter->getEndDate()) {
                $quarterId = $quarter->getId();
            }
        }
        // dd($quarterId);
        $value = 1;

        $form = $this->createFormBuilder()
            ->add('principalOffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "Principal Office",

                'required' => false
            ])
             ->add('quarter', EntityType::class, [
                'class' => PlanningQuarter::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "Quarter ",

                'required' => false
            ])



            ->getForm();
        $form->handleRequest($request);
        if ($request->request->get("remove")) {
           $quarter=$request->request->get('form')['quarter'];

            $prinOfId = $form->getData()['principalOffice']->getId();
            $principalOffices = $em->getRepository(PrincipalOffice::class)->findBy(['id' => $prinOfId]);

            $evaluations = $em->getRepository(Evaluation::class)->findByPrincipal($prinOfId,$quarter);
            $operationalSuitableInitiatives = $em->getRepository(OperationalSuitableInitiative::class)->findByPrincipal($prinOfId,$quarter);
            $taskAccomplishments = $em->getRepository(TaskAccomplishment::class)->findByPrincipal($prinOfId,$quarter);
            $taskAssigns = $em->getRepository(TaskAssign::class)->findByPrincipal($prinOfId,$quarter);
            $performerTasks = $em->getRepository(PerformerTask::class)->findByPrincipal($prinOfId,$quarter);
            // $operationalPlanningAccomplishments = $em->getRepository(OperationalPlanningAccomplishment::class)->findByPrincipal($prinOfId);
            $suitableOperationals = $em->getRepository(SuitableOperational::class)->findByPrincipal($prinOfId);
            // $planningAccomplishments = $em->getRepository(PlanningAccomplishment::class)->findByPrincipalRemove($prinOfId);

            foreach ($evaluations as  $value) {
                $em->remove($value);
                $em->flush();
            }
            foreach ($operationalSuitableInitiatives as  $value) {
                $em->remove($value);
                $em->flush();
            }
            foreach ($operationalSuitableInitiatives as  $value) {
                $em->remove($value);
                $em->flush();
            }
            foreach ($taskAccomplishments as  $value) {
                $em->remove($value);
                $em->flush();
            }
            foreach ($taskAssigns as  $value) {
                $em->remove($value);
                $em->flush();
            }
            foreach ($performerTasks as  $value) {
                $em->remove($value);
                $em->flush();
            }
            // foreach ($operationalPlanningAccomplishments as  $value) {
            //     $em->remove($value);
            //     $em->flush();
            // }
            foreach ($suitableOperationals as  $value) {
                $value->setStatus(1);
                $em->flush();
            }
            // foreach ($planningAccomplishments as  $value) {
            //     $em->remove($value);
            //     $em->flush();
            // }
            $this->addFlash('success', 'Plan Remove Successfuly');
        }

        if ($form->isSubmitted()) {
            $prinOfId = $form->getData()['principalOffice']->getId();
            $principalOffices = $em->getRepository(PrincipalOffice::class)->findBy(['id' => $prinOfId]);

            // return $this->redirectToRoute('plan_remove');

            // dd($evaluation, $operationalSuitableInitiative,$taskAccomplishment,$taskAssign,$performerTask);
        } else {

            $value = 0;
            $principalReports[] = "";
            $currentYear = AmharicHelper::getCurrentYear();
            // dd($startYear);
            $suitableInitiatives[] = "";
            $totalInitiative = "";
            $principalOffices = $em->getRepository(PrincipalOffice::class)->findAll();
        }
        $data = $paginator->paginate(
            $principalOffices,
            $request->query->getInt('page', 1),
            10
        );
        // dd($data);

        return $this->render('smis_report/plan_remove.html.twig', [

            'form' => $form->createView(),
            'currentYear' => AmharicHelper::getCurrentYear(),
            'principalOffices' => $data,

        ]);
    }
}
