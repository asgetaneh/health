<?php

namespace App\Controller;

use App\Helper\DomPrint;
use App\Entity\Delegation;
use App\Entity\Evaluation;
use App\Entity\PerformerTask;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\StaffEvaluationBehaviorCriteria;
use App\Entity\TaskAccomplishment;
use App\Entity\TaskAssign;
use App\Entity\TaskMeasurement;
use App\Entity\TaskUser;
use App\Entity\User;
use App\Entity\UserInfo;
use App\Form\TaskAssignType;
use App\Helper\AmharicHelper;
use App\Helper\EmailHelper;
use App\Repository\OperationalPlanningAccomplishmentRepository;
use App\Repository\OperationalTaskRepository;
use App\Repository\PerformerTaskRepository;
use App\Repository\PlanningAccomplishmentRepository;
use App\Repository\PlanRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\TaskUserRepository;
use App\Repository\UserInfoRepository;
use App\Repository\UserRepository;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @Route("/task_assign")
 */
class TaskAssignController extends AbstractController
{
    /**
     * @Route("/excel", name="excel")
     */
    public function xslx(Request $request)
    {
        $file = $request->files->get('file'); // get the file from the sent request

        $fileFolder = __DIR__ . '/../../public/';  //choose the folder in which the uploaded file will be stored
        dd($file);
        $filePathName = md5(uniqid()) . $file->getClientOriginalName();
        dd($filePathName);
        // apply md5 function to generate an unique identifier for the file and concat it with the file extension  
        try {
            $file->move($fileFolder, $filePathName);
        } catch (FileException $e) {
            dd($e);
        }
        $spreadsheet = IOFactory::load($fileFolder . $filePathName); // Here we are able to read from the excel file 
        $row = $spreadsheet->getActiveSheet()->removeRow(1); // I added this to be able to remove the first file line 
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true); // here, the read data is turned into an array
        dd($sheetData);
    }
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
    public function taskPdf(Request $request, DomPrint $domPrint, TaskAccomplishmentRepository $taskAccomplishmentRepository)
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


        $taskAccomplishments = $taskAccomplishmentRepository->findPrintTasks($taskUserId);
        // dd($taskAccomplishments);
        foreach ($taskAccomplishments as $taskAccomplishment) {

            $fullName = $taskAccomplishment->getTaskAssign()->getAssignedTo()->getUserInfo()->getFullName();
            $quarter = $taskAccomplishment->getTaskAssign()->getPerformerTask()->getQuarter()->getName();
            $principalOffice = $taskAccomplishment->getTaskAssign()->getPerformerTask()->getOperationalOffice()->getPrincipalOffice()->getName();
            $operationalOffice = $taskAccomplishment->getTaskAssign()->getPerformerTask()->getOperationalOffice()->getName();
            $operationalManager = $taskAccomplishment->getTaskAssign()->getAssignedBy()->getUserInfo()->getFullName();
        }
        // $fullName=$taskUsers->getAssignedTo()->getUserInfo()->getFullName();
        // $quarter=$taskUser->getTaskAssign()->getPerformerTask()->getQuarter()->getName();
        $currentYear = AmharicHelper::getCurrentYear();
        foreach ($taskAccomplishments as $value) {
            $taskAssign = $em->getRepository(TaskAssign::class)->find($value->getTaskAssign()->getId());
            // dd($taskAssign);
            $taskAssign->setStatus(5);
            $taskAssign->setPrint(1);
        }
        $em->flush();
        //  $evaluations=$em->getRepository(Evaluation::class)->findEvaluationTasks($userId,$quarter,$year);
        $domPrint->print('task_assign/taskAssign_print.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
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
            $dompdf->render();
            $dompdf->stream("Evaluation.pdf", [
                "Attachment" => false
            ]);
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
        PerformerTaskRepository $performerTaskRepository,
        OperationalPlanningAccomplishmentRepository $operationalPlanningAccomplishmentRepository
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
            foreach ($users as $keyu => $valueu) {

                $taskAssign = new TaskAssign();

                $task = $tasks[$key];
                $userId =  $users[$keyu];
                $taskId = $performerTaskRepository->find($task);
                $initibativeId = $taskId->getOperationalPlanningAcc()->getOperationalSuitable()->getId();
                $planId = $taskId->getOperationalPlanningAcc();
                $taskAssign->setPerformerTask($taskId);
                if ($timeGap > 6) {
                    $this->addFlash('danger', 'Contengency Date be less than 7 !');
                    return $this->redirectToRoute('operational_task_index', ['id' => $initibativeId]);
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
                $taskAssign->setStatus(0);

                $user = $em->getRepository(User::class)->find($userId);
                $taskAssign->setAssignedTo($user);
                if ($expectedValueSocial) {
                    $taskAssign->setExpectedValueSocial($expectedValueSocial);
                }
                $em->persist($taskAssign);
                foreach ($measurementids as  $keym => $valuea) {
                    $taskAccoplishment = new TaskAccomplishment();
                    $measurementid = $measurementids[$keym];
                    // $measurementDescription = $measurementDescriptions[$key];
                    $taskmeasurementId = $em->getRepository(TaskMeasurement::class)->find($valuea);
                    $taskAccoplishment->setTaskAssign($taskAssign);
                    $taskAccoplishment->setMeasurement($taskmeasurementId);
                    $taskAccoplishment->setExpectedValue($expectedValue);
                    if ($expectedValueSocial) {
                        $taskAccoplishment->setExpectedValueSocial($expectedValueSocial);
                    }
                    $taskAccoplishment->setMeasureDescription($measurementDescriptions);
                    $em->persist($taskAccoplishment);
                }


                $em->persist($taskAssign);

                $em->flush();
            }
            $em->flush();
        }
        $em->flush();
        // dd($planId);
        $planId = $operationalPlanningAccomplishmentRepository->find($planId->getId());
        // dd($planId);
        if ($planId->getStatus() < 2) {
            $planId->setStatus(2);
            $em->flush();
        }


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
