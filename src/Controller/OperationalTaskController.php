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
use App\Repository\PlanRepository;
use App\Repository\PrincipalOfficeRepository;
use App\Repository\StaffEvaluationBehaviorCriteriaRepository;
use App\Repository\SuitableInitiativeRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\UserInfoRepository;
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
use App\Entity\TaskAssign;
use App\Entity\TaskCategory;
use App\Entity\User;
use App\Helper\AmharicHelper;
use App\Helper\Helper;
use App\Repository\OperationalPlanningAccomplishmentRepository;
use App\Repository\OperationalSuitableInitiativeRepository;
use App\Repository\PlanningQuarterRepository;
use App\Repository\PrincipalManagerRepository;
use Knp\Component\Pager\PaginatorInterface;

use Proxies\__CG__\App\Entity\InitiativeAttribute;
use Proxies\__CG__\App\Entity\OperationalSuitableInitiative as EntityOperationalSuitableInitiative;
use Proxies\__CG__\App\Entity\PlanningQuarter;
use Proxies\__CG__\App\Entity\SuitableOperational as EntitySuitableOperational;
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
        //create task 
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
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational);
        $taskAssigns = $em->getRepository(TaskAssign::class)->findTaskUsers($user);
        $countCore = 0;
        $count = 0;
        $performerTasksList = $performerTaskRepository->findPerformerInitiativeTask($user, $suitableOperational);
        foreach ($performerTasksList as $operational) {
            // dd($operational);
            if ($operational?->getTaskCategory()?->getIsCore()) {
                $countCore = $countCore + $operational->getWeight();
            } else {

                $count = $count +
                    $operational->getWeight();
            }
        }

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

            // dd($count, $weight, $isCore);
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
            'maxDate' => $maxDate,
            'maxContengencyTime' => $maxPenalityDay,
            'minDate' => $minDate,
            'minDateEdit' => $minDateEdit,
            'measurements' => $em->getRepository(TaskMeasurement::class)->findAll(),
            'social' => $social,
            'formtask' => $formtask->createView(),
            'initiativeName' => $suitableOperational->getSuitableInitiative()->getInitiative()->getName(),
            'taskCategorys' => $taskCategorys
        ]);
    }
    /**
     * @Route("/suitableInitiative_list", name="suitable_initiative_list")
     */
    public function suitableInitiative(Request $request, PaginatorInterface $paginator, OperationalManagerRepository $operationalManagerRepository): Response
    {
        $this->denyAccessUnlessGranted('opr_task');
        $em = $this->getDoctrine()->getManager();

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $social = 0;
        $currentYear = AmharicHelper::getCurrentYear();
        $operation = $operationalManagerRepository->findOneBy(['manager' => $user]);
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

        return $this->render('operational_task/suitableInitiative.html.twig', [
            'operationalSuitables' => $data,
            'data' => $operationalSuitables,
            'count' => $operationalSuitables,
            'operationalPlanningAccomplishments' => $operationalPlanningAccomplishments,
            'quarter' => $currentQuarter = AmharicHelper::getCurrentQuarter($em)


        ]);
    }
    /**
     * @Route("/approve_operational_plan", name="approve_operational_plan")
     */
    public function approveOperationalPlan(Request $request)
    {
        // dd(1);

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
        Helper::calculateInitiativePlan($em, $suitableInitiative);

        return new JsonResponse($operationalSuitable);
    }

    /**
     * @Route("/principal_report", name="principal_office_report", methods={"GET","POST"})
     */
    public function report(SuitableInitiativeRepository $suitableInitiativeRepository, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $principalOffice = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getId();
        $principalOfficeName = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getName();

        $principalOffice = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getId();
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
                'multiple' => true,
                'required' => false,

                'placeholder' => 'Choose an principal office',
            ])
            ->getForm();
        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {

            $suitableInitiatives = $suitableInitiativeRepository->search($filterForm->getData());
        } else
            $suitableInitiatives = $suitableInitiativeRepository->findBy(["principalOffice" => $principalOffice]);
        $principalOffice = $this->getUser()->getPrincipalManagers()[0]->getPrincipalOffice()->getId();
        $suitableInitiatives = $suitableInitiativeRepository->findBy(["principalOffice" => $principalOffice]);
        return $this->render('operational_task/report.html.twig', [
            'suitable_initiatives' => $suitableInitiatives,
            'filterform' => $filterForm->createView()
        ]);
    }

    /**
     * @Route("/accomplisment/{id}", name="acomplishment_task_detail")
     */
    public function accomplishment(Request $request, SuitableOperational $suitableOperational, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $socialAttr = 0;
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $social = 0;
        // dd($suitableOperational->getSuitableInitiative()->getInitiative()->getSocialAtrribute());
        foreach ($suitableOperational->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }
        $initiativeName = $suitableOperational->getSuitableInitiative()->getInitiative()->getName();
        $initiativeId = $suitableOperational->getId();
        $performerTasks = $em->getRepository(PerformerTask::class)->findInitiativeBySocial($suitableOperational, $user);
        $taskAcomolishs = $taskAccomplishmentRepository->findDetailAccomplishSocial($suitableOperational, $user);
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
        return $this->render('operational_task/accomplishmentDetail.html.twig', [
            'taskAcomolishs' => $taskAcomolishs,
            'initiativeName' => $initiativeName,
            'initiativeId' => $initiativeId,
            'performerTasks' => $performerTasks,
            'social' => $social,
            'remainingdays' => $remainingdays,
            'sendToPrincipal'=>$sendToPrincipal,
            'sendToPlan'=>$sendToPlan

        ]);
    }

    /**
     * @Route("/send_principal", name="send_to_principal")
     */
    public function sendToPrincipal(Request $request, OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("planOffice")) {
            $planAcomplismentId = $request->request->get("planId");

            $social = $request->request->get("social");
            $acompAverages = $request->request->get("acompAvareage");

            $quarter = $request->request->get("quarter");
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
                $em->flush();
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
        // dd($accomp[0]);
        $quarterId = $request->request->get('quarterId');
        $quarter = $em->getRepository(PlanningQuarter::class)->find($quarterId);
        $socialAttribute = $em->getRepository(InitiativeAttribute::class)->findAll();
        $performerTasks1 = $em->getRepository(PerformerTask::class)->findsendToprincipalSocial($user, $suitiniId);
        foreach ($performerTasks1 as $value) {
            $value->setStatus(0);
        }

        $plannings = $em->getRepository(OperationalPlanningAccomplishment::class)->findplanAccwithoutSocial($suitiniId, $opOffice, $quarter);

        foreach ($plannings as $key => $value) {
            # code...
            $value->setAccompValue($accomp[$key]);
            //   dd(1);
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
    public function suitableInitiativeprincipal(Request $request,   SuitableInitiativeRepository $suitableInitiativeRepository, PrincipalManagerRepository $principalManagerRepository): Response
    {
        $user = $this->getUser();
        $social = 0;
        $operation = $principalManagerRepository->findOneBy(['principal' => $user]);
        $principlaOffice =  $operation->getPrincipalOffice()->getId();
        $suitableInitiatives = $suitableInitiativeRepository->findBy(["principalOffice" => $principlaOffice]);
        return $this->render('operational_task/suitable_principal.html.twig', [
            'suitableInitiatives' => $suitableInitiatives,
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
        if ($socialAttr == 1) {
            // dd($suitableInitiative->getId());
            $operatioanlSuitables = $operationalSuitableInitiativeRepository->findplanSocial($principalOffice, $suitableInitiative->getId(), $male);
            $operatioanlSuitablessocails = $operationalSuitableInitiativeRepository->findplanSocial($principalOffice, $suitableInitiative->getId(), $female);
            $planningAcc = $em->getRepository(PlanningAccomplishment::class)->findBy(['suitableInitiative' => $suitableInitiative->getId()]);
            // dd($planningAcc);
            return $this->render('operational_task/initiativeAccomplishment.html.twig', [
                'operatioanlSuitables' => $operatioanlSuitables,
                'operatioanlSuitablessocails' => $operatioanlSuitablessocails,
                'initiativeName' => $initiativeName,
                'planningAcc' => $planningAcc,
                'remainingdays' => $remainingdays,
                'social' => 1,

            ]);
        } else {
            $operatioanlSuitables = $operationalSuitableInitiativeRepository->findplan($principalOffice, $suitableInitiative->getId());
            $planningAcc = $em->getRepository(PlanningAccomplishment::class)->findBy(['suitableInitiative' => $suitableInitiative->getId()]);
            // dd($planningAcc);
            // dd($operatioanlSuitables);
            return $this->render('operational_task/initiativeAccomplishment.html.twig', [
                'operatioanlSuitables' => $operatioanlSuitables,
                'initiativeName' => $initiativeName,
                'remainingdays' => $remainingdays,
                'planningAcc' => $planningAcc,
                'social' => 0,
            ]);
        }
    }
    /**
     * @Route("/user_fetch", name="user_fetch")
     */
    public function OperationalFetch(Request $request, PerformerRepository $performerRepository, OperationalManagerRepository $operationalManagerRepository)
    {
        if ($office = $request->request->get('isCore')) {
            $units = $operationalManagerRepository->findAllsUser($request->request->get('userprincipal'));
        } else {
            $units = $performerRepository->findAllsUser($request->request->get('userprincipal'));
        }
        // dd($units);
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
        // dd($request->request->get('isCore'));
        if ($request->request->get('isCore')) {

            $units = $performerTaskRepository->filterDeliverByIsCore($request->request->get('task'), $user, $request->request->get('quartertask'));
        } else {
            $units = $performerTaskRepository->filterDeliverBy($request->request->get('task'), $user, $request->request->get('quartertask'));
        }
        // dd($units);

        return new JsonResponse($units);
    }

    /**
     * @Route("/show", name="operational_task_show")
     */
    public function show(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
            // dd($delegatedUser->getDelegatedtaskUserUser());
        }
        $taskAssigns = $taskAssignRepository->findTaskUsersList($user);
        return $this->render('operational_task/show.html.twig', [
            'taskAssigns' => $taskAssigns,
            'principal' => false
        ]);
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
     * @Route("/show_detail", name="operational_task_show_detail")
     */
    public function showDetail(Request $request, TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();
         
            $principal = $request->request->get('principal');

        if ($request->request->get('accompValue')) {
            $principal = $request->request->get('principal');
            $percent = 0;
            $reportValue = $request->request->get('reportValue');
            $accompValue = $request->request->get('accompValue');
            // dd($accompValue);
            $reportValueSocial = $request->request->get('reportValueSocial');
            $accompValueSocial = $request->request->get('accompValueSocial');
            $quality = $request->request->get('quality');
            $ids = $request->request->get('taskAccomplishmentId');
            //   foreach ($ids as $key => $value) {
            $evaluation = new Evaluation();
            $taskAccomplishment = $taskAccomplishmentRepository->find($ids);
            $percent = (($accompValue * 100) / $taskAccomplishment->getExpectedValue());
            $evaluateUser = $taskAccomplishment->getTaskAssign()->getAssignedTo();
            $taskAccomplishment->setAccomplishmentValue($accompValue);
            $taskAccomplishment->setReportedValue($reportValue);
            if ($reportValueSocial) {
                $taskAccomplishment->setAccomplishmentValueSocial($accompValueSocial);
                $taskAccomplishment->setReportedValueSocial($reportValueSocial);
            }
            $evaluation->setEvaluateUser($evaluateUser);
            $evaluation->setTaskAccomplishment($taskAccomplishment);
            $evaluation->setQuantity($percent);
            $evaluation->setQuality($quality);
            $taskUser = $taskAssignRepository->findOneBy(['id' => $taskAccomplishment->getTaskAssign()->getId()]);
            $taskUser->setType(3);
            $em->persist($evaluation);
            //   }
            $em->flush();
            $this->addFlash('success', 'Successfully Operational Manager set Acomplisment value  !');
            if($principal){
           return $this->redirectToRoute('operational_task_principal_show');
            }   
            else{
           return $this->redirectToRoute('operational_task_show');

            }
        }
            // dd($principal);
        $taskAssign = $request->request->get('taskAssign');
        //    dd($taskAssign);
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskAssign' => $taskAssign]);
        $taskAssigns = $taskAssignRepository->findBy(['id' => $taskAssign]);
        foreach ($taskAssigns as $value) {
            $endDate = $value->getEndDate();
            $endDates = explode('/', $endDate);
            $date = new DateTime();
        }
        $task = $taskAssignRepository->find($taskAssign);
        // dd($task);
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
            'principal'=>$principal
        ]);
    }

    // /**
    //  * @Route("/approve", name="task_operarional_approve")
    //  */
    // public function approve(Request $request, PlanRepository $planRepository, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $taskId = $request->request->get('taskUserId');
    //     $taskUser = $taskUserRepository->find($taskId);
    //     $planId = $taskUser->getTaskAssign()->getPerformerTask()->getPlan()->getId();
    //     $plans = $planRepository->find($planId);
    //     $plans->setStatus(3);

    //     $em->flush();
    //     $this->addFlash('success', 'Approved Successfully !');
    //     $taskUser = $request->request->get('taskUser');
    //     //  dd($taskUser);
    //     $taskUserId = 0;
    //     $taskUsers = $taskUserRepository->findPerformerTask($taskUser);
    //     foreach ($taskUsers as  $value) {
    //         $taskUserId = $value->getId();
    //     }
    //     $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskUser' => $taskUserId]);


    //     return $this->render('operational_task/show.html.twig', [
    //         'taskAccomplishments' => $taskAccomplishments,
    //         'taskUsers' => $taskUsers,
    //     ]);
    //     // return new JsonResponse($taskUser);

    // }
    /**
     * @Route("/{id}/edit", name="operational_task_edit", methods={"GET","POST"})
     */
}
