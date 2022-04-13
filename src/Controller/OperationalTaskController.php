<?php

namespace App\Controller;


use App\Entity\Performer;
use App\Entity\PerformerTask;
use App\Entity\PlanningAccomplishment;
use App\Entity\StaffEvaluationBehaviorCriteria;
use App\Entity\SuitableInitiative;
use App\Entity\TaskMeasurement;
use App\Form\OperationalTaskType;
use App\Form\PerformerTaskType;
use App\Form\TaskMeasurementType;
use App\Repository\OperationalManagerRepository;
use App\Repository\OperationalOfficeRepository;
use App\Repository\OperationalTaskRepository;
use App\Repository\PerformerRepository;
use App\Repository\PerformerTaskRepository;
use App\Repository\PlanningAccomplishmentRepository;
use App\Repository\SuitableInitiativeRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use DateTime;
use Andegna\DateTime as AD;
use Andegna\DateTimeFactory;
use App\Entity\Delegation;
use App\Entity\Evaluation;
use App\Entity\Initiative;
use App\Entity\OperationalManager;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\OperationalSuitableInitiative;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\SmisSetting;
use App\Entity\SuitableOperational;
use App\Entity\TaskAccomplishment;
use App\Entity\TaskAssign;
use App\Entity\TaskCategory;
use App\Entity\User;
use App\Helper\AmharicHelper;
use App\Helper\Helper;
use App\Helper\PlanAchievementHelper;
use App\Repository\OperationalSuitableInitiativeRepository;
use App\Repository\PlanningQuarterRepository;
use App\Repository\PrincipalManagerRepository;
use Knp\Component\Pager\PaginatorInterface;

use Proxies\__CG__\App\Entity\InitiativeAttribute;
use Proxies\__CG__\App\Entity\PlanningQuarter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational_task")
 */
class OperationalTaskController extends AbstractController
{

