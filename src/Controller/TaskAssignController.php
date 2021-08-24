<?php

namespace App\Controller;

use App\Helper\DomPrint;
use App\Entity\Delegation;
use App\Entity\Evaluation;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\StaffEvaluationBehaviorCriteria;
use App\Entity\TaskAccomplishment;
use App\Entity\TaskAssign;
use App\Entity\TaskUser;
use App\Entity\UserInfo;
use App\Form\TaskAssignType;
use App\Helper\AmharicHelper;
use App\Helper\EmailHelper;
use App\Repository\OperationalTaskRepository;
use App\Repository\PerformerTaskRepository;
use App\Repository\PlanningAccomplishmentRepository;
use App\Repository\PlanRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\TaskUserRepository;
use App\Repository\UserInfoRepository;
use App\Repository\UserRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/task/assign")
 */
class TaskAssignController extends AbstractController
{

    //   private $params;
    //     // private $approverRepository;
    //     private $logger;
    //     private $mailer;
    //     public function __construct(ContainerBagInterface $params, MailerInterface $mailer, LoggerInterface $logger)
    //     {
    //         // $this->approverRepository = $approverRepository;
    //         $this->logger = $logger;
    //         $this->mailer = $mailer;
    //         $this->params = $params;
    //     }
    //     /**
    //      * @Route("/mail", name="test_mail")
    //      */
    //     public function mail(Request $request, $performer, $formData, $message, $url)
    //     {

    //         $data = array();
    //         // dd($approver);
    //         array_push($data, ['name' => $formData->getName()]);
    //         array_push($data, ['weight' => $formData->getWeight()]);
    //         // array_push($data, ['domainName' => $formData->getDomainName()]);
    // // dd($this->params->get('app.sender_email'));
    //         $maillermessage = (new TemplatedEmail())
    //             ->from($this->params->get('app.sender_email'))
    //             ->to($performer->getUserInfo()->getEmail())
    //             ->subject('Time for Mis Mailer!')
    //             ->text('Sending emails is fun again!')
    //             ->htmlTemplate(
    //                 'page/mail.html.twig'
    //             )->context([
    //                 'taskName' => $formData->getName(),
    //                 'taskWeight' => $formData->getWeight(),
    //                 // 'domainName' => $formData->getDomainName(),
    //                 'message' => $message,
    //                 'url' => $url
    //             ]);

    //         $state = $this->mailer->send($maillermessage);

    //         // return dd($state);

    //         $this->logger->info('email sent' . $this->getUser()->getUserInfo()->getEmail());
    //         // $this->addFlash('success', 'Email sent');

    //         return $this->redirectToRoute('task_assign_new');
    //     }


