<?php

namespace App\Controller;

use App\Entity\Evaluation;
use App\Entity\Initiative;
use App\Entity\OperationalManager;
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
use App\Entity\TaskCategory;
use App\Form\PlanningYearType;
use App\Helper\DomPrint;
use App\Helper\AmharicHelper;
use App\Repository\TaskAccomplishmentRepository;
use DateTime;
use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PlanningYearRepository;


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
     * @Route("/score_report_child_principal", name="score_report_child_principal")
     */
    public function parentScore(Request $request, DomPrint $domPrint, PaginatorInterface $paginator)
    {
        // $this->denyAccessUnlessGranted('pre_rep_chi');
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
        $principal = $em->getRepository(PrincipalManager::class)->findOneBy(['principal' => $this->getUser()]);
        if($principal)
            $principalId =  $principal->getPrincipalOffice()->getId();
        // dd($principalId->getId());

        $value = 1;
        $principalValue = 1;
        $form = $this->createFormBuilder()
            ->add('principalOffice', EntityType::class, [
                'class' => PrincipalOffice::class,
//                'query_builder' => function (EntityRepository $er) 
//                use($principalId){
//                    return $er->createQueryBuilder('p')
//                        ->andWhere('p.managedBy = :val')
//                         ->setParameter('val' , $principalId)
//                        ->orderBy('p.id', 'ASC');
//                },

                'placeholder' => "All",
                'required' => false
            ])

            ->add('planningYear', EntityType::class, [
                'class' => PlanningYear::class,
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
            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(), $principalValue, $principalValue);

            // dd($suitableInitiatives);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(), $principalValue, $currentQuarter, $principalValue);
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
            // dd($principalOffice);
            $planningYear = $form->getData()['planningYear']->getId();
            $totalInitiative = $em->getRepository(Initiative::class)->findOfficeInitiative($principalOffice);
            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(), $principalValue, $principalValue);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(), $principalValue, $currentQuarter, $principalValue);
        // dd($principalReports);
        } else {

            $value = 0;
            $principalReports[] = "";
            $suitableInitiatives[] = "";
            $totalInitiative = "";
            // $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal();
        }
        $data = $paginator->paginate(
            $principalReports,
            $request->query->getInt('page', 1),
            10
        );
        // dd($data);

        return $this->render('smis_report/score_parent.html.twig', [
            'principalReports' => $data,
            'totalInitiative' => $totalInitiative,
            'form' => $form->createView(),
            'suitableInitiatives' => $suitableInitiatives,
            'value' => $value,

        ]);
    }
    /**
     * @Route("/score_report", name="score_report")
     */
    public function score(Request $request, DomPrint $domPrint, PaginatorInterface $paginator, PlanningYearRepository $planningYearRepository)
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
                'placeholder' => "All",
                'required' => false
            ])

            ->add('planningYear', EntityType::class, [
                'class' => PlanningYear::class,
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
            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(), $principalValue, $principalValue);

            // dd($suitableInitiatives);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(), $principalValue, $currentQuarter, $principalValue);
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
            if ($form->getData()['planningYear']){
                  $planningYear = $form->getData()['planningYear']->getId();
            }
            if ($form->getData()['principalOffice']){
                $principalOffice = $form->getData()['principalOffice']->getId();
                $totalInitiative = $em->getRepository(Initiative::class)->findOfficeInitiative($principalOffice);
                $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(), $principalValue, $principalValue);
                $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(), $principalValue, $currentQuarter, $principalValue);
            }else{
                $totalInitiative = count($em->getRepository(Initiative::class)->findAll());
                $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScore($form->getData(), $principalValue, $principalValue);
                $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(), $principalValue, $currentQuarter, $principalValue);
                //dd($principalReports);

            }
            
        } else {

            $value = 1;
            $totalInitiative = 0;
            $suitableInitiatives = [];
             $principalReports = [];
             $planningYear =  $planningYearRepository->findLast();
             $totalInitiative = count($em->getRepository(Initiative::class)->findAll());
             $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findScoreByPlanningYear($planningYear, $principalValue, $principalValue);
            $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipalForTheLastYear($planningYear, $principalValue, $currentQuarter, $principalValue);
           //dd($suitableInitiatives);
        }
        // dd($suitableInitiatives);
        $data = $paginator->paginate(
            $principalReports,
            $request->query->getInt('page', 1),
            1000
        );
        // dd($data);

        return $this->render('smis_report/score.html.twig', [
            'principalReports' => $data,
            'totalInitiative' => $totalInitiative,
            'form' => $form->createView(),
            'suitableInitiatives' => $suitableInitiatives,
            'value' => $value,

        ]);
    }

    /**
     * @Route("/task_list_report", name="task_list_report")
     */
    public function performerTaskEdit(Request $request, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $suitableInitiativeId = $request->request->get('suitableInitiativeId');
        //   dd($taskid);
        // dd($taskAccomplishmentRepository->findTasksInReport($suitableInitiativeId));

        return new JsonResponse(
            [
                'data' =>  $taskAccomplishmentRepository->findTasksInReport($suitableInitiativeId)
            ]
        );
    }

    /**
     * @Route("/oprational_score_report", name="oprational_score_report") 
     */
    public function oprationalScore(Request $request, DomPrint $domPrint, PaginatorInterface $paginator)
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
        $oprationalValue = 1;


        $form = $this->createFormBuilder()
            ->add('OpratinalOffice', EntityType::class, [
                'class' => OperationalOffice::class,
                //                'mapped'       => false,
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
            $OpratinalOffice = $form->getData()['OpratinalOffice']->getId();
            $OpratinalOffices = $em->getRepository(OperationalOffice::class)->find($OpratinalOffice);

            $OpratinalManager = $em->getRepository(OperationalManager::class)->findOneBy(['operationalOffice' => $OpratinalOffice]);
            $OpratinalOfficeName = $OpratinalOffices->getName();
            $chifPrincipal = $OpratinalOffices->getPrincipalOffice()->getManagedBy()->getName();
            $OpratinalManagerFullname = $OpratinalManager->getManager()->getUserInfo()->getFullName();
            $planningYear = $form->getData()['planningYear']->getId();
            $totalOperationalSuitableInitiative = $em->getRepository(SuitableOperational::class)->findOprationalOfficeSuitableInitiative($OpratinalOffice);

            $operationalsuitableInitiatives = $em->getRepository(SuitableOperational::class)->findScore($form->getData(), $OpratinalOffice);

            // dd($suitableInitiatives);
            //$principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(),$oprationalValue,$currentQuarter,$oprationalValue);
            $planningYear = $em->getRepository(PlanningYear::class)->find($planningYear);
            $ethYear = $planningYear->getEthYear();

            $domPrint->print('smis_report/oprational_score_print.html.twig', [
                //                'principalReports' => $principalReports,
                'date' => (new \DateTime())->format('y-m-d'),
                'OpratinalManager' => $OpratinalManager,
                'operationalsuitableInitiatives' => $operationalsuitableInitiatives,
                'OpratinalOffices' => $OpratinalOffices,
                'totalInitiative' => $totalOperationalSuitableInitiative,
                'chifPrincipal' => $chifPrincipal,
                'ethYear' => $ethYear,
                'fullName' => $OpratinalManagerFullname,
            ], 'performance score card for ' . $OpratinalOffices, 'landscape');

            // return $this->redirectToRoute('score_report');
        }
        if ($form->isSubmitted()) {
            $value = 1;
            $data = $form->getData(); //dd($data);
            if ($form->getData()['OpratinalOffice']) {
                $OpratinalOffice = $form->getData()['OpratinalOffice']->getId();
            } else {
                $OpratinalOffice = $this->getUser()->getOperationalOffices()->unwrap()->toArray();
            }
            // dd($OpratinalOffice);
            $planningYear = $form->getData()['planningYear']->getId();
            $totalOperationalSuitableInitiative = $em->getRepository(SuitableOperational::class)->findOprationalOfficeSuitableInitiative($OpratinalOffice);

            $operationalsuitableInitiatives = $em->getRepository(SuitableOperational::class)->findScore($form->getData(), $OpratinalOffice);

            //dd($operationalsuitableInitiatives);
            //$principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal($form->getData(),$OpratinalOffice,$currentQuarter,$oprationalValue);
        } else {

            $value = 0;
            $principalReports[] = "";
            $operationalsuitableInitiatives[] = "";
            $totalOperationalSuitableInitiative = "";
            // $principalReports = $em->getRepository(PlanningAccomplishment::class)->findPrincipal();
        }
        //dd($operationalsuitableInitiatives);
        $data = $paginator->paginate(
            $operationalsuitableInitiatives,
            $request->query->getInt('page', 1),
            10
        );
        //dd($data);

        return $this->render('smis_report/oprational_score.html.twig', [
            'operationalsuitableInitiativeDatas' => $data,
            'totalOperationalSuitableInitiative' => $totalOperationalSuitableInitiative,
            'form' => $form->createView(),
            'operationalsuitableInitiatives' => $operationalsuitableInitiatives,
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
                'placeholder' => "Principal Office",
                'required' => false
            ])
           
            ->add('planningYear', EntityType::class, [
                'class' => PlanningYear::class,
                'placeholder' => "All",

                'required' => false
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if($form->getData()['planningYear'] && $form->getData()['principalOffice']){
                 $QyearId = $form->getData()['planningYear']->getId();
                 $prinOfId = $form->getData()['principalOffice']->getId();
                $principalOffices = $em->getRepository(PrincipalOffice::class)->findByYearPrinciplaOffice( $prinOfId,$QyearId);
            } 
           else  if($form->getData()['planningYear']){
                 $QyearId = $form->getData()['planningYear']->getId();
                 $principalOffices = $em->getRepository(PrincipalOffice::class)->findByYear($QyearId);
            } 
            else {
                $principalOffices = $em->getRepository(PrincipalOffice::class)->findBy(['id' => $prinOfId]);
            }
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
        // dd(AmharicHelper::getCurrentYear());

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
            ->add('taskCategory', EntityType::class, [
                'class' => TaskCategory::class,
                // 'multiple' => true,
                // 'placeholder' => 'All',
                'placeholder' => "Task Category ",

                'required' => false
            ])



            ->getForm();
        $form->handleRequest($request);
        if ($request->request->get("remove")) {
            $quarter = $request->request->get('form')['quarter'];
            $taskCategory = $request->request->get('form')['taskCategory'];
            $prinOfId = $form->getData()['principalOffice']->getId();
            $principalOffices = $em->getRepository(PrincipalOffice::class)->findBy(['id' => $prinOfId]);
            // dd($taskCategory);
            $evaluations = $em->getRepository(Evaluation::class)->findByPrincipal($prinOfId, $quarter, $taskCategory);
            $operationalSuitableInitiatives = $em->getRepository(OperationalSuitableInitiative::class)->findByPrincipal($prinOfId, $quarter);
            $taskAccomplishments = $em->getRepository(TaskAccomplishment::class)->findByPrincipal($prinOfId, $quarter, $taskCategory);
            $taskAssigns = $em->getRepository(TaskAssign::class)->findByPrincipal($prinOfId, $quarter, $taskCategory);
            $performerTasks = $em->getRepository(PerformerTask::class)->findByPrincipal($prinOfId, $quarter, $taskCategory);
            $operationalPlanningAccomplishments = $em->getRepository(OperationalPlanningAccomplishment::class)->findByPrincipal($prinOfId);
            $suitableOperationals = $em->getRepository(SuitableOperational::class)->findByPrincipal($prinOfId);
            $planningAccomplishments = $em->getRepository(PlanningAccomplishment::class)->findByPrincipalRemove($prinOfId);

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
            foreach ($operationalPlanningAccomplishments as  $value) {
                $em->remove($value);
                $em->flush();
            }
            foreach ($suitableOperationals as  $value) {
                $value->setStatus(1);
                $em->flush();
            }
            foreach ($planningAccomplishments as  $value) {
                $em->remove($value);
                $em->flush();
            }
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
