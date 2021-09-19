<?php

namespace App\Controller;


use App\Entity\OperationalTask;
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
use App\Repository\TaskUserRepository;
use App\Repository\UserInfoRepository;
use DateTime;
use Andegna\DateTime as AD;
use Andegna\DateTimeFactory;
use App\Entity\Delegation;
use App\Entity\Evaluation;
use App\Entity\Initiative;
use App\Entity\OperationalSuitableInitiative;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\SmisSetting;
use App\Entity\TaskUser;
use App\Entity\User;
use App\Helper\AmharicHelper;
use App\Repository\OperationalSuitableInitiativeRepository;
use App\Repository\PlanningQuarterRepository;
use App\Repository\PrincipalManagerRepository;
use Doctrine\ORM\EntityManager;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\InitiativeAttribute;
use Proxies\__CG__\App\Entity\PlanningQuarter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational/task")
 */
class OperationalTaskController extends AbstractController
{

    /**
     * @Route("/index/{id}", name="operational_task_index")
     */
    public function index(Request $request, SuitableInitiative $suitableInitiative, PlanningQuarterRepository $planningQuarterRepository, TaskUserRepository $taskUserRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository,  PerformerTaskRepository $performerTaskRepository): Response
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
        foreach ($suitableInitiative->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }

        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        $count = 0;
        $maxcount = 0;
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($user, $suitableInitiative);
        $taskUsers = $taskUserRepository->findTaskUsers($user);