    /**
     * @Route("/", name="task_assign_index", methods={"GET"})
     */
    public function index(TaskAssignRepository $taskAssignRepository): Response
    {
        return $this->render('task_assign/index.html.twig', [
            'task_assigns' => $taskAssignRepository->findAll(),
        ]);
    }
    /**
     * @Route("/pdf", name="task_assign_pdf")
     */
    public function taskPdf(Request $request, DomPrint $domPrint, TaskUserRepository $taskUserRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $taskUserId = $request->request->get("user");
        // dd($taskUserId);
        $fullName = "";
        $quarter = "";
        $principalOffice = "";
        $operationalOffice = "";
        $operationalManager = "";
        $currentYear = "";


        $taskUsers = $taskUserRepository->findBy(['assignedTo' => $taskUserId, 'status' => 0]);

        foreach ($taskUsers as $taskUser) {
            $fullName = $taskUser->getAssignedTo()->getUserInfo()->getFullName();
            $quarter = $taskUser->getTaskAssign()->getPerformerTask()->getQuarter()->getName();
            $principalOffice = $taskUser->getTaskAssign()->getPerformerTask()->getOperationalOffice()->getPrincipalOffice()->getName();
            $operationalOffice = $taskUser->getTaskAssign()->getPerformerTask()->getOperationalOffice()->getName();
            $operationalManager = $taskUser->getTaskAssign()->getAssignedBy()->getUserInfo()->getFullName();
        }
        // $fullName=$taskUsers->getAssignedTo()->getUserInfo()->getFullName();
        // $quarter=$taskUser->getTaskAssign()->getPerformerTask()->getQuarter()->getName();
        $currentYear = AmharicHelper::getCurrentYear();
        foreach ($taskUsers as $value) {
            $value->setStatus(5);
        }
        $em->flush();
        //  $evaluations=$em->getRepository(Evaluation::class)->findEvaluationTasks($userId,$quarter,$year);
        $domPrint->print('task_assign/taskAssign_print.html.twig', [
            'taskUsers' => $taskUsers,
            'date' => (new \DateTime())->format('y-m-d'),
            'fullName' => $fullName,
            'quarter' => $quarter,
            'currentYear' => $currentYear,
            'operationalOffice' => $operationalOffice,
            'principalOffice' => $principalOffice,
            'operationalManager' => $operationalManager,


        ], 'Task Assign Form', 'landscape');
    }
    /**
     * @Route("/evaluation", name="evaluation")
     */
    public function evaluation(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $staffCriterias = $em->getRepository(StaffEvaluationBehaviorCriteria::class)->findAll();
        $form = $this->createFormBuilder()
            ->add(
                'name',
                EntityType::class,
                [
                    'class' => UserInfo::class,
                    'required' => true
                ]
            )
            ->add('quarter', EntityType::class, [
                'class' => PlanningQuarter::class,
                'required' => true

            ])->add('year', EntityType::class, [
                'class' => PlanningYear::class,
                'required' => true

            ])
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userId = $form->getData()['name']->getUser()->getId();
            $quarter = $form->getData()['quarter']->getId();
            $year = $form->getData()['year']->getId();
            $evaluations = $em->getRepository(Evaluation::class)->findEvaluationTasks($userId, $quarter, $year);
            //   dd($taskAssigns);
            return $this->render('task_assign/evaluation.html.twig', [
                'form' => $form->createView(),
                'evaluations' => $evaluations,
                'staffCriterias' => $staffCriterias,
                'visible' => 1,
                'userId' => $userId,
                'year' => $year,
                'quarter' => $quarter,
            ]);
        }
        if ($request->request->get("evaluattonValues")) {
            $sum = 0;
            $count = 0;
            $average = 0;
            $userId = $request->request->get("userId");
            $quarter = $request->request->get("quarter");
            $year = $request->request->get("year");
            $evaluattonValues = $request->request->get("evaluattonValues");
            $values = $request->request->get("values");
            foreach ($evaluattonValues as $key => $value) {
                $count++;
                $sum = $sum + $values[$key];
            }
            $evaluations = $em->getRepository(Evaluation::class)->findEvaluatinCriteia($userId, $quarter, $year);
            foreach ($evaluations as $value) {
                $value->setBehavior($sum);
            }
            $em->flush();
            $evaluations = $em->getRepository(Evaluation::class)->findEvaluationTasks($userId, $quarter, $year);
            //   dd($taskAssigns);
            return $this->render('task_assign/evaluation.html.twig', [
                'form' => $form->createView(),
                'evaluations' => $evaluations,
                'staffCriterias' => $staffCriterias,
                'visible' => 1,
                'userId' => $userId,
                'year' => $year,
                'quarter' => $quarter,
            ]);
        }
        if ($request->request->get("quarter")) {
            $userId = $request->request->get("userId");
            $fullName = $em->getRepository(UserInfo::class)->findOneBy(['user' => $userId]);
            $fullName = $fullName->getFullName();
            $quarter = $request->request->get("quarter");
            $year = $request->request->get("year");
            $evaluations = $em->getRepository(Evaluation::class)->findEvaluationTasks($userId, $quarter, $year);
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Courier');
            $pdfOptions->set('isRemoteEnabled', true);
            $dompdf = new Dompdf($pdfOptions);
            $res = $this->renderView('task_assign/print.html.twig', [
                'evaluations' => $evaluations,
                'date' => (new \DateTime())->format('y-m-d'),
                'fullName' => $fullName

            ]);

            $dompdf->loadHtml($res);
            $dompdf->setPaper('A5', 'Landscape');

            // Render the HTML as PDF
            $dompdf->render();
            $dompdf->stream("Evaluation.pdf", [
                "Attachment" => false
            ]);
            //  dd($evaluations);
        }

