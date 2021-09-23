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
    public function index(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->request->get("taskUserId")) {
            $taskUserId = $request->request->get("taskUserId");
            $reason = $request->request->get("reason");
            $taskUsers = $taskAssignRepository->find($taskUserId);
            $taskUsers->setStatus(6);
            $taskUsers->setRejectReason($reason);
            $em->flush();
            $this->addFlash('success', 'Task Reject successfully !');
            return $this->redirectToRoute('performer_task_index');
        }
        $taskAssigns = $taskAssignRepository->findPerformerTaskUsers($this->getUser());

        return $this->render('performer_task/index.html.twig', [
            'taskAssigns' => $taskAssigns,
            // 'count'=>$count,

        ]);
    }

    /**
     * @Route("/list", name="performer_task_list")
     */
    public function list(Request $request, TaskAssignRepository $taskAssignRepository)
    {

        $taskAssigns = $taskAssignRepository->findBy(['assignedTo' => $this->getUser(), 'status' => 5]);
        //  /   dd($taskUsers);

        return $this->render('performer_task/list.html.twig', [
            'taskAssigns' => $taskAssigns,
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
    public function show(Request $request, TaskAssignRepository $taskAssignRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
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
            $taskAc = $taskAccomplishmentRepository->findOneBy(['taskAssign' => $taskPerformId]);
            $taskAssignNa = $taskAssignRepository->find($request->request->get('id'));
            $taskAssignNa->setStatus(4);
            $em = $this->getDoctrine()->getManager();
            $uploadedFile = $narativeForm['narrative']->getData();
            // dd($uploadedFile);

            $destination = $this->getParameter('kernel.project_dir') . '/public/narrative';
            $newFilename = $taskAc->getId() . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move($destination, $newFilename);
            //   dd($newFilename);
            //$user=$this->getUser()->getUserInfo();
            $taskAssignNa->setNarrative($newFilename);
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
            if ($reportValueSocial) {

                $taskAccomplishment->setReportedValueSocial($reportValueSocial);
            }
            $taskUser = $taskAssignRepository->findOneBy(['id' => $taskAccomplishment->getTaskAssign()->getId()]);
            $taskUser->setStatus(2);

            $em->flush();
            $this->addFlash('success', 'Reported successfully !');
            return $this->redirectToRoute('performer_task_index');
        }
        if ($request->request->get('challenge')) {
            $challenge = $request->request->get('challenge');
            $id = $request->request->get('taskUserid');
            $taskAssinCha = $taskAssignRepository->find($id);

            $taskAssinCha->setChallenge($challenge);
            $taskAssinCha->setStatus(3);
            $em->flush();
            $this->addFlash('success', 'thank you for responding  !');
            return $this->redirectToRoute('performer_task_index');
        }
        $taskAssign = $request->request->get('taskUser');
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskAssign' => $taskAssign]);
        $taskAssigns = $taskAssignRepository->findBy(['id' => $taskAssign]);
        foreach ($taskAssigns as $key) {
            if ($key->getStatus() < 1) {
                $key->setStatus(1);
                $em->flush();
                $this->addFlash('success', 'Thank you for accepting your task!');
            }
        }
        $social = 0;

        foreach ($taskAccomplishments[0]->getTaskAssign()->getPerformerTask()->getOperationalPlanningAcc()->getOperationalSuitable()->getSuitableInitiative()-> getInitiative()->getSocialAtrribute() as $va) {
            if ($va->getName()) {
                $social = 1;
            }
        }

        return $this->render('performer_task/show.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskAssigns' => $taskAssigns,
            'narativeForm' => $narativeForm->createView(),
            'social' => $social

        ]);
    }
    /**
     * @Route("/list_show", name="performer_task_list_show", methods={"GET","POST"})
     */
    public function listShow(Request $request, TaskAssignRepository $taskAssignRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $taskAssign = $request->request->get('taskAssign');
        $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskAssign' => $taskAssign]);
        $taskAssigns = $taskAssignRepository->findBy(['id' => $taskAssign]);

        return $this->render('performer_task/listShow.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
            'taskAssigns' => $taskAssigns,
        ]);
    }
    
     /**
     * @Route("/skip_challenge", name="task_challenge_skip")
     */
    public function skipChallenge(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $taskId = $request->request->get('taskId');
        $taskAssign = $taskAssignRepository->find($taskId);
        $taskAssign->setStatus(3);
        $em->flush();
        return new JsonResponse($taskAssign);
    }
    /**
     * @Route("/skip", name="task_narrative_skip")
     */
    public function skip(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $taskId = $request->request->get('taskId');
        $taskAssign = $taskAssignRepository->find($request->request->get('taskId'));
        $taskAssign->setStatus(4);
        $em->flush();
        return new JsonResponse($taskAssign);
    }
    /**
     * @Route("/send", name="performer_task_send")
     */
    public function send(Request $request, TaskAssignRepository $taskAssignRepository)
    {
        $em = $this->getDoctrine()->getManager();

        $taskAssignId = $request->request->get('taskAssignIds');
        // dd($taskAssignId);
        $taskAssign = $taskAssignRepository->find($taskAssignId);
      $taskAccomplishment = $em->getRepository(TaskAccomplishment::class)->findOneBy(['taskAssign'=>$taskAssign]);
    //    dd($taskAccomplishment);
    $taskAccomplishment->setReportedAt(new \DateTime());
        $taskAssign->setStatus(5);
        // $taskUser->setType(1);
        $em->flush();
        return $this->redirectToRoute('performer_task_index');
    }
    /**
     * @Route("/weight_edit", name="performer_task_value_edit")
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
            $task = $request->request->get('task');

            $performerTask = $performerTaskRepository->find($id);
            if ($weight) {

                $remainig = $countWeight - $performerTask->getWeight();
                // $availeble=$remainig-$weight;
                $total = $remainig + $weight;
                // dd($remainig,$weight,$total);

                //   dd(( 100-$countWeight)+$weight);
                if ($total > 100) {
                    $this->addFlash('danger', 'Weight must be less than 100 !');
                    return $this->redirectToRoute('operational_task_index', ['id' => $performerTask->getOperationalPlanningAcc()->getOperationalSuitable()->getId()]);
                }
                $performerTask->setWeight($weight);
            }
            if ($task) {
                $performerTask->setName($task);
            }
            $em->flush();
            $this->addFlash('success', 'Weight Updated successfully !');

            return $this->redirectToRoute('operational_task_index', ['id' => $performerTask->getOperationalPlanningAcc()->getOperationalSuitable()->getId()]);
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
