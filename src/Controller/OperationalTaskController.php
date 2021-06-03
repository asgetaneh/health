<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Entity\Measure;
use App\Entity\OperationalManager;
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
    public function index(Request $request ,SuitableInitiative $suitableInitiative,TaskUserRepository $taskUserRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository): Response
    {              $entityManager = $this->getDoctrine()->getManager();
    $social=0;
    //    dump($suitableInitiative);
            // foreach ($suitableInitiative as $value) {
                foreach ($suitableInitiative->getInitiative()->getSocialAtrribute() as $va){
                    if($va->getName()){
                        $social=1;
                    }
                
            }
            // dd($social);
        $em=$this->getDoctrine()->getManager();
        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        $count=0;
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($this->getUser(),$suitableInitiative);
       $taskUsers= $taskUserRepository->findTaskUsers($this->getUser());
       foreach ($taskUsers as $value) {
                  $value->setType(1);
                  $entityManager->flush();

       }
    //    $plans=0;
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
 
        if ($form->isSubmitted() && $form->isValid()) {
            if ($social == 1) {
       $plans=$planningAccomplishmentRepository->findplanAccomp($suitableInitiative,$form->getData()->getSocial()->getName()); 

            }
            else{
                 $plans=$planningAccomplishmentRepository->findBy(['suitableInitiative'=>$suitableInitiative]); 
            }
          
            foreach ($plans as  $value) {

                if ( $value->getQuarter() == $form->getData()->getQuarter()) {
                    $performerTask->setPlanAcomplishment($value);                
                        
                    $performerTask->setCreatedBy($this->getUser());

               $weight=$form->getData()->getWeight();
                if ($count + $weight > 100 ) {
                 $this->addFlash('danger', 'Weight must be less than 100 !');

            return $this->redirectToRoute('operational_task_index',['id'=>$suitableInitiative->getId()]);
            }
            $entityManager->persist($performerTask);
            $entityManager->flush();

            return $this->redirectToRoute('operational_task_index',['id'=>$suitableInitiative->getId()]);
                }
         }
            
        }
$count=0;
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($this->getUser(),$suitableInitiative);

// dd($operationalTasks);
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
        // foreach ($plans as $key ) {
        //       if($key->getStatus()<1){
        //           $key->setStatus(1);
        //           $em->flush();
        //       }
              
        //   }

        return $this->render('operational_task/index.html.twig', [
            'performerTasks' => $performerTaskRepository->findPerformerInitiativeTask($this->getUser(),$suitableInitiative),
            'count'=>$count,
            'taskUsers'=> $taskUsers,
            'form' => $form->createView(),
            'measurements' => $taskMeasurementRepository->findAll(),
              'social'=>$social,
            'formtask'=>$formtask->createView()

        ]);
    }
    /**
     * @Route("/suitableInitiative/list", name="suitable_initiative_list")
     */
    public function suitableInitiative(Request $request,OperationalManagerRepository $operationalManagerRepository, SuitableInitiativeRepository $suitableInitiativeRepository, TaskMeasurementRepository $taskMeasurementRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
    {
        $user=$this->getUser();
        $social=0;
        $operation=$operationalManagerRepository->findOneBy(['manager'=>$user]);
      $principlaOffice=  $operation->getOperationalOffice()->getPrincipalOffice()->getId();
        $suitableInitiatives=$suitableInitiativeRepository->findBy(["principalOffice"=>$principlaOffice]);
           
        return $this->render('operational_task/suitableInitiative.html.twig', [
            'suitableInitiatives' => $suitableInitiatives,
        ]);
    }
     /**
     * @Route("/accomplisment/{id}", name="acomplishment_task_detail")
     */
    public function accomplishment(Request $request ,PerformerTaskRepository $performerTaskRepository, SuitableInitiative $suitableInitiative,TaskUserRepository $taskUserRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository )
    {              $entityManager = $this->getDoctrine()->getManager();
       $social=0;
    
                foreach ($suitableInitiative->getInitiative()->getSocialAtrribute() as $va){
                    if($va->getName()){
                        $social=1;
                    }
                
            }
        $em=$this->getDoctrine()->getManager();
        $initiativeName=$suitableInitiative->getInitiative()->getName();

        //  $planAcomplish=$planningAccomplishmentRepository->findOneBy(['suitableInitiative'=>$suitableInitiative]); 
         $performerTasks=$performerTaskRepository->findInitiativeBy($suitableInitiative);
        //  dd($performerTasks);
        $total1=0;
                $total2=0;

            $taskAcomolishs=$taskAccomplishmentRepository->findDetailAccomplish($suitableInitiative); 
               foreach ($taskAcomolishs as $value) {
                        
                   $total1=$total1 + ( $value->getAccomplishmentValue() * 100) / $value->getexpectedValue() ;
                 
               }
 
  $taskUser=$this->getUser();

                 $taskUsers=$taskUserRepository->findTaskUsers($taskUser);
            // dd($taskAcomolishs);
        return $this->render('operational_task/accomplishmentDetail.html.twig', [
            'taskAcomolishs' => $taskAcomolishs,
            'initiativeName'=>$initiativeName,
            'performerTasks'=>$performerTasks,
            'social'=>$social,
            'taskUsers'=>$taskUsers
            
        ]);
    }
    
      /**
     * @Route("/intiative/accomplishment", name="initiative_accomplishment_list")
     */
    public function acomplishmentList(Request $request, OperationalManagerRepository $operationalManagerRepository, SuitableInitiativeRepository $suitableInitiativeRepository, TaskMeasurementRepository $taskMeasurementRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
    {
        $user=$this->getUser();
        $operation=$operationalManagerRepository->findOneBy(['manager'=>$user]);
      $principlaOffice=  $operation->getOperationalOffice()->getPrincipalOffice()->getId();
        $suitableInitiatives=$suitableInitiativeRepository->findBy(["principalOffice"=>$principlaOffice]);
        // $taskAccomplishs=$taskAccomplishmentRepository->findWeight();
        // dd($suitableInitiatives);
        return $this->render('operational_task/initiativeAccomplishment.html.twig', [
            'suitableInitiatives' => $suitableInitiatives,
        ]);
    }
 /**
     * @Route("/userFetch", name="user_fetch")
     */
    public function OperationalFetch(Request $request,PerformerRepository $performerRepository ,UserInfoRepository $userInfoRepository)
    { 
        $office=$request->request->get('userprincipal'); 
        $units = $performerRepository->findAllsUser($request->request->get('userprincipal'));
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
    {   $em=$this->getDoctrine()->getManager();
       
        $taskUser=$this->getUser();
          $taskUsers=$taskUserRepository->findTaskUsers($taskUser);
        return $this->render('operational_task/show.html.twig', [
             'taskUsers' => $taskUsers,
        ]);
    }
     /**
     * @Route("/show/detail", name="operational_task_show_detail")
     */
    public function showDetail(Request $request,StaffEvaluationBehaviorCriteriaRepository $staffEvaluationBehaviorCriteriaRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskUserRepository $taskUserRepository)
    {   $em=$this->getDoctrine()->getManager();
       
       
        if ($report= $request->request->get('reportValue')) {
            $reportValue= $request->request->get('reportValue');
          $ids= $request->request->get('taskAccomplishmentId');
          foreach ($ids as $key => $value) {
            $taskAccomplishment=$taskAccomplishmentRepository->find($value);
            $taskAccomplishment->setAccomplishmentValue($reportValue[$key]);
            $taskUser=$taskUserRepository->findOneBy(['id'=>$taskAccomplishment->getTaskUser()->getId()]);
            $taskUser->setType(3);
          }
          $em->flush();
                      $this->addFlash('success', 'successfully Operational Manager set Acomplisment value  !');
                      return $this->redirectToRoute('operational_task_show');
        }
          $staffCriterias=$staffEvaluationBehaviorCriteriaRepository->findAll();
   $taskUser= $request->request->get('taskUser');
      $taskAccomplishments=$taskAccomplishmentRepository->findBy(['taskUser'=>$taskUser]);
          $taskUsers=$taskUserRepository->findBy(['id'=>$taskUser]);
          foreach ($taskUsers as $value) {
              $endDate=$value->getTaskAssign()->getEndDate();
              $endDates=explode('/',$endDate);
              $date = new DateTime();
        //       dump($endDate);
        //       dump($date);
        //  $dates=date_format($date, 'd/m/Y');
        //       dd($dates);

          }
        //   dd($taskUsers);
          foreach ($taskUsers as $key ) {
              if($key->getType()<2){
                  $key->setType(2);
                  $em->flush();
              }      
          }
        
     
        return $this->render('operational_task/showDetail.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
             'taskUsers' => $taskUsers,
             'staffCriterias'=>$staffCriterias
        ]);
    }

  /**
     * @Route("/approve", name="task_operarional_approve")
     */
    public function approve(Request $request,PlanRepository $planRepository, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em=$this->getDoctrine()->getManager();

         $taskId=$request->request->get('taskUserId');
        $taskUser=$taskUserRepository->find($taskId);
        $planId=$taskUser->getTaskAssign()->getPerformerTask()->getPlan()->getId();
        $plans=$planRepository->find($planId);
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