    /**
     * @Route("/index/{id}", name="operational_task_index")
     */
    public function index(Request $request, SuitableOperational $suitableOperational,    PerformerTaskRepository $performerTaskRepository): Response
    {
        $this->denyAccessUnlessGranted('opr_task');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $social = 0;
        foreach ($suitableOperational->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }
        $taskCategorys = $em->getRepository(TaskCategory::class)->findAll();
        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        $count = 0;
        $maxcount = 0;
        $taskAssigns = $em->getRepository(TaskAssign::class)->findTaskUsers($user);
        $assign = 0;
        $idd = 0;
        $countCore = 0;
        $count = 0;
        $performerTasksList = $performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational);
        foreach ($performerTasksList as $performerTas) {
            // dd($operational);
            if ($performerTas->getTaskCategory()->getIsCore()) {
                $countCore = $countCore + $performerTas->getWeight();
                $idd = $performerTas->getId();
            } else {
                $count = $count +
                    $performerTas->getWeight();
            }
        }
        $assigns = $em->getRepository(TaskAssign::class)->findOneBy(['PerformerTask' => $idd]);
        if ($assigns) {
            $assign++;
        }
        // dd($assign);
        $time = new DateTime('now');
        $quarterId = 0;
        $quarterName = 0;
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        foreach ($quarters as $quarter) {
            if ($time >= $quarter->getStartDate() && $time <= $quarter->getEndDate()) {

                $quarterId = $quarter->getId();
                $quarterName = $quarter->getName();
                $quarterStartMonth1 = $quarter->getStartMonth();
                $quarterStartDate1 = $quarter->getStartDay();
                $quarterEndMonth = $quarter->getEndMonth();
                $quarterStartDate = AmharicHelper::getCurrentDay();
                $quarterEndDate = $quarter->getEndDay();
                $startYear = AmharicHelper::getCurrentYear();
                $endYear = $quarter->getEndDate();
                $endYear = AmharicHelper::getCurrentYearPara($endYear);
                $quarterStartMonth = AmharicHelper::getCurrentMonth();
                $quarterStartMonth = explode('-', $quarterStartMonth);
                $maxDate = $endYear . ',' . $quarterEndMonth . ',' . $quarterEndDate;
                $maxDate = $endYear . ',' . $quarterEndMonth . ',' . $quarterEndDate;
                $minDate = $startYear . ',' . $quarterStartMonth[1] . ',' . $quarterStartDate;
                $maxDate = $endYear . ',' . $quarterEndMonth . ',' . $quarterEndDate;
                $minDateEdit = $startYear . ',' . $quarterStartMonth1 . ',' . $quarterStartDate1;
            }
        }
        $maxPenalityDays = $em->getRepository(SmisSetting::class)->findAll()[0];
        $maxTasks = $em->getRepository(SmisSetting::class)->findAll()[0];
        $maxTask = $maxTasks->getMaxAllowedTasks();
        $maxPenalityDay = $maxPenalityDays->getMaxPenalityDays();
        if ($form->isSubmitted() && $form->isValid()) {
            if ($social == 1) {
                $plans = $em->getRepository(OperationalPlanningAccomplishment::class)->findBy(['operationalSuitable' => $suitableOperational, 'quarter' => $quarterId]);
            } else {
                $plans = $em->getRepository(OperationalPlanningAccomplishment::class)->findBy(['operationalSuitable' => $suitableOperational, 'quarter' => $quarterId]);
            }

            if (!$plans) {
                $this->addFlash('danger', 'Plan Not Set for this Initiative');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
            }
            // dd($plans);
            $performerTask->setOperationalPlanningAcc($plans[0]);
            if ($social == 1) {
                $performerTask->setOperationalPlanningAccSocial($plans[1]);
            }
            $isCore = $request->request->get("isCore");
            $performerTaskName = $request->request->get("performerTaskName");
            $coreTaskName = $request->request->get("coreTaskList");
            if ($isCore) {
                $performerTask->setName($coreTaskName);
            } else {
                if (!$performerTaskName) {

                    $this->addFlash('danger', 'Task Name Required!');
                    return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
                }
                if (!$form->getData()->getWeight()) {

                    $this->addFlash('danger', 'Task Weight Required!');
                    return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
                }

                $performerTask->setName($performerTaskName);
            }
            //  dd(1);
            $categoryId = $request->request->get("categoryId");
            $taskCategory = $em->getRepository(TaskCategory::class)->find($categoryId);
            $performerTask->setTaskCategory($taskCategory);
            $performerTask->setStatus(1);
            if ($delegatedUser) {
                $delegatedBy = $delegatedUser->getDelegatedUser();
                $performerTask->setDeligateBy($delegatedBy);
            }
            $performerTask->setQuarter($em->getRepository(PlanningQuarter::class)->find($quarterId));
            foreach ($user->getOperationalManagers() as $op) {
                $opOff = $op->getOperationalOffice();
            }
            if ($maxcount > $maxTask) {
                $this->addFlash('danger', 'Task must be less than 7 !');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
            }
            $performerTask->setOperationalOffice($opOff);
            $performerTask->setCreatedBy($user);
            $weight = 0;
            $weight = $form->getData()->getWeight();
            if (!$weight) {
                $weight = 100;
                # code...
            }
            $performerTask->setWeight($weight);

            if (!$isCore) {
                # code...
                if ($count + $weight > 100) {
                    $this->addFlash('danger', 'Weight must be less than 100 !');
                    return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
                }
            } else {

                if ($countCore + $weight > 100) {
                    $this->addFlash('danger', 'Weight must be less than 100 !');
                    return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
                }
            }
            $em->persist($performerTask);
            $em->flush();
            $this->addFlash('success', ' Task Created Successfully!');
            return $this->redirectToRoute('operational_task_index', ['id' => $suitableOperational->getId()]);
        }
        // dd($performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational));
        $maxPenalityDays = $em->getRepository(SmisSetting::class)->findAll()[0];
        $maxTasks = $em->getRepository(SmisSetting::class)->findAll()[0];
        $maxTask = $maxTasks->getMaxAllowedTasks();
        $maxPenalityDay = $maxPenalityDays->getMaxPenalityDays();
        return $this->render('operational_task/index.html.twig', [
            'performerTasks' => $performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational),
            'countWeight' => $count,
            'countCore' => $countCore,
            'quarterName' => $quarterName,
            'taskAssigns' => $taskAssigns,
            'form' => $form->createView(),
            'assign' => $assign,
            'maxDate' => $maxDate,
            'maxContengencyTime' => $maxPenalityDay,
            'minDate' => $minDate,
            'minDateEdit' => $minDateEdit,
            'measurements' => $em->getRepository(TaskMeasurement::class)->findAll(),
            'social' => $social,
            'formtask' => $formtask->createView(),
            'initiativeName' => $suitableOperational->getSuitableInitiative()->getInitiative()->getName(),
            'taskCategorys' => $taskCategorys,
            'coreTaskList' => $suitableOperational->getSuitableInitiative()->getInitiative()->getCoreTask()

        ]);
    }
    //suitable Initiative List in operational Task
    /**
     * @Route("/suitable_initiative_list", name="suitable_initiative_list")
     */
    public function suitableInitiative(Request $request, PaginatorInterface $paginator, OperationalManagerRepository $operationalManagerRepository): Response
    {
        $this->denyAccessUnlessGranted('opr_task');
        $ent = $this->getDoctrine()->getManager();
        $suitableInitiatives = $ent->getRepository(SuitableInitiative::class)->findAll();
        // dd(1);
        foreach ($suitableInitiatives as $suitableInitiative) {
            // Helper::setGoalPlan($ent, $suitableInitiative);

            PlanAchievementHelper::setKpiAchievement($ent, $suitableInitiative);
        }

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        // dd($user);
        $social = 0;
        $currentYear = AmharicHelper::getCurrentYear();
        $operation = $operationalManagerRepository->findOneBy(['manager' => $user, 'isActive' => 1]);

        if (!$operation) {
            $this->addFlash('danger', 'You are Not active!');

            return $this->redirectToRoute('choose_office');
        }
        $operationalOffice =  $operation->getOperationalOffice()->getId();
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);
        $currentMonths = AmharicHelper::getCurrentMonth($em);
        $currentMonths = explode('-', $currentMonths);

        if ($currentQuarter == 1) {
            $currentYear = $currentYear + 1;
            if ($currentMonths[1] == "01") {
                $currentYear = $currentYear - 1;
            }
        }
        $operationalSuitables = $em->getRepository(SuitableOperational::class)->findSuitableInitiatve($operationalOffice, $currentYear);
        // dd($operationalSuitables);
        $operationalPlanningAccomplishments = $em->getRepository(OperationalPlanningAccomplishment::class)->findAll();
        $data = $paginator->paginate(
            $operationalSuitables,
            $request->query->getInt('page', 1),
            10
        );
        // dd($currentQuarter = AmharicHelper::getCurrentQuarter($em));
        return $this->render('operational_task/suitable_initiative.html.twig', [
            'operationalSuitables' => $data,
            'data' => $operationalSuitables,
            'count' => $operationalSuitables,
            'operationalPlanningAccomplishments' => $operationalPlanningAccomplishments,
            'quarter' => $currentQuarter = AmharicHelper::getCurrentQuarter($em)


        ]);
    }
    //principal approve operationalPlan in cascading and achivment 
    /**
     * @Route("/approve_operational_plan", name="approve_operational_plan")
     */
    public function approveOperationalPlan(Request $request)
    {
        $this->denyAccessUnlessGranted('pri_off_rep');
        $em = $this->getDoctrine()->getManager();

        $suitableInId = $request->request->get('suitableInId');
        $operationalOfId = $request->request->get('operationalOfId');
        $suitableInitiative = $em->getRepository(SuitableInitiative::class)->find($suitableInId);
        $operationalSuitable = $em->getRepository(SuitableOperational::class)->findOperationalId($suitableInId, $operationalOfId);
        // dd($operationalSuitable);
        foreach ($operationalSuitable as  $value) {
            $value->setStatus(1);
        }
        $em->flush();
        Helper::setGoalPlan($em, $suitableInitiative);

        return new JsonResponse($operationalSuitable);
    }

    /**
     * @Route("/accomplisment/{id}", name="acomplishment_task_detail")
     */
    public function accomplishment(Request $request, SuitableOperational $suitableOperational, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $this->denyAccessUnlessGranted('opr_task');

        $em = $this->getDoctrine()->getManager();
        $socialAttr = 0;
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $social = 0;
        foreach ($suitableOperational->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }
        $initiativeName = $suitableOperational->getSuitableInitiative()->getInitiative()->getName();
        $initiativeId = $suitableOperational->getId();
        $performerTasksCore = $em->getRepository(PerformerTask::class)->findCores($suitableOperational, $user, AmharicHelper::getCurrentQuarter($em));

        $performerTasks = $em->getRepository(PerformerTask::class)->findInitiativeBySocial($suitableOperational, $user, AmharicHelper::getCurrentQuarter($em));
        $taskAcomolishs = $taskAccomplishmentRepository->findDetailAccomplishSocial($suitableOperational, $user);
        //   dd($performerTasksCore,$taskAcomolishs,$performerTasks);
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
        $maxPenalityDays = $em->getRepository(SmisSetting::class)->findAll()[0];
        $maxTasks = $em->getRepository(SmisSetting::class)->findAll()[0];
        $sendToPrincipal = $maxTasks->getSendToPrincipal();
        $sendToPlan = $maxPenalityDays->getSendToPlan();
        return $this->render('operational_task/accomplishment_detail.html.twig', [
            'taskAcomolishs' => $taskAcomolishs,
            'performerTasksCore' => $performerTasksCore,
            'initiativeName' => $initiativeName,
            'initiativeId' => $initiativeId,
            'performerTasks' => $performerTasks,
            'social' => $social,
            'remainingdays' => $remainingdays,
            'sendToPrincipal' => $sendToPrincipal,
            'sendToPlan' => $sendToPlan

        ]);
    }

    /**
     * @Route("/send_principal", name="send_to_principal")
     */
    public function sendToPrincipal(Request $request, OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository)
    {
        $this->denyAccessUnlessGranted('opr_task');
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("planOffice")) {
            $planAcomplismentId = $request->request->get("planId");
            $social = $request->request->get("social");
            $acompAverages = $request->request->get("acompAvareage");
            $quarter = $request->request->get("quarter");
            // dd($acompAverages);
            if ($social[0]) {
                $operationalSuitables = $operationalSuitableInitiativeRepository->findBy(['PlanningAcomplishment' => $planAcomplismentId[0]]);
                foreach ($operationalSuitables as $value) {
                    $value->setStatus(2);
                }
                $operationalSuitables = $operationalSuitableInitiativeRepository->findBy(['PlanningAcomplishment' => $planAcomplismentId[1]]);
                foreach ($operationalSuitables as $value) {
                    $value->setStatus(2);
                }
                foreach ($acompAverages as $key => $value) {
                    $planAcomplishments1 = $em->getRepository(OperationalPlanningAccomplishment::class)->find($planAcomplismentId[0]);
                    $suitId = $planAcomplishments1->getOperationalSuitable()->getSuitableInitiative()->getId();
                    // $planAcomplishments = $planningAccomplishmentRepository->find($planAcomplismentId[$key]);
                    $planAcomplishments = $planningAccomplishmentRepository->findOneBy(['suitableInitiative' => $suitId, 'quarter' => $quarter]);

                    $planAcomplishments->setAccompValue($value);
                }

                $em->flush();
            } else {
                $operationalSuitables = $operationalSuitableInitiativeRepository->findBy(['operationalPlanning' => $planAcomplismentId[0]]);
                foreach ($operationalSuitables as $value) {
                    $value->setStatus(2);
                }
                $planAcomplishments1 = $em->getRepository(OperationalPlanningAccomplishment::class)->find($planAcomplismentId[0]);
                $suitId = $planAcomplishments1->getOperationalSuitable()->getSuitableInitiative()->getId();
                $planAcomplishments = $planningAccomplishmentRepository->findOneBy(['suitableInitiative' => $suitId, 'quarter' => $quarter]);
                $planAcomplishments->setAccompValue($acompAverages[0]);

                $suitableInitiative = $em->getRepository(SuitableInitiative::class)->find($suitId);
                $suitableInitiative->setStatus(1);
                $em->flush();
                PlanAchievementHelper::setInitiativeAchievement($em, $suitableInitiative);
            }
            $this->addFlash('success', 'Successfully Send To Plan Office !');

            return $this->redirectToRoute('principal_office_report');
        }
        $user = $this->getUser();
        $operation = $em->getRepository(OperationalManager::class)->findOneBy(['manager' => $user]);
        $opOffice = $operation->getOperationalOffice();
        $principal = $opOffice->getPrincipalOffice();
        $accomp = $request->request->get('accomp');
        $suitiniId = $request->request->get('suitableinitiative');
        $quarterId = $request->request->get('quarterId');
        $quarter = $em->getRepository(PlanningQuarter::class)->find($quarterId);
        $socialAttribute = $em->getRepository(InitiativeAttribute::class)->findAll();
        $performerTasks1 = $em->getRepository(PerformerTask::class)->findsendToprincipalSocial($user, $suitiniId);
        foreach ($performerTasks1 as $value) {
            $value->setStatus(0);
        }

        $plannings = $em->getRepository(OperationalPlanningAccomplishment::class)->findplanAccwithoutSocial($suitiniId, $opOffice, $quarter);
        // dd($plannings,$opOffice,$quarter,$suitiniId);
        foreach ($plannings as $key => $value) {
            # code...
            $value->setAccompValue($accomp[$key]);
            $operationalSuitable = $value->getOperationalSuitable();
            $operationalSuitable->setStatus(2);
            $operationalSuitableInitiative = new OperationalSuitableInitiative();
            $operationalSuitableInitiative->setOperationalPlanning($value);
            $operationalSuitableInitiative->setOperationalOffice($opOffice);
            $operationalSuitableInitiative->setAccomplishedValue($accomp[$key]);
            $operationalSuitableInitiative->setQuarter($quarter);
            $operationalSuitableInitiative->setSocial($socialAttribute[$key]);
            $operationalSuitableInitiative->setStatus(1);
            $em->persist($operationalSuitableInitiative);
        }
        $em->flush();
        $this->addFlash('success', 'Successfully Send To Principal Office !');
        return $this->redirectToRoute('suitable_initiative_list');
    }
    /**
     * @Route("/suitableInitiative_principal_list", name="suitable_initiative_principal_list")
     */
    public function suitableInitiativeprincipal(Request $request,     PrincipalManagerRepository $principalManagerRepository): Response
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $social = 0;
        $operation = $principalManagerRepository->findOneBy(['principal' => $user]);
        $principlaOffice =  $operation->getPrincipalOffice()->getId();
        $suitableInitiatives =  $em->getRepository(SuitableInitiative::class)->findBy(["principalOffice" => $principlaOffice]);
        return $this->render('operational_task/suitable_principal.html.twig', [
            'suitableInitiatives' => $suitableInitiatives,
        ]);
    }
    /**
     * @Route("/fetch_operational_accomplishment", name="fetch_operational_accomplishment")
     */
    public function fetchOperationalAccomplishment(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->request->get("principal")) {
            $currentQuarter = AmharicHelper::getCurrentQuarter($em);
            $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findAll();
            foreach ($suitableInitiatives as $suit) {
                if ($suit->getStatus() != 1) {
                    # code...

                    $operatioanlSuitableInitiative = $em->getRepository(OperationalSuitableInitiative::class)->findPrincipalAccomplishment($suit->getId(), $currentQuarter);
                    $plan = 0;
                    foreach ($operatioanlSuitableInitiative as $value) {
                        $plan = $plan + $value->getAccomplishedValue();
                        $value->setStatus(2);
                        $em->flush();
                    }
                    $planningAccomplishment = $em->getRepository(PlanningAccomplishment::class)->findOneBy(['suitableInitiative' => $suit->getId(), 'quarter' => $currentQuarter]);
                    if ($plan) {
                        $planningAccomplishment->setAccompValue($plan);
                    }
                    // dd($planningAccomplishment->getSuitableInitiative());
                    if ($planningAccomplishment) {
                        # code...
                        $suit->setStatus(1);
                    }

                    $em->flush();
                }
            }


            $this->addFlash('success', 'Successfully Fetch Operational Office Result  !');
        }
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);
        // dd($currentQuarter);
        $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findAll();
        foreach ($suitableInitiatives as $suit) {
            # code...
            // dd($suit);
            $operatioanlSuitables = $em->getRepository(TaskAccomplishment::class)->findOperationalAccomplishment($suit->getId(), $currentQuarter);
            foreach ($operatioanlSuitables as $key => $value) {
                $operationalSuitableInitiative = new OperationalSuitableInitiative();

                $planning = $value->getTaskASsign()->getPerformerTask()->getOperationalPlanningAcc();
                $operationalOffice = $value->getTaskASsign()->getPerformerTask()->getOperationalOffice();
                $quarter = $value->getTaskASsign()->getPerformerTask()->getQuarter();
                $accompValue = $value->getAccomplishmentValue();
                $expectedValue = $value->getExpectedValue();
                // dd($planning, $operationalOffice, $accompValue, $quarter);
                if ($accompValue) {
                    $to = $planning->getPlanValue() * $accompValue;
                    $accompValueto = $to / $expectedValue;
                    $accompValuetott = round($accompValueto, 2);
                    // dd($expectedValue,$accompValue,$to,$planning->getPlanValue(),$accompValuetott);
                    $operationalSuitableInitiative->setOperationalPlanning($planning);
                    $operationalSuitableInitiative->setOperationalOffice($operationalOffice);
                    $operationalSuitableInitiative->setAccomplishedValue($accompValuetott);
                    $operationalSuitableInitiative->setQuarter($quarter);
                    // $operationalSuitableInitiative->setSocial($socialAttribute[$key]);
                    $operationalSuitableInitiative->setStatus(1);
                    $performerTask = $em->getRepository(PerformerTask::class)->find($value->getTaskASsign()->getPerformerTask()->getId());
                    $performerTask->setStatus(0);
                    // dd($performerTaskId);
                    $plannings = $em->getRepository(OperationalPlanningAccomplishment::class)->find($planning->getId());

                    $plannings->setAccompValue($accompValuetott);
                    $operationalSuitable = $plannings->getOperationalSuitable();
                    $operationalSuitable->setStatus(2);
                    $em->persist($operationalSuitableInitiative);
                }
                $em->flush();
            }
            $em->flush();
        }
        // $em->flush();

        $this->addFlash('success', 'Successfully Fetch Operational Office Result  !');

        return $this->redirectToRoute('principal_office_report');
    }


    /**
     * @Route("/user_fetch", name="user_fetch")
     */
    public function OperationalFetch(Request $request, PerformerRepository $performerRepository, OperationalManagerRepository $operationalManagerRepository)
    {
        $user = $this->getUser();
        if ($request->request->get('isCore')) {
            $units = $operationalManagerRepository->findAllsUser($request->request->get('userprincipal'), $user);
        } else {
            $units = $performerRepository->findAllsUser($request->request->get('userprincipal'));
        }
        return new JsonResponse($units);
    }
    /**
     * @Route("/performer_fetch", name="performer_fetch")
     */
    public function performerFetch(Request $request, PerformerRepository $performerRepository)
    {
        $units = $performerRepository->findAllsUser($request->request->get('userprincipal'));
        return new JsonResponse($units);
    }
    /**
     * @Route("/taskFetch", name="task_fetch")
     */
    public function taskFetch(Request $request, PerformerTaskRepository $performerTaskRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $userId = $request->request->get("user");
        $users = $em->getRepository(User::class)->find($userId);
        $user = $users->getId();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy()->getId();
            $user = $delegatedBy;
        }
        if ($request->request->get('isCore')) {

            $units = $performerTaskRepository->filterDeliverByIsCore($request->request->get('task'), $user, $request->request->get('quartertask'));
        } else {
            $units = $performerTaskRepository->filterDeliverBy($request->request->get('task'), $user, $request->request->get('quartertask'));
        }

        return new JsonResponse($units);
    }

    /**
     * @Route("/show", name="operational_task_show")
     */
    public function show(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $this->denyAccessUnlessGranted('opr_task');
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $taskAssigns = $taskAssignRepository->findTaskUsersList($user);
        return $this->render('operational_task/show.html.twig', [
            'taskAssigns' => $taskAssigns,
            'principal' => false
        ]);
    }

    /**
     * @Route("/show_detail", name="operational_task_show_detail")
     */
    public function showDetail(Request $request, TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskAssignRepository $taskAssignRepository)
    {

        $em = $this->getDoctrine()->getManager();
        $principal = $request->request->get('principal');
        if ($request->request->get('reportAvail')) {
            $principal = $request->request->get('principal');
            $percent = 0;
            $reportValue = $request->request->get('reportValue');
            $accompValue = $request->request->get('accompValue');
            $reportValueSocial = $request->request->get('reportValueSocial');
            $accompValueSocial = $request->request->get('accompValueSocial');
            $quality = $request->request->get('quality');
            $ids = $request->request->get('taskAccomplishmentId');
            $evaluation = new Evaluation();
            $taskAccomplishment = $taskAccomplishmentRepository->find($ids);
            $planning = $taskAccomplishment->getTaskAssign()->getPerformerTask()->getOperationalPlanningAcc();
            $operationalOffice = $taskAccomplishment->getTaskAssign()->getPerformerTask()->getOperationalOffice();
            $quarter = $taskAccomplishment->getTaskAssign()->getPerformerTask()->getQuarter();
            $performerTaskId = $taskAccomplishment->getTaskAssign()->getPerformerTask()->getId();
            $percent = (($accompValue * 100) / $taskAccomplishment->getExpectedValue());
            $evaluateUser = $taskAccomplishment->getTaskAssign()->getAssignedTo();
            if ($accompValue < 0) {
                $this->addFlash('danger', 'Report value muste be 0 or Postive Number !');
                return $this->redirectToRoute('performer_task_index');
            }
            if ($accompValue == 0) {
                $taskAccomplishment->setAccomplishmentValue(0);
                $taskAccomplishment->setReportedValue(0);
                if ($reportValueSocial) {
                    $taskAccomplishment->setAccomplishmentValueSocial($accompValueSocial);
                    $taskAccomplishment->setReportedValueSocial($reportValueSocial);
                }
            } else {
                $taskAccomplishment->setAccomplishmentValue($accompValue);
                $taskAccomplishment->setReportedValue($reportValue);
                if ($reportValueSocial) {
                    $taskAccomplishment->setAccomplishmentValueSocial($accompValueSocial);
                    $taskAccomplishment->setReportedValueSocial($reportValueSocial);
                }
            }
            $evaluation->setEvaluateUser($evaluateUser);
            $evaluation->setTaskAccomplishment($taskAccomplishment);
            $evaluation->setQuantity($percent);
            if ($quality) {
                # code...
                $evaluation->setQuality($quality);
            } else {
                $evaluation->setQuality(0);
            }
            $taskUser = $taskAssignRepository->findOneBy(['id' => $taskAccomplishment->getTaskAssign()->getId()]);
            $taskUser->setType(3);
            $plannings = $em->getRepository(OperationalPlanningAccomplishment::class)->find($planning->getId());
            $performerTask = $em->getRepository(PerformerTask::class)->find($performerTaskId);
            $expectedValue = $taskAccomplishment->getExpectedValue();
            // dd($planning, $operationalOffice, $accompValue, $quarter);
            $to = $planning->getPlanValue() * $accompValue;
            $accompValueto = $to / $expectedValue;
            $accompValuetott = round($accompValueto, 2);
            // if task is Suportive can not insert in operationalSuitable
            if ($performerTask->getTaskCategory()->getIsCore()) {
                // $performerTask->setStatus(0);
                // dd($performerTaskId);
                $plannings->setAccompValue($accompValuetott);
                $operationalSuitable = $plannings->getOperationalSuitable();
            }
            // $operationalSuitable->setStatus(1);
            $operationalSuitableInitiative = new OperationalSuitableInitiative();
            $operationalSuitableInitiative->setOperationalPlanning($planning);
            $operationalSuitableInitiative->setOperationalOffice($operationalOffice);
            $operationalSuitableInitiative->setAccomplishedValue($accompValuetott);
            $operationalSuitableInitiative->setQuarter($quarter);
            // $operationalSuitableInitiative->setSocial($socialAttribute[$key]);
            $operationalSuitableInitiative->setStatus(1);
            $em->persist($operationalSuitableInitiative);
            $em->flush();
            $this->addFlash('success', 'Successfully Operational Manager set Acomplisment value  !');
            if ($principal) {
                return $this->redirectToRoute('operational_task_principal_show');
            } else {
                return $this->redirectToRoute('operational_task_show');
            }
        }
        $taskAssign = $request->request->get('taskAssign');
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskAssign' => $taskAssign]);
        $taskAssigns = $taskAssignRepository->findBy(['id' => $taskAssign]);
        foreach ($taskAssigns as $value) {
            $endDate = $value->getEndDate();
            $endDates = explode('/', $endDate);
            $date = new DateTime();
        }
        $task = $taskAssignRepository->find($taskAssign);
        $iniName = $task->getPerformerTask()->getOperationalPlanningAcc()->getOperationalSuitable()->getSuitableInitiative()->getInitiative()->getName();
        if ($task->getType() < 2) {
            $task->setType(2);
            $em->flush();
        }
        $social = 0;
        foreach ($taskAccomplishments[0]->getTaskAssign()->getPerformerTask()->getOperationalPlanningAcc()->getOperationalSuitable()->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }
        return $this->render('operational_task/showDetail.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskAssigns' => $taskAssigns,
            'social' => $social,
            'iniName' => $iniName,
            'principal' => $principal
        ]);
    }
}