        return $this->render(
            'task_assign/evaluation.html.twig',
            [
                'form' => $form->createView(),
                'visible' => 0,
                'staffCriterias' => $staffCriterias,

            ]

        );
    }

    /**
     * @Route("/new", name="task_assign_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $taskAssign = new TaskAssign();
        $form = $this->createForm(TaskAssignType::class, $taskAssign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taskAssign);
            $entityManager->flush();

            return $this->redirectToRoute('task_assign_index');
        }

        return $this->render('task_assign/new.html.twig', [
            'task_assign' => $taskAssign,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/taskAssign", name="task_assign")
     */
    public function performerFetch(
        Request $request,
        PlanningAccomplishmentRepository $planningAccomplishmentRepository,
        UserRepository $userRepository,
        PerformerTaskRepository $performerTaskRepository,
        TaskMeasurementRepository $taskMeasurementRepository
    ) {
        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();

        $delegatedUser = $em->getRepository(Delegation::class)->findOneBy(["delegatedUser" => $user, 'status' => 1]);
        if ($delegatedUser) {
            $delegatedBy = $delegatedUser->getDelegatedBy();
            $user = $delegatedBy;
        }
        $status = 0;
        $initibativeId = 0;
        $users = $request->request->get('user');
        $tasks = $request->request->get('task');
        $tasksss = $request->request->get('task');
        $measurementids = $request->request->get('measurementId');
        $expectedValueSocial = $request->request->get('expectedValueSocial');
        $expectedValue = $request->request->get('expectedValue');
        $startDate = $request->request->get('startDate');
        $endDate = $request->request->get('endDate');

        // dd($startDate,$endDate);
        $timeGap = $request->request->get('timeGap');
        $measurementDescriptions = $request->request->get("measurementDescription");

        foreach ($tasks as $key => $value) {
            $taskAssign = new TaskAssign();

            $task = $tasksss[$key];
            $taskId = $performerTaskRepository->find($task);
            $initibativeId = $taskId->getPlanAcomplishment()->getSuitableInitiative()->getId();
            $planId = $taskId->getPlanAcomplishment();
            $taskAssign->setPerformerTask($taskId);
            if ($startDate > $endDate) {
                $this->addFlash('danger', 'Start Date must be less than from End Date !');
                return $this->redirectToRoute('operational_task_index', ['id' => $initibativeId]);
            }
            if ($timeGap > 6) {
                $this->addFlash('danger', 'Contengency Date be less than 7 !');
                return $this->redirectToRoute('operational_task_index', ['id' => $initibativeId]);
                // dd(1);
                # code...
            }
            $taskAssign->setAssignedAt(new \DateTime());
            $taskAssign->setAssignedBy($user);
            if ($delegatedUser) {
                $taskAssign->setDelegate($delegatedUser->getDelegatedUser());
            }
            $taskAssign->setType(1);
            $taskAssign->setStartDate($startDate);
            $taskAssign->setEndDate($endDate);
            $taskAssign->setTimeGap($timeGap);
            //    dd($expectedValues[$key]);
            $taskAssign->setExpectedValue($expectedValue);
            if ($expectedValueSocial) {
                # code...

                $taskAssign->setExpectedValueSocial($expectedValueSocial);
            }
            $taskAssign->setStatus(1);
            $em->persist($taskAssign);
            $em->flush();
            foreach ($users as $key => $valuet) {
                $taskUser = new TaskUser();
                $userId = $userRepository->find($valuet);
                //    dd($userId);
                $taskUser->setAssignedTo($userId);
                $taskUser->setTaskAssign($taskAssign);
                $taskUser->setStatus(0);
                $taskUser->setType(1);

                $em->persist($taskUser);
                // $this->mail(
                //     $request,
                //     $userId,
                //     $taskId,
                //     "your Assigend to performer this Task " . $userId->getUserInfo(),
                //     '10.140.10.19'
                // );
                $em->flush();


                foreach ($measurementids as  $key => $valuea) {
                    $taskAccoplishment = new TaskAccomplishment();
                    $measurementid = $measurementids[$key];
                    // $measurementDescription = $measurementDescriptions[$key];
                    $taskmeasurementId = $taskMeasurementRepository->find($valuea);
                    $taskAccoplishment->setTaskUser($taskUser);
                    $taskAccoplishment->setMeasurement($taskmeasurementId);
                    $taskAccoplishment->setExpectedValue($expectedValue);
                    if ($expectedValueSocial) {
                        $taskAccoplishment->setExpectedValueSocial($expectedValueSocial);
                    }
                    $taskAccoplishment->setMeasureDescription($measurementDescriptions);
                    $em->persist($taskAccoplishment);
                    $em->flush();
                }

                $em->persist($taskAssign);
                $em->flush();
            }
            $em->persist($taskAssign);

            $em->flush();
        }
        $em->flush();
        $planId = $planningAccomplishmentRepository->find($planId);
        if ($planId->getStatus() < 2) {
            $planId->setStatus(2);
            $em->flush();
        }
        // $aproverlist = $this->approverRepository->findAll();
        // return dd($aproverlist);

        // foreach ($aproverlist as $list) {

        //     if ($list->getRole() != 'dns') {
        //         // dump($list);

        //         $this->mail($request, $list->getApprover()->getEmail(), $res, "Task Assined By " . $this->getUser()->getUserInfo()->getFullName(), '10.140.10.19');
        //     }
        //     // dump($list);

        //     // $this->mail($request, 'lemi.diriba@ju.edu.et', $res, "Serever Request by " . $this->getUser()->getUserInfo()->getFullName(), 'sms.ju.edu.et');
        // }



        $this->addFlash('success', 'Task Assignd successfully !');
        return $this->redirectToRoute('operational_task_index', ['id' => $initibativeId]);
    }
    /**
     * @Route("/{id}", name="task_assign_show", methods={"GET"})
     */
    public function show(TaskAssign $taskAssign): Response
    {
        return $this->render('task_assign/show.html.twig', [
            'task_assign' => $taskAssign,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="task_assign_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TaskAssign $taskAssign): Response
    {
        $form = $this->createForm(TaskAssignType::class, $taskAssign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_assign_index');
        }

        return $this->render('task_assign/edit.html.twig', [
            'task_assign' => $taskAssign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_assign_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TaskAssign $taskAssign): Response
    {
        if ($this->isCsrfTokenValid('delete' . $taskAssign->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($taskAssign);
            $entityManager->flush();
        }

        return $this->redirectToRoute('task_assign_index');
    }
}
