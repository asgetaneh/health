<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Entity\Measure;
use App\Entity\OperationalTask;
use App\Entity\Performer;
use App\Entity\PerformerTask;
use App\Entity\TaskMeasurement;
use App\Form\OperationalTaskType;
use App\Form\PerformerTaskType;
use App\Form\TaskMeasurementType;
use App\Repository\OperationalManagerRepository;
use App\Repository\OperationalOfficeRepository;
use App\Repository\OperationalTaskRepository;
use App\Repository\PerformerRepository;
use App\Repository\PerformerTaskRepository;
use App\Repository\PlanRepository;
use App\Repository\PrincipalOfficeRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\TaskUserRepository;
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
    public function index(Request $request ,Initiative $initiative,TaskUserRepository $taskUserRepository, PlanRepository $planRepository, TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository): Response
    {
        // dd($initiative->getPri>getManancipalOffice());
        $em=$this->getDoctrine()->getManager();
         $plans=$planRepository->findBy(['initiative'=>$initiative]); 
           
        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);
        // dd($form);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        $count=0;
        $operationalTasks = $performerTaskRepository->findAll();
// dd($operationalTasks);
       $taskUsers= $taskUserRepository->findAll();
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager = $this->getDoctrine()->getManager();
            // dd($form->getData());
            foreach ($plans as  $value) {
                if ( $value->getQuarter() == $form->getData()->getQuarter()) {
                    // dd(2);
                    $performerTask->setCreatedBy($this->getUser());
                    $performerTask->setPlan($value);

               $weight=$form->getData()->getWeight();
            //    dd($weight);
                if ($count + $weight > 100 ) {
                 $this->addFlash('danger', 'Weight must be less than 100 !');

            return $this->redirectToRoute('operational_task_index',['id'=>$initiative->getId()]);

            }
            $entityManager->persist($performerTask);
            $entityManager->flush();

            return $this->redirectToRoute('operational_task_index',['id'=>$initiative->getId()]);
                }
         }
            
        }
$count=0;
        $operationalTasks = $performerTaskRepository->findAll();
// dd($operationalTasks);
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
        foreach ($plans as $key ) {
              if($key->getStatus()<1){
                  $key->setStatus(1);
                  $em->flush();
              }
              
          }
        

        return $this->render('operational_task/index.html.twig', [
            'operational_tasks' => $performerTaskRepository->findAll(),
            'count'=>$count,
            'taskUsers'=> $taskUsers,
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
        $operational_tasks = $taskAccomplishmentRepository->findTask($user);
        foreach ($operational_tasks as $key ) {

        }
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
    public function taskFetch(Request $request, PerformerTaskRepository $performerTaskRepository)
    {
        $units = $performerTaskRepository->filterDeliverBy($request->request->get('task'));
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
    public function show(Request $request,TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskUserRepository $taskUserRepository)
    {
         $taskUser= $request->request->get('taskUser');
        //  dd($taskUser);
         $taskUserId=0;
          $taskUsers=$taskUserRepository->findPerformerTask($taskUser);
          foreach ($taskUsers as  $value) {
              $taskUserId=$value->getId();
          }
      

      $taskAccomplishments=$taskAccomplishmentRepository->findBy(['taskUser'=>$taskUserId]);
        //   foreach ($taskUsers as $key ) {
        //       if($key->getStatus()<1){
        //           $key->setStatus(1);
        //         //   $em->flush();
        //       }      
        //   }
     
        return $this->render('operational_task/show.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
             'taskUsers' => $taskUsers,
        ]);
    }

  /**
     * @Route("/approve", name="task_operarional_approve")
     */
    public function approve(Request $request,PlanRepository $planRepository, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em=$this->getDoctrine()->getManager();

         $taskId=$request->request->get('taskUserId');
        //  dd($taskId);
        $taskUser=$taskUserRepository->find($taskId);
        $taskUser->setStatus(6);
        $planId=$taskUser->getTaskAssign()->getPerformerTask()->getPlan()->getId();
        $plans=$planRepository->find($planId);
        // dd($plans);
        $plans->setStatus(3);

           $em->flush();
                $this->addFlash('success', 'Approved successfully !');
 $taskUser= $request->request->get('taskUser');
        //  dd($taskUser);
         $taskUserId=0;
          $taskUsers=$taskUserRepository->findPerformerTask($taskUser);
          foreach ($taskUsers as  $value) {
              $taskUserId=$value->getId();
          }
      

      $taskAccomplishments=$taskAccomplishmentRepository->findBy(['taskUser'=>$taskUserId]);
       
     
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
        if ($this->isCsrfTokenValid('delete'.$operationalTask->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationalTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operational_task_index');
    }
}
