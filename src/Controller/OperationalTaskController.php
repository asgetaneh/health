<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Entity\Measure;
use App\Entity\OperationalTask;
use App\Entity\TaskMeasurement;
use App\Form\OperationalTaskType;
use App\Form\TaskMeasurementType;
use App\Repository\OperationalManagerRepository;
use App\Repository\OperationalOfficeRepository;
use App\Repository\OperationalTaskRepository;
use App\Repository\PerformerRepository;
use App\Repository\PlanRepository;
use App\Repository\PrincipalOfficeRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\UserInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational/task")
 */
class OperationalTaskController extends AbstractController
{
    /**
     * @Route("/index/{id}", name="operational_task_index")
     */
    public function index(Request $request ,Initiative $initiative, PlanRepository $planRepository, TaskMeasurementRepository $taskMeasurementRepository, OperationalTaskRepository $operationalTaskRepository): Response
    {
         $plans=$planRepository->findBy(['initiative'=>$initiative]);
         
        $operationalTask = new OperationalTask();
        $form = $this->createForm(OperationalTaskType::class, $operationalTask);
        $form->handleRequest($request);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        $count=0;
        $operationalTasks = $operationalTaskRepository->findAll();
// dd($operationalTasks);
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($plans as  $value) {
                if ( $value->getQuarter() == $form->getData()->getQuarter()) {
                    // dd(2);
                    $operationalTask->setCreatedBy($this->getUser());
                    $operationalTask->setPlan($value);

               $weight=$form->getData()->getWeight();
                if ($count + $weight > 100 ) {
                 $this->addFlash('danger', 'Weight must be less than 100 !');

            return $this->redirectToRoute('operational_task_index',['id'=>$initiative->getId()]);

            }
            $entityManager->persist($operationalTask);
            $entityManager->flush();

            return $this->redirectToRoute('operational_task_index',['id'=>$initiative->getId()]);
                }
         }
            
        }
$count=0;
        $operationalTasks = $operationalTaskRepository->findAll();
// dd($operationalTasks);
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
        

        return $this->render('operational_task/index.html.twig', [
            'operational_tasks' => $operationalTaskRepository->findAll(),
            'count'=>$count,
            'form' => $form->createView(),
            'measurements' => $taskMeasurementRepository->findAll(),

            'formtask'=>$formtask->createView()

        ]);
    }
    /**
     * @Route("/list", name="operational_task_list")
     */
    public function listTask(Request $request,TaskMeasurementRepository $taskMeasurementRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
    {
        $user=$this->getUser();
        // dd($user);
        $operational_tasks = $taskAccomplishmentRepository->findTask($user);
        foreach ($operational_tasks as $key ) {

            # code...
        }
        // dd($operational_tasks);
        return $this->render('operational_task/taskList.html.twig', [
            'operational_tasks_assigns' => $taskAccomplishmentRepository->findTask($user),
           

        ]);
    }
 /**
     * @Route("/userFetch", name="user_fetch")
     */
    public function OperationalFetch(Request $request,PerformerRepository $performerRepository ,UserInfoRepository $userInfoRepository)
    { 

        $office=$request->request->get('userprincipal');
        // $users=$operationalManagerRepository->findAllsUser($request->request->get('userprincipal'));
        // dd($office);
        $units = $performerRepository->findAllsUser($request->request->get('userprincipal'));
    // dd($units);
        return new JsonResponse($units);
    }
    /**
     * @Route("/taskFetch", name="task_fetch")
     */
    public function taskFetch(Request $request, OperationalTaskRepository $operationalTaskRepository)
    {
        $units = $operationalTaskRepository->filterDeliverBy($request->request->get('task'));
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
     * @Route("/{id}", name="operational_task_show", methods={"GET"})
     */
    public function show(OperationalTask $operationalTask): Response
    {
        return $this->render('operational_task/show.html.twig', [
            'operational_task' => $operationalTask,
        ]);
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
        if ($this->isCsrfTokenValid('delete'.$operationalTask->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationalTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operational_task_index');
    }
}