        foreach ($operationalTasks as $operationals) {
            $count = $count +
                $operationals->getWeight();
            $maxcount++;
        }
        $time = new DateTime('now');
        $quarterId = 0;
        $quarterName = 0;
        $quarters = $planningQuarterRepository->findAll();
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
        //    dd($minDate,$maxDate,$quarterId,$quarterName);
        $maxContengencyTimes = $em->getRepository(SmisSetting::class)->findOneBy(['code' => 1]);
        $maxTasks = $em->getRepository(SmisSetting::class)->findOneBy(['code' => 2]);
        $maxTask = $maxTasks->getValue();
        $maxContengencyTime = $maxContengencyTimes->getValue();
        if ($form->isSubmitted() && $form->isValid()) {
            if ($social == 1) {
                $plans = $planningAccomplishmentRepository->findBy(['suitableInitiative' => $suitableInitiative, 'quarter' => $quarterId]);
            } else {
                $plans = $planningAccomplishmentRepository->findBy(['suitableInitiative' => $suitableInitiative, 'quarter' => $quarterId]);
            }

            if (!$plans) {
                $this->addFlash('danger', 'Plan Not Set for this Initiative');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableInitiative->getId()]);
            }
            // dd($plans);
            $performerTask->setPlanAcomplishment($plans[0]);
            if ($social == 1) {

                $performerTask->setPlanAccomplishmentSocial($plans[1]);
            }
            $performerTask->setStatus(1);
            // dump($value);

            if ($delegatedUser) {
                $delegatedBy = $delegatedUser->getDelegatedUser();
                $performerTask->setDeligateBy($delegatedBy);
            }
            $performerTask->setQuarter($planningQuarterRepository->find($quarterId));
            foreach ($user->getOperationalManagers() as $op) {
                $opOff = $op->getOperationalOffice();
            }

            // dd($maxcount);
            if ($maxcount > $maxTask) {
                $this->addFlash('danger', 'Task must be less than 7 !');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableInitiative->getId()]);
            }
            $performerTask->setOperationalOffice($opOff);
            $performerTask->setCreatedBy($user);
            $weight = $form->getData()->getWeight();
            if ($count + $weight > 100) {
                $this->addFlash('danger', 'Weight must be less than 100 !');
                return $this->redirectToRoute('operational_task_index', ['id' => $suitableInitiative->getId()]);
            }

            $em->persist($performerTask);
            $em->flush();
            $this->addFlash('success', ' Task Created Successfully!');

            return $this->redirectToRoute('operational_task_index', ['id' => $suitableInitiative->getId()]);
        }
        $count = 0;

        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($user, $suitableInitiative);
        foreach ($operationalTasks as $operationals) {
            $count = $count +
                $operationals->getWeight();
        }
        $maxContengencyTimes = $em->getRepository(SmisSetting::class)->findOneBy(['code' => 1]);
        $maxContengencyTime = $maxContengencyTimes->getValue();
        //   dd($maxContengencyTime);
        return $this->render('operational_task/index.html.twig', [
            'performerTasks' => $performerTaskRepository->findPerformerInitiativeTask($user, $suitableInitiative),
            'countWeight' => $count,
            'quarterName' => $quarterName,
            'taskUsers' => $taskUsers,
            'form' => $form->createView(),
            'maxDate' => $maxDate,
            'maxContengencyTime' => $maxContengencyTime,
            'minDate' => $minDate,
            'minDateEdit' => $minDateEdit,
            'measurements' => $em->getRepository(TaskMeasurement::class)->findAll(),
            'social' => $social,
            'formtask' => $formtask->createView(),
            'initiativeName' => $suitableInitiative->getInitiative()->getName(),



        ]);
    }

    /**
     * @Route("/suitableInitiative/list", name="suitable_initiative_list")
     */
    public function suitableInitiative(Request $request, PaginatorInterface $paginator, OperationalManagerRepository $operationalManagerRepository, SuitableInitiativeRepository $suitableInitiativeRepository, TaskMeasurementRepository $taskMeasurementRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
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
        $currentYear = AmharicHelper::getCurrentYear();
        // dd($currentYear);
        $operation = $operationalManagerRepository->findOneBy(['manager' => $user]);
        $principlaOffice =  $operation->getOperationalOffice()->getPrincipalOffice()->getId();
        $currentQuarter = AmharicHelper::getCurrentQuarter($em);
        // dd($currentYear);

        // dd($currentQuarter);
        if ($currentQuarter == 1) {
            $currentYear=$currentYear+1;
        }
        // dd($currentYear);
        $suitableInitiatives = $suitableInitiativeRepository->findSuitableInitiatve($principlaOffice, $currentYear);
        
        $data = $paginator->paginate(
            $suitableInitiatives,
            $request->query->getInt('page', 1),
            10

        );
        return $this->render('operational_task/suitableInitiative.html.twig', [
            'suitableInitiatives' => $data,
            'count' => $suitableInitiatives,
           
        ]);
    }


    /**
     * @Route("/principal/report", name="principal_office_report", methods={"GET","POST"})
     */
    public function report(SuitableInitiativeRepository $suitableInitiativeRepository, Request $request): Response
    {
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
    public function accomplishment(Request $request, PlanningQuarterRepository $planningQuarterRepository, PerformerTaskRepository $performerTaskRepository, SuitableInitiative $suitableInitiative, TaskUserRepository $taskUserRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
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

        foreach ($suitableInitiative->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }

        $initiativeName = $suitableInitiative->getInitiative()->getName();
        $initiativeId = $suitableInitiative->getId();
        $performerTasks = $em->getRepository(PerformerTask::class)->findInitiativeBySocial($suitableInitiative, $user);
        $taskAcomolishs = $taskAccomplishmentRepository->findDetailAccomplishSocial($suitableInitiative, $user);
        // $performerTasksSocial = $em->getRepository(PerformerTask::class)->findInitiativeBySocial($suitableInitiative, $user, $female);
        // $taskAcomolishsSocial = $taskAccomplishmentRepository->findDetailAccomplishSocial($suitableInitiative, $user, $female);


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
        // dd($performerTasksmale);
        return $this->render('operational_task/accomplishmentDetail.html.twig', [
            'taskAcomolishs' => $taskAcomolishs,
            'initiativeName' => $initiativeName,
            'initiativeId' => $initiativeId,
            'performerTasks' => $performerTasks,
            'social' => $social,
            'remainingdays' => $remainingdays,
            // 'taskUsers'=>$taskUsers

        ]);
    }


    /**
     * @Route("/send/principal", name="send_to_principal")
     */
    public function sendToPrincipal(Request $request, OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository, PlanningQuarterRepository $planningQuarterRepository, OperationalManagerRepository $operationalManagerRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, PerformerTaskRepository $performerTaskRepository)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("planOffice")) {
            $planAcomplismentId = $request->request->get("planId");
            //   $planAcomplismentIdSocial=$request->request->get("planIdSocial");
            $social = $request->request->get("social");
            $acompAverages = $request->request->get("acompAvareage");

            $quarter = $request->request->get("quarter");
            // dd($acompAverages,$planAcomplismentId);

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

                    $planAcomplishments = $planningAccomplishmentRepository->find($planAcomplismentId[$key]);
                    $planAcomplishments->setAccompValue($value);
                }

                $em->flush();
            } else {
                $operationalSuitables = $operationalSuitableInitiativeRepository->findBy(['PlanningAcomplishment' => $planAcomplismentId[0]]);
                foreach ($operationalSuitables as $value) {
                    $value->setStatus(2);
                }


                $planAcomplishments = $planningAccomplishmentRepository->find($planAcomplismentId[0]);
                $planAcomplishments->setAccompValue($acompAverages[0]);
                $em->flush();
            }
            $this->addFlash('success', 'Successfully Send To Plan Office !');

            return $this->redirectToRoute('principal_office_report');
        }
        $user = $this->getUser();
        $operation = $operationalManagerRepository->findOneBy(['manager' => $user]);
        $opOffice = $operation->getOperationalOffice();
        $principal = $opOffice->getPrincipalOffice();
        $accomp = $request->request->get('accomp');
        $suitiniId = $request->request->get('suitableinitiative');
        $quarterId = $request->request->get('quarterId');
        $quarter = $planningQuarterRepository->find($quarterId);
        $socialAttribute = $em->getRepository(InitiativeAttribute::class)->findAll();
        $performerTasks1 = $performerTaskRepository->findsendToprincipalSocial($user, $suitiniId);
        foreach ($performerTasks1 as $value) {
            $value->setStatus(0);
        }

        $plannings = $planningAccomplishmentRepository->findplanAccwithoutSocial($suitiniId, $principal, $quarter);
        //  $plannings1=$planningAccomplishmentRepository->findplanAcc($suitiniId,$socialAttribute2,$principal,$quarter); 
        foreach ($plannings as $key => $value) {
            # code...

            $operationalSuitableInitiative = new OperationalSuitableInitiative();
            $operationalSuitableInitiative->setPlanningAcomplishment($value);
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
     * @Route("/suitableInitiative/principal/list", name="suitable_initiative_principal_list")
     */
    public function suitableInitiativeprincipal(Request $request, OperationalManagerRepository $operationalManagerRepository, SuitableInitiativeRepository $suitableInitiativeRepository, PrincipalManagerRepository $principalManagerRepository): Response
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
     * @Route("/userFetch", name="user_fetch")
     */
    public function OperationalFetch(Request $request, PerformerRepository $performerRepository, UserInfoRepository $userInfoRepository)
    {
        $office = $request->request->get('userprincipal');
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
        $units = $performerTaskRepository->filterDeliverBy($request->request->get('task'), $user, $request->request->get('quartertask'));
        // dd($units);

        return new JsonResponse($units);
    }
    /**
     * @Route("/new", name="operational_task_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $operationalTask = new OperationalTask();
        $form = $this->createForm(OperationalTaskType::class, $operationalTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operationalTask);
            $entityManager->flush();
            return $this->redirectToRoute('operational_task_index');
        }
        return $this->render('operational_task/new.html.twig', [
            'operational_task' => $operationalTask,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/show", name="operational_task_show")
     */
    public function show(Request $request, TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskUserRepository $taskUserRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
            // dd($delegatedUser->getDelegatedtaskUserUser());
        }
        $taskUsers = $taskUserRepository->findTaskUsersList($user);
        return $this->render('operational_task/show.html.twig', [
            'taskUsers' => $taskUsers,
        ]);
    }
    /**
     * @Route("/show/detail", name="operational_task_show_detail")
     */
    public function showDetail(Request $request, StaffEvaluationBehaviorCriteriaRepository $staffEvaluationBehaviorCriteriaRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskUserRepository $taskUserRepository)
    {
        $em = $this->getDoctrine()->getManager();


        if ($request->request->get('reportValue')) {
            $percent = 0;
            $reportValue = $request->request->get('reportValue');
            $reportValueSocial = $request->request->get('reportValueSocial');
            $quality = $request->request->get('quality');
            $ids = $request->request->get('taskAccomplishmentId');
            //   foreach ($ids as $key => $value) {
            $evaluation = new Evaluation();
            $taskAccomplishment = $taskAccomplishmentRepository->find($ids);
            $percent = (($reportValue * 100) / $taskAccomplishment->getExpectedValue());
            $evaluateUser = $taskAccomplishment->getTaskUser()->getAssignedTo();
            $taskAccomplishment->setAccomplishmentValue($reportValue);
            if ($reportValueSocial) {
                $taskAccomplishment->setAccomplishmentValueSocial($reportValueSocial);
            }
            $evaluation->setEvaluateUser($evaluateUser);
            $evaluation->setTaskAccomplishment($taskAccomplishment);
            $evaluation->setQuantity($percent);
            $evaluation->setQuality($quality);
            $taskUser = $taskUserRepository->findOneBy(['id' => $taskAccomplishment->getTaskUser()->getId()]);
            $taskUser->setType(3);
            $em->persist($evaluation);
            //   }
            $em->flush();
            $this->addFlash('success', 'Successfully Operational Manager set Acomplisment value  !');
            return $this->redirectToRoute('operational_task_show');
        }
        $taskUser = $request->request->get('taskUser');
        //    dd($taskUser);
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskUser' => $taskUser]);
        $taskUsers = $taskUserRepository->findBy(['id' => $taskUser]);
        foreach ($taskUsers as $value) {
            $endDate = $value->getTaskAssign()->getEndDate();
            $endDates = explode('/', $endDate);
            $date = new DateTime();
        }
        $task = $taskUserRepository->find($taskUser);
        if ($task->getType() < 2) {
            $task->setType(2);
            $em->flush();
        }
        $social = 0;

        foreach ($taskAccomplishments[0]->getTaskUser()->getTaskAssign()->getPerformerTask()->getPlanAcomplishment()->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }

        return $this->render('operational_task/showDetail.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskUsers' => $taskUsers,
            'social' => $social
        ]);
    }

    /**
     * @Route("/approve", name="task_operarional_approve")
     */
    public function approve(Request $request, PlanRepository $planRepository, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $taskId = $request->request->get('taskUserId');
        $taskUser = $taskUserRepository->find($taskId);
        $planId = $taskUser->getTaskAssign()->getPerformerTask()->getPlan()->getId();
        $plans = $planRepository->find($planId);
        $plans->setStatus(3);

        $em->flush();
        $this->addFlash('success', 'Approved Successfully !');
        $taskUser = $request->request->get('taskUser');
        //  dd($taskUser);
        $taskUserId = 0;
        $taskUsers = $taskUserRepository->findPerformerTask($taskUser);
        foreach ($taskUsers as  $value) {
            $taskUserId = $value->getId();
        }
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskUser' => $taskUserId]);


        return $this->render('operational_task/show.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskUsers' => $taskUsers,
        ]);
        // return new JsonResponse($taskUser);

    }
    /**
     * @Route("/{id}/edit", name="operational_task_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OperationalTask $operationalTask): Response
    {
        $form = $this->createForm(OperationalTaskType::class, $operationalTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operational_task_index');
        }

        return $this->render('operational_task/edit.html.twig', [
            'operational_task' => $operationalTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OperationalTask $operationalTask): Response
    {
        if ($this->isCsrfTokenValid('delete' . $operationalTask->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationalTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operational_task_index');
    }
}
