<?php

namespace App\Controller;

use App\Entity\Delegation;
use App\Entity\Goal;
use App\Entity\Initiative;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\Objective;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\PrincipalManager;
use App\Entity\PrincipalOffice;
use App\Entity\QuarterAccomplishment;
use App\Entity\QuarterPlanAchievement;
use App\Entity\SmisSetting;
use App\Entity\SuitableInitiative;
use App\Helper\AmharicHelper;
use App\Helper\DomPrint;
use App\Repository\OperationalSuitableInitiativeRepository;
use App\Repository\SuitableInitiativeRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\PlanningYearRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Proxies\__CG__\App\Entity\Objective as EntityObjective;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController
{
    /**
     * @Route("/principal_office_report", name="principal_office_report", methods={"GET","POST"})
     */
    public function report(SuitableInitiativeRepository $suitableInitiativeRepository, PlanningYearRepository $planinngYearRepository, Request $request, PaginatorInterface $paginator): Response
    {

        // $this->denyAccessUnlessGranted('pre_rep_pro');

        $em = $this->getDoctrine()->getManager();
        $planinngYear = $planinngYearRepository->findLast();
       // $principalOfficeName = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getName();

        // $principalOffice = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getId();
        $filterForm = $this->createFormBuilder()
            ->add("planyear", EntityType::class, [
                'class' => PlanningYear::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,
            ])
            ->add("initiative", EntityType::class, [
                'class' => Initiative::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,
            ])
            ->add('principaloffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                // 'multiple' => true,
                'required' => false,

                'placeholder' => 'Choose an principal office',
            ])
            ->getForm();
        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $suitableInitiatives = $suitableInitiativeRepository->findBy(['principalOffice' => $filterForm->getData()['principaloffice']->getId()]);
            $data = $paginator->paginate(
                $suitableInitiatives,
                $request->query->getInt('page', 1),
                12
            );
        } else {
            $principal = $em->getRepository(PrincipalManager::class)->findOneBy(['principal' => $this->getUser()]);
            if($principal){
                $principalOffice =  $principal->getPrincipalOffice();
                 $suitableInitiatives = $suitableInitiativeRepository->findByPrincipalAndOffice($principalOffice, $planinngYear);
            }else {
                 $suitableInitiatives = $suitableInitiativeRepository->findByYearForToBeReport($planinngYear);
            }
            //$suitableInitiatives = $suitableInitiativeRepository->findBy(["principalOffice" => $principalOffice]);
           
            $data = $paginator->paginate(
                $suitableInitiatives,
                $request->query->getInt('page', 1),
                100
            );
        }

        return $this->render('principal/report.html.twig', [
            'suitable_initiatives' => $data,
            'suitableTotal' => $suitableInitiatives,
            'filterform' => $filterForm->createView(),
            'currentQuarter' => AmharicHelper::getCurrentQuarter($em)

        ]);
    }
    /**
     * @Route("/intiative_accomplishment/{id}", name="initiative_accomplishment_list")
     */
    public function acomplishmentList(Request $request, SuitableInitiative $suitableInitiative,  OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $socialcount = 0;
        $socialAttr = 0;
        $principalOffice = $suitableInitiative->getPrincipalOffice()->getId();
        $maxTasks = $em->getRepository(SmisSetting::class)->findAll()[0];
        $sendToPlan = $maxTasks->getSendToPlan();
        $socials = $suitableInitiative->getInitiative()->getSocialAtrribute();
        $initiativeName = $suitableInitiative->getInitiative()->getName();
        $time = new DateTime('now');
        $endDate = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time < $quarter->getEndDate()) {
                $endDate = $quarter->getEndDate();
            }
        }
        $diff = $endDate->diff($time);
        if ($diff->m == 0) {
            $remainingdays = $diff->d;
        } else {
            $remainingdays = $diff->m * 30 + $diff->d;
        }
        if ($socials) {

            foreach ($socials as $so) {
                if ($so->getCode() == 1) {
                    $socialAttr = 1;
                    $male = $so->getId();
                }
                if ($so->getCode() == 2) {
                    $female = $so->getId();
                }
            }
        }
        // if ($socialAttr == 1) {
        //     // dd($suitableInitiative->getId());
        //     $operatioanlSuitables = $operationalSuitableInitiativeRepository->findplanSocial($principalOffice, $suitableInitiative->getId(), $male);
        //     $operatioanlSuitablessocails = $operationalSuitableInitiativeRepository->findplanSocial($principalOffice, $suitableInitiative->getId(), $female);
        //     $planningAcc = $em->getRepository(PlanningAccomplishment::class)->findBy(['suitableInitiative' => $suitableInitiative->getId()]);
        //     // dd($planningAcc);
        //     return $this->render('principal/initiative_accomplishment.html.twig', [
        //         'operatioanlSuitables' => $operatioanlSuitables,
        //         'operatioanlSuitablessocails' => $operatioanlSuitablessocails,
        //         'initiativeName' => $initiativeName,
        //         'planningAcc' => $planningAcc,
        //         'remainingdays' => $remainingdays,
        //         'social' => 1,

        //     ]);
        // } else {
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);
         
        $operatioanlSuitables = $operationalSuitableInitiativeRepository->findplan($principalOffice, $suitableInitiative->getId(), $currentQuarter);
        //dd($currentQuarter);
        $planningAcc = $em->getRepository(PlanningAccomplishment::class)->findBy(['suitableInitiative' => $suitableInitiative->getId()]);
        return $this->render('principal/initiative_accomplishment.html.twig', [
            'operatioanlSuitables' => $operatioanlSuitables,
            'initiativeName' => $initiativeName,
            'remainingdays' => $remainingdays,
            'planningAcc' => $planningAcc,
            'sendToPlan' => $sendToPlan,
            'social' => 0,
        ]);
        // }
    }
    /**
     * @Route("/principal_show", name="operational_task_principal_show")
     */
    public function principalShow(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
            // dd($delegatedUser->getDelegatedtaskUserUser());
        }
        $principalOfficeId = $user->getOperationalManagers()[0]->getOperationaloffice()->getPrincipalOffice()->getId();
        // dd($principalOfficeId);
        $taskAssigns = $taskAssignRepository->findTaskOperattionalList($principalOfficeId);
        return $this->render('operational_task/show.html.twig', [
            'taskAssigns' => $taskAssigns,
            'principal' => true
        ]);
    }

    /**
     * @Route("/objectivevskpi", name="objectivevskpi")
     */
    public function objectivevskpi(Request $request)
    {
        $this->denyAccessUnlessGranted('pre_rep_pro');
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("objective")) {
            $objective = $request->request->get("objective");
            $weightbased = $request->request->get("weightbased");
            $currentQuarter = AmharicHelper::getCurrentQuarter($em);
            $currentQuarter = 2;
            $quarterAccomplishment = $em->getRepository(QuarterPlanAchievement::class)->findByObjective($objective, $currentQuarter)[0];

            $quarterAccomplishment->setAccomp($weightbased);
            $em->flush();
            return $this->redirectToRoute('objectivevskpi');
        }
        $filterform = $this->createFormBuilder()
            ->add('objective', EntityType::class, [
                'class' => Objective::class,
                'placeholder' => "Objective",

                'required' => false
            ])
            ->getForm();
        $filterform->handleRequest($request);
        if ($request->request->get("excel")) {
            $currentQuarter = AmharicHelper::getCurrentQuarter($em);
            $currentQuarter = 2;
            $data = $filterform->getData()['objective'];
            $planValues = $em->getRepository(QuarterPlanAchievement::class)->findByKpiandQuarter($data, $currentQuarter);
            $spreadsheet = new Spreadsheet();
            $spreadsheet->getActiveSheet()->setTitle('Objective ');

            foreach (range('A', 'G') as $columnID) {
                $spreadsheet->getDefaultStyle()->getFont()->setSize(10)
                    ->getColor()->setRGB('#93F748');
                // $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(false);
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setWidth('10');
            }
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(60);

            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', $data->getName());
            $sheet->mergeCells('A1:E1');
            $sheet->getStyle('A1')->getFont()->setSize(015)->getColor()->setRGB('#0000');
            // $sheet->getRowDimension(1)->setRowHeight(45);
            $sheet->setCellValue('A2', 'ቁልፍ የዉጤት አመላካች');
            $sheet->setCellValue('B2', 'መለኪያ');
            $sheet->setCellValue('C2', 'ዕቅድ');
            $sheet->setCellValue('D2', 'ክንውን');
            $sheet->setCellValue('E2', 'በፐርሰንት');





            // $totalResult = $queryBuilder->getResult();
            // dd($totalResult);
            $x = 3;
            $soh = 0;
            foreach ($planValues as $result) {
                $sheet->setCellValue('A' . $x, $result->getKPiAchievement()->getKpi());
                $sheet->setCellValue('B' . $x, "number");
                $sheet->setCellValue('C' . $x, $result->getPlan());
                $sheet->setCellValue('D' . $x, ($result->getPlan() * $result->getAccomp()) / 100);
                $sheet->setCellValue('E' . $x, $result->getAccomp());

                $x++;
            }
            $writer = new Xlsx($spreadsheet);
            $fileName = "objective vs kpi" . '.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($temp_file);
            return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
        }
        if ($filterform->isSubmitted()) {
            $principal = 1;
            $currentQuarter = AmharicHelper::getCurrentQuarter($em);
            $currentQuarter = 2;
            $data = $filterform->getData()['objective'];
            // dd($data);
            $planValues = $em->getRepository(QuarterPlanAchievement::class)->findByKpiandQuarter($data, $currentQuarter);
        } else {

            $principal = 0;
            $planValues[] = "";
        }

        return $this->render('principal/test2.html.twig', [
            'planValues' => $planValues,
            'filterform' => $filterform->createView(),
            'principal' => $principal
        ]);
    }
    /**
     * @Route("/kpiWeight", name="kpiWeight")
     */
    public function kpiWeight(Request $request)
    {
        $this->denyAccessUnlessGranted('pre_rep_pro');
        $em = $this->getDoctrine()->getManager();

        $filterform = $this->createFormBuilder()
            ->add('objective', EntityType::class, [
                'class' => Objective::class,
                'placeholder' => "Objective",

                'required' => false
            ])
            ->getForm();
        $filterform->handleRequest($request);
        if ($filterform->isSubmitted()) {
            $principal = 1;

            $data = $filterform->getData()['objective'];
            // dd($data->getId());
            $key_performance_indicators = $em->getRepository(KeyPerformanceIndicator::class)->findBy(['objective' => $data->getId()]);
            // dd($key_performance_indicators);
        } else {

            $principal = 0;
            $key_performance_indicators[] = "";
        }

        return $this->render('principal/kpiweight.html.twig', [
            'key_performance_indicators' => $key_performance_indicators,
            'filterform' => $filterform->createView(),
            'principal' => $principal
        ]);
    }
    /**
     * @Route("/goalvsobjective", name="goalvsobjective")
     */
    public function goalvsobjective(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $this->denyAccessUnlessGranted('pre_rep_pro');
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("goal")) {
            $goal = $request->request->get("goal");
            $weightbased = $request->request->get("weightbased");
            $currentQuarter = AmharicHelper::getCurrentQuarter($em);
            $currentQuarter = 2;
            $quarterAccomplishment = $em->getRepository(QuarterPlanAchievement::class)->findByGoal($goal, $currentQuarter)[0];
            $quarterAccomplishment->setAccomp($weightbased);
            $em->flush();
            return $this->redirectToRoute('goalvsobjective');
        }
        $filterform = $this->createFormBuilder()
            ->add('goal', EntityType::class, [
                'class' => Goal::class,
                'placeholder' => "Goal",
                'required' => false
            ])
            ->getForm();
        $filterform->handleRequest($request);
        if ($filterform->isSubmitted()) {
            $principal = 1;
            $currentQuarter = AmharicHelper::getCurrentQuarter($em);
            $currentQuarter = 2;
            $data = $filterform->getData()['goal'];
            $planValues = $em->getRepository(QuarterPlanAchievement::class)->findByobjgoalandQuarter($data, $currentQuarter);
        } else {

            $principal = 0;
            $planValues[] = "";
        }

        return $this->render('principal/test.html.twig', [
            'planValues' => $planValues,
            'filterform' => $filterform->createView(),
            'principal' => $principal
        ]);
    }


    /**
     * @Route("/principal_history", name="principal_history")
     */
    public function score(Request $request, DomPrint $domPrint, PaginatorInterface $paginator)
    {
        $this->denyAccessUnlessGranted('pri_off_rep');
        $user = $this->getUser();
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
        $value = 1;
        $principalValue = 0;

        $form = $this->createFormBuilder()
            ->add('planningYear', EntityType::class, [
                'class' => PlanningYear::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "Year",

                'required' => false
            ])

            ->getForm();
        $form->handleRequest($request);

        if ($request->request->get("print")) {
            // dd(1);
            $data = $form->getData();
            $principal = $em->getRepository(PrincipalManager::class)->findOneBy(['principal' => $user]);
            $principalOffice =  $principal->getPrincipalOffice();
            $princpalManager = $em->getRepository(PrincipalManager::class)->findOneBy(['principalOffice' => $principalOffice]);
            $principalOfficeName = $principalOffice->getName();
            $chifPrincipal = $principalOffice->getManagedBy()->getName();
            $princpalManager = $princpalManager->getPrincipal()->getUserInfo()->getFullName();
            $planningYear = $form->getData()['planningYear']->getId();
            $totalInitiative = $em->getRepository(Initiative::class)->findOfficeInitiative($principalOffice);
            // dd($totalInitiative);
            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(), $principalOffice, $principalValue);
            // dd($suitableInitiatives);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData, $principalOffice, $currentQuarter, $principalValue);
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
            $principal = $em->getRepository(PrincipalManager::class)->findOneBy(['principal' => $user]);
            $principalOffice =  $principal->getPrincipalOffice();
            // dd($principalOffice);
            $planningYear = $form->getData()['planningYear']->getId();
            $totalInitiative = $em->getRepository(Initiative::class)->findOfficeInitiative($principalOffice);

            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(), $principalOffice, $principalValue);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(), $principalOffice, $currentQuarter, $principalValue);
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

        return $this->render('principal/score.html.twig', [
            'principalReports' => $data,
            'totalInitiative' => $totalInitiative,
            'form' => $form->createView(),
            'suitableInitiatives' => $suitableInitiatives,
            'value' => $value

        ]);
    }
}
