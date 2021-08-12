<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Entity\OperationalOffice;
use App\Entity\OperationalTask;
use App\Entity\PerformerTask;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\TaskAccomplishment;
use App\Entity\TaskMeasurement;
use App\Entity\TaskUser;
use App\Entity\UserInfo;
use App\Form\PerformerTaskType;
use App\Form\TaskMeasurementType;
use App\Repository\PerformerTaskRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\TaskUserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performertask")
 */
class PerformerTaskController extends AbstractController
{
    /**
     * @Route("/", name="performer_task_index")
     */
    public function index(Request $request, TaskUserRepository $taskUserRepository, TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("taskUserId")) {
            $taskUserId = $request->request->get("taskUserId");
            $reason = $request->request->get("reason");
            $taskUsers = $taskUserRepository->find($taskUserId);
            $taskUsers->setStatus(6);
            $taskUsers->setRejectReason($reason);
            $em->flush();
            $this->addFlash('success', 'Task Reject successfully !');
            return $this->redirectToRoute('performer_task_index');
        }
        $taskUsers = $taskUserRepository->findPerformerTaskUsers($this->getUser());

        return $this->render('performer_task/index.html.twig', [
            'taskUsers' => $taskUsers,
            // 'count'=>$count,

        ]);
    }

    /**
     * @Route("/list", name="performer_task_list")
     */
    public function list(Request $request, TaskUserRepository $taskUserRepository, TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository)
    {

        $taskUsers = $taskUserRepository->findBy(['assignedTo' => $this->getUser(), 'status' => 5]);
        //  /   dd($taskUsers);

        return $this->render('performer_task/list.html.twig', [
            'performer_tasks' => $taskUsers,
            // 'count'=>$count,

        ]);
    }

    /**
     * @Route("/report", name="performer_task_report")
     */
    public function report(Request $request, TaskAccomplishmentRepository $taskAccomplishmentRepository, PaginatorInterface $paginator)
    {
        $filterForm = $this->createFormBuilder()
            // ->setMethod('Get')
            ->add("performerName", EntityType::class, [
                'class' => UserInfo::class, 'placeholder' => 'All', 'required' => false,
            ])
            ->add("taskName", EntityType::class, [
                'class' => PerformerTask::class, 'placeholder' => 'All',
                'required' => false,
            ])

            ->add('initiative', EntityType::class, [
                'class' => Initiative::class,  'required' => false, 'placeholder' => 'All',
            ])
            ->add("quarter", EntityType::class, [
                'class' => PlanningQuarter::class,
                'placeholder' => 'All',
                'required' => false,

            ])
            ->add("planningYear", EntityType::class, [
                'class' => PlanningYear::class,
                'placeholder' => 'All',
                'required' => false,

            ])->getForm();
        $filterForm->handleRequest($request);
        if ($filterForm->isSubmitted() && $filterForm->isValid()) {

            $performerTasks = $taskAccomplishmentRepository->search($filterForm->getData());
            // dd($performerTasks->getResult());
        } else {
            $performerTasks = $taskAccomplishmentRepository->search();
        }
        $data = $paginator->paginate(
            $performerTasks,
            $request->query->getInt('page', 1),
            10

        );
        return $this->render('performer_task/report.html.twig', [
            'performer_tasks_acomplishs' => $data,
            'filterform' => $filterForm->createView()

        ]);
    }

    /**
     * @Route("/new", name="performer_task_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performerTask);
            $entityManager->flush();

            return $this->redirectToRoute('performer_task_index');
        }

        return $this->render('performer_task/new.html.twig', [
            'performer_task' => $performerTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show", name="performer_task_show", methods={"GET","POST"})
     */
    public function show(Request $request, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $narativeForm = $this->createFormBuilder()
            ->add('narrative', FileType::class, array(
                'attr' => array(
                    'id' => 'filePhoto',
                    // 'class' => 'sr-only',
                    //  'accept' => 'image/jpeg,image/png,image/jpg'
                ),
                'label' => '',


            ))
            ->getForm();


        $narativeForm->handleRequest($request);

        if ($narativeForm->isSubmitted() && $narativeForm->isValid()) {
            $taskPerformId = $request->request->get("id");
            $taskAc = $taskAccomplishmentRepository->findOneBy(['taskUser' => $taskPerformId]);
            $taskUsers = $taskUserRepository->find($request->request->get('id'));
            $taskUsers->setStatus(4);
            $em = $this->getDoctrine()->getManager();
            $uploadedFile = $narativeForm['narrative']->getData();
            // dd($uploadedFile);

            $destination = $this->getParameter('kernel.project_dir') . '/public/narrative';
            $newFilename = $taskAc->getId() . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($destination, $newFilename);
            //   dd($newFilename);
            //$user=$this->getUser()->getUserInfo();
            $taskUsers->setNarrative($newFilename);
            $em->flush();
            $this->addFlash("tsuccess", "Narrative Report Successfully uploaded !!");
            return $this->redirectToRoute('performer_task_index');
        }
        if ($taskAcoompId = $request->request->get('taskAcoompId')) {
            $editedReportValue = $request->request->get('editedReportValue');
            $taskAcoompId = $request->request->get('taskAcoompId');

            $taskAccomplishment = $taskAccomplishmentRepository->find($taskAcoompId);
            $taskAccomplishment->setReportedValue($editedReportValue);
            // $taskUser=$taskUserRepository->findOneBy(['id'=>$taskAccomplishment->getTaskUser()->getId()]);
            // $taskUser->setStatus(2);

            $em->flush();
            $this->addFlash('success', 'Reported Value Edited Successfully !');
            return $this->redirectToRoute('performer_task_index');
        }
        if ($report = $request->request->get('reportValue')) {
            $reportValue = $request->request->get('reportValue');
            $reportValueSocial = $request->request->get('reportValueSocial');
            $id = $request->request->get('taskAccomplishmentId');
            $taskAccomplishment = $taskAccomplishmentRepository->find($id);
            $taskAccomplishment->setReportedValue($reportValue);
            if ($reportValue) {

                $taskAccomplishment->setReportedValueSocial($reportValueSocial);
            }
            $taskUser = $taskUserRepository->findOneBy(['id' => $taskAccomplishment->getTaskUser()->getId()]);
            $taskUser->setStatus(2);

            $em->flush();
            $this->addFlash('success', 'Reported successfully !');
            return $this->redirectToRoute('performer_task_index');
        }
        if ($request->request->get('note')) {
            $note = $request->request->get('note');
            $id = $request->request->get('taskUserid');
            $taskUserno = $taskUserRepository->find($id);

            $taskUserno->setNote($note);
            $taskUserno->setStatus(3);
            $em->flush();
            $this->addFlash('success', 'thank you for responding  !');
            return $this->redirectToRoute('performer_task_index');
        }
        $taskUser = $request->request->get('taskUser');
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskUser' => $taskUser]);
        $taskUsers = $taskUserRepository->findBy(['id' => $taskUser]);
        foreach ($taskUsers as $key) {
            if ($key->getStatus() < 1) {
                $key->setStatus(1);
                $em->flush();
                $this->addFlash('success', 'Thank you for accepting your task!');
            }
        }
           $social = 0;
          
        foreach ($taskAccomplishments[0]->getTaskUser()->getTaskAssign()->getPerformerTask()->getPlanAcomplishment()->getSuitableInitiative()->getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }

        return $this->render('performer_task/show.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskUsers' => $taskUsers,
            'narativeForm' => $narativeForm->createView(),
            'social'=>$social

        ]);
    }
    /**
     * @Route("/list/show", name="performer_task_list_show", methods={"GET","POST"})
     */
    public function listShow(Request $request, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $taskUser = $request->request->get('taskUser');
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskUser' => $taskUser]);
        $taskUsers = $taskUserRepository->findBy(['id' => $taskUser]);

        return $this->render('performer_task/listShow.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskUsers' => $taskUsers,
        ]);
    }
    /**
     * @Route("/skip", name="task_narrative_skip")
     */
    public function skip(Request $request, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $taskId = $request->request->get('taskId');
        $taskUser = $taskUserRepository->find($request->request->get('taskId'));
        $taskUser->setStatus(4);
        $em->flush();
        return new JsonResponse($taskUser);
    }
    /**
     * @Route("/send", name="performer_task_send")
     */
    public function send(Request $request, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $taskId = $request->request->get('taskUserId');
        $taskUser = $taskUserRepository->find($taskId);
        $taskUser->setStatus(5);
        // $taskUser->setType(1);
        $em->flush();
        return $this->redirectToRoute('performer_task_index');
    }
    /**
     * @Route("/weight/edit", name="performer_task_value_edit")
     */
    public function performerTaskEdit(Request $request, TaskAssignRepository $taskAssignRepository, PerformerTaskRepository $performerTaskRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $pid = $request->request->get('perTaskId');
        if ($id = $request->request->get('performerId')) {
            $taskid = $request->request->get('perTaskId');
            //   dd($taskid);

            return new JsonResponse(
                [
                    'data' =>  $taskAssignRepository->findPerformerTaskEdit($taskid)
                ]
            );
        }
        if ($id = $request->request->get('performerValue')) {
            $startDate = $request->request->get('startDate');
            $endDate = $request->request->get('endDate');
            $expectedValue = $request->request->get('expectedValue');
            $id = $request->request->get('id');
            $timeGap = $request->request->get('timeGap');
            $taskAssigns = $taskAssignRepository->find($id);
            $taskUsers = $em->getRepository(TaskUser::class)->findOneBy(['taskAssign' => $id]);
            $taskAccomplishment = $em->getRepository(TaskAccomplishment::class)->findOneBy(['taskUser' => $taskUsers->getId()]);
            $taskAssigns->setStartDate($startDate);
            $taskAssigns->setEndDate($endDate);
            $taskAssigns->setTimeGap($timeGap);
            $taskAssigns->setExpectedValue($expectedValue);
            $taskUsers->setStatus(0);
            $taskUsers->setRejectReason(null);
            $taskAccomplishment->setExpectedValue($expectedValue);
            $em->flush();

            $this->addFlash('success', 'Performer Task Updated and Resendsuccessfully !');

            return $this->redirectToRoute('operational_task_index', ['id' => $taskAssigns->getPerformerTask()->getPlanAcomplishment()->getSuitableInitiative()->getId()]);
        }
        if ($id = $request->request->get('id')) {
            $weight = $request->request->get('weight');
            $countWeight = $request->request->get('countWeight');
            $performerTask = $performerTaskRepository->find($id);
            //   dd(( 100-$countWeight)+$weight);
            if (((100 - $countWeight) + $weight)  > 100) {
                $this->addFlash('danger', 'Weight must be less than 100 !');
                return $this->redirectToRoute('operational_task_index', ['id' => $performerTask->getPlanAcomplishment()->getSuitableInitiative()->getId()]);
            }

            $performerTask->setWeight($weight);
            $em->flush();
            $this->addFlash('success', 'Weight Updated successfully !');

            return $this->redirectToRoute('operational_task_index', ['id' => $performerTask->getPlanAcomplishment()->getSuitableInitiative()->getId()]);
        }
        // $id = $request->request->get('consumableGroupId');
        return new JsonResponse($performerTaskRepository->findPerformerTaskEdit($pid));
    }


    /**
     * @Route("/{id}/edit", name="performer_task_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PerformerTask $performerTask): Response
    {
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performer_task_index');
        }

        return $this->render('performer_task/edit.html.twig', [
            'performer_task' => $performerTask,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performer_task_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PerformerTask $performerTask): Response
    {
        if ($this->isCsrfTokenValid('delete' . $performerTask->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performerTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performer_task_index');
    }
}
