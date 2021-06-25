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
use App\Entity\User;
use App\Repository\OperationalSuitableInitiativeRepository;
use App\Repository\PlanningQuarterRepository;
use App\Repository\PrincipalManagerRepository;
use Knp\Component\Pager\PaginatorInterface;
use Proxies\__CG__\App\Entity\InitiativeAttribute;
use Proxies\__CG__\App\Entity\PlanningQuarter;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
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
    public function index(Request $request ,SuitableInitiative $suitableInitiative,PlanningQuarterRepository $planningQuarterRepository, TaskUserRepository $taskUserRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository): Response
    {             
        
         $em = $this->getDoctrine()->getManager();
         $user= $this->getUser();
     $delegatedUser=$em->getRepository(Delegation::class)->findOneBy(["delegatedUser"=>$user,'status'=>1]);
     if ($delegatedUser) {
   $delegatedBy=$delegatedUser->getDelegatedBy();
        $user=$delegatedBy;
        // dd($delegatedUser->getDelegatedUser());
     }
             $social=0;
                foreach ($suitableInitiative->getInitiative()->getSocialAtrribute() as $va){
                    if($va->getName()){
                        $social=1;   }            
            }
            // dd($user);
        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        $count=0;
        $maxcount=0;
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($user ,$suitableInitiative);
       $taskUsers= $taskUserRepository->findTaskUsers($user);
       foreach ($taskUsers as $value) {
                  $value->setType(1);
                  $em->flush();
       }
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
            $maxcount++;
        }
        $time = new DateTime('now');
$quarterId=0;
$quarterName=0;
$now = (new DateTime('now'))->format('y-m-d');
$hamle = DateTimeFactory::of(2013, 11, 1);
$meskerem = DateTimeFactory::of(2014, 1, 30);
  
// dump($now = (new DateTime('now'))->format('y-m-d')
// );

// dd($hamle);

// dd($meskerem);
// $hamle=01/11/2013;
// $meskerem=30/01/2014;
       $f=$this->fromGretoEthstr($time);
            $quarters=$planningQuarterRepository->findAll();
          foreach($quarters as $quarter){
        if ($time >= $quarter->getStartDate() && $time < $quarter->getEndDate() ) {
            $quarterId=$quarter->getId();
            $quarterName=$quarter->getName();
        }
    }
        if ($form->isSubmitted() && $form->isValid()) {
            if ($social == 1) {
       $plans=$planningAccomplishmentRepository->findplanAccomp($suitableInitiative,$form->getData()->getSocial()->getId()); 
            }
            else{
                 $plans=$planningAccomplishmentRepository->findBy(['suitableInitiative'=>$suitableInitiative]); 
            }
            foreach ($plans as  $value) {
                if ( $value->getQuarter() == $planningQuarterRepository->find($quarterId)) {
                    $performerTask->setPlanAcomplishment($value);    
                    $performerTask->setStatus(1); 
                         if ($delegatedUser) { 
                                $delegatedBy=$delegatedUser->getDelegatedUser();
                    $performerTask->setDeligateBy($delegatedBy);    }                      
                    $performerTask->setQuarter($planningQuarterRepository->find($quarterId));
                    $performerTask->setCreatedBy($user);
               $weight=$form->getData()->getWeight();
                if ($count + $weight > 100 ) {
                 $this->addFlash('danger', 'Weight must be less than 100 !');
            return $this->redirectToRoute('operational_task_index',['id'=>$suitableInitiative->getId()]);
            }
             if ($maxcount > 6) {
                 $this->addFlash('danger', 'Task must be less than 7 !');
            return $this->redirectToRoute('operational_task_index',['id'=>$suitableInitiative->getId()]);
            }
            $em->persist($performerTask);
            $em->flush();

            return $this->redirectToRoute('operational_task_index',['id'=>$suitableInitiative->getId()]);
                }   }  }
           $count=0;
        $operationalTasks = $performerTaskRepository->findPerformerInitiativeTask($user,$suitableInitiative);
        foreach($operationalTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
        return $this->render('operational_task/index.html.twig', [
            'performerTasks' => $performerTaskRepository->findPerformerInitiativeTask($user,$suitableInitiative),
            'countWeight'=>$count,
            'quarterName'=>$quarterName,
            'taskUsers'=> $taskUsers,
            'form' => $form->createView(),
            'measurements' => $taskMeasurementRepository->findAll(),
              'social'=>$social,
            'formtask'=>$formtask->createView(),
            'initiativeName'=> $suitableInitiative->getInitiative()->getName(),


        ]);
    }
    public function fromGretoEthstr($gregorian)
    {
        $ethipic = new AD($gregorian);
        // dump($gregorian);
        return $ethipic->format('F j Y');
    }
    public function fromGretoEthstrint($gregorian)
    {
        # code..
        $ethipic = new AD($gregorian);
        return $ethipic->format('F j');
    }
      public function fromEthtoGre($ethipic)
    {
        # code..
        return $ethipic->toGregorian();
    }
    /**
     * @Route("/suitableInitiative/list", name="suitable_initiative_list")
     */
    public function suitableInitiative(Request $request,PaginatorInterface $paginator, OperationalManagerRepository $operationalManagerRepository, SuitableInitiativeRepository $suitableInitiativeRepository, TaskMeasurementRepository $taskMeasurementRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
    {
        $em=$this->getDoctrine()->getManager();
        $user=$this->getUser();
     $delegatedUser=$em->getRepository(Delegation::class)->findOneBy(["delegatedUser"=>$user,'status'=>1]);
     if ($delegatedUser) {
   $delegatedBy=$delegatedUser->getDelegatedBy();
        $user=$delegatedBy;
     }
        $social=0;
        $operation=$operationalManagerRepository->findOneBy(['manager'=>$user]);
      $principlaOffice=  $operation->getOperationalOffice()->getPrincipalOffice()->getId();
        $suitableInitiatives=$suitableInitiativeRepository->findBy(["principalOffice"=>$principlaOffice]);
             $data=$paginator->paginate(
             $suitableInitiatives,
             $request->query->getInt('page',1),
             5

        );
        return $this->render('operational_task/suitableInitiative.html.twig', [
            'suitableInitiatives' => $data,
            'count' => $suitableInitiatives,
        ]);
    }
     /**
     * @Route("/accomplisment/social", name="acomplishment_task_detail_social")
     */
    public function accomplishmentSocial(Request $request,TaskAccomplishmentRepository $taskAccomplishmentRepository )
    {       
        $em=$this->getDoctrine()->getManager();
         $user= $this->getUser();
     $delegatedUser=$em->getRepository(Delegation::class)->findOneBy(["delegatedUser"=>$user,'status'=>1]);
     if ($delegatedUser) {
        $delegatedBy=$delegatedUser->getDelegatedBy();
        $user=$delegatedBy;
        // dd($delegatedUser->getDelegatedUser());
     } 
        $social=1;    
                 $socialAtr=$request->request->get("social");
                $suitableId=$request->request->get("suitId");
  $suitableInitiative=$em->getRepository(SuitableInitiative::class)->find($suitableId);
        $initiativeName=$suitableInitiative->getInitiative()->getName();
                $initiativeId=$suitableInitiative->getId();
         $performerTasks=$em->getRepository(PerformerTask::class)->findInitiativeBySocial($suitableInitiative,$user,$socialAtr);
            $taskAcomolishs=$taskAccomplishmentRepository->findDetailAccomplishSocial($suitableInitiative,$user,$socialAtr); 
           
        
         $time = new DateTime('now');
         $endDate=0;
                  $quarters=$em->getRepository(PlanningQuarter::class)->findAll();
          foreach($quarters as $quarter){
        if ($time >= $quarter->getStartDate() && $time < $quarter->getEndDate() ) {
            $endDate=$quarter->getEndDate();
        }}
               $diff=$endDate->diff($time);
                if ($diff->m == 0) {
                $remainingdays=$diff->d;}
                else{
              $remainingdays=$diff->m * 30 + $diff->d;      
                }
        return $this->render('operational_task/accomplishmentDetail.html.twig', [
            'taskAcomolishs' => $taskAcomolishs,
            'initiativeName'=>$initiativeName,
            'initiativeId'=>$initiativeId,
            'performerTasks'=>$performerTasks,
            'social'=>$social,
            'remainingdays'=>$remainingdays,
            // 'taskUsers'=>$taskUsers
            
        ]);
    }
    /**
 * @Route("/principal/report", name="principal_office_report", methods={"GET","POST"})
     */
    public function report(SuitableInitiativeRepository $suitableInitiativeRepository,Request $request): Response
    {
       $filterForm=$this->createFormBuilder()
       ->add("planyear",EntityType::class,[
           'class'=>PlanningYear::class,
           'multiple' => true,
           'placeholder' => 'Choose an planning year',
           'required'=>false,

       ])
        ->add("initiative",EntityType::class,[
           'class'=>Initiative::class,
           'multiple' => true,
           'placeholder' => 'Choose an planning year',
           'required'=>false,

       ])
       ->add('principaloffice',EntityType::class,[
           'class'=>PrincipalOffice::class,
            'multiple' => true,
            'required'=>false,
            
              'placeholder' => 'Choose an principal office',
       ])->getForm();
       $filterForm->handleRequest($request);
       if($filterForm->isSubmitted()&& $filterForm->isValid()){
         
           $suitableInitiatives=$suitableInitiativeRepository->search($filterForm->getData());
        
        }
        else
         $suitableInitiatives=$suitableInitiativeRepository->findAll();
       
        return $this->render('operational_task/report.html.twig', [
            'suitable_initiatives' => $suitableInitiatives,
            'filterform'=>$filterForm->createView()
        ]);
    }
    
     /**
     * @Route("/accomplisment/{id}", name="acomplishment_task_detail")
     */
    public function accomplishment(Request $request ,PlanningQuarterRepository $planningQuarterRepository, PerformerTaskRepository $performerTaskRepository, SuitableInitiative $suitableInitiative,TaskUserRepository $taskUserRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository )
    {  
        $em=$this->getDoctrine()->getManager();             
 $user= $this->getUser();
        $delegatedUser=$em->getRepository(Delegation::class)->findOneBy(["delegatedUser"=>$user,'status'=>1]);
     if ($delegatedUser) {
   $delegatedBy=$delegatedUser->getDelegatedBy();
        $user=$delegatedBy;
        // dd($delegatedUser->getDelegatedUser());
     }                $social=0;
                foreach ($suitableInitiative->getInitiative()->getSocialAtrribute() as $va){
                    if($va->getName()){
                        $social=1;
                    }   }
        $em=$this->getDoctrine()->getManager();

        $initiativeName=$suitableInitiative->getInitiative()->getName();
                $initiativeId=$suitableInitiative->getId();
         $performerTasks=$performerTaskRepository->findInitiativeBy($suitableInitiative,$user);
        $total1=0;
            $taskAcomolishs=$taskAccomplishmentRepository->findDetailAccomplish($suitableInitiative,$user); 
            // if ($social == 1) {
                
            // $taskAcomolishsSocial=$taskAccomplishmentRepository->findDetailAccomplishSocial($suitableInitiative,$user); 
            //             //    dd($taskAcomolishsSocial);

            // }
            //    foreach ($taskAcomolishs as $value) {      
            //        $total1=$total1 + ( $value->getAccomplishmentValue() * 100) / $value->getexpectedValue() ; 
            //    }
 
        //  $taskUser=$this->getUser();
         $taskUsers=$taskUserRepository->findTaskUsers($user);
         $time = new DateTime('now');
         $endDate=0;
                  $quarters=$planningQuarterRepository->findAll();
          foreach($quarters as $quarter){
        if ($time >= $quarter->getStartDate() && $time < $quarter->getEndDate() ) {
            $endDate=$quarter->getEndDate();
        }}
               $diff=$endDate->diff($time);
                if ($diff->m == 0) {
                $remainingdays=$diff->d;}
                else{
              $remainingdays=$diff->m * 30 + $diff->d;      
                }
        return $this->render('operational_task/accomplishmentDetail.html.twig', [
            'taskAcomolishs' => $taskAcomolishs,
            'initiativeName'=>$initiativeName,
            'initiativeId'=>$initiativeId,
            'performerTasks'=>$performerTasks,
            'social'=>$social,
            'remainingdays'=>$remainingdays,
            'taskUsers'=>$taskUsers
            
        ]);
    }
    
    
     /**
     * @Route("/send/principal", name="send_to_principal")
     */
    public function sendToPrincipal(Request $request,OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository, PlanningQuarterRepository $planningQuarterRepository, OperationalManagerRepository $operationalManagerRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, PerformerTaskRepository $performerTaskRepository)
    {     

        
        $em=$this->getDoctrine()->getManager();
        if($request->request->get("planOffice")){
            $planAcomplismentId=$request->request->get("planId");
            $acompAverage=$request->request->get("acompAvareage");
            $opsuiId=$request->request->get("opsuiId");
            // dd($planAcomplismentId);
            $operationalSuitables=$operationalSuitableInitiativeRepository->find($opsuiId);
            $planAcomplishments=$planningAccomplishmentRepository->find($planAcomplismentId);
                     $operationalSuitables->setStatus(2);
            $planAcomplishments->setAccompValue($acompAverage);

            $em->flush();
                            $this->addFlash('success', 'successfully Send To Plan Office !');

                      return $this->redirectToRoute('principal_office_report');
        }
        $user=$this->getUser();
         $operation=$operationalManagerRepository->findOneBy(['manager'=>$user]);
        $opOffice=$operation->getOperationalOffice();
        $principal=$opOffice->getPrincipalOffice();

        $suitiniId=$request->request->get('suitableinitiative');
        $accompValue=$request->request->get('accomp');
        // $accompValueSex=$request->request->get('acompsex');
        // $sexids=$request->request->get('sexid');
        $social=$request->request->get('social');
        // dd($social);
          $quarterId=$request->request->get('quarterId');
        $quarter=$planningQuarterRepository->find($quarterId);
                $socialAttribute=$em->getRepository(InitiativeAttribute::class)->find($social);
         if ($social == 0) {
         $performerTasks=$performerTaskRepository->findsendToprincipal($user,$suitiniId);

         }
         else {
         $performerTasks=$performerTaskRepository->findsendToprincipalSocial($user,$suitiniId,$social);

         }
        // dd($performerTasks);
        foreach ($performerTasks as $value) {
            $value->setStatus(0);
        }        
         if ($social == 0) {
         $plannings=$planningAccomplishmentRepository->findplanAccwithoutSocial($suitiniId,$principal,$quarter);
           }  else {
                       $plannings=$planningAccomplishmentRepository->findplanAcc($suitiniId,$social,$principal,$quarter);
   
               
         }
          $operationalSuitableInitiative=new OperationalSuitableInitiative();
          $operationalSuitableInitiative->setPlanningAcomplishment($plannings[0]);
          $operationalSuitableInitiative->setOperationalOffice($opOffice);
          $operationalSuitableInitiative->setAccomplishedValue($accompValue);
          $operationalSuitableInitiative->setQuarter($quarter);
          if ($social == 0) {
           $operationalSuitableInitiative->setSocial(null);
          }
          else{
                $operationalSuitableInitiative->setSocial($socialAttribute);
          }
          $operationalSuitableInitiative->setStatus(1);
          $em->persist($operationalSuitableInitiative);
          $em->flush();
    $this->addFlash('success', 'successfully Send To Principal Office !');

        
          return $this->redirectToRoute('suitable_initiative_list');
    }
     /**
     * @Route("/suitableInitiative/principal/list", name="suitable_initiative_principal_list")
     */
    public function suitableInitiativeprincipal(Request $request,OperationalManagerRepository $operationalManagerRepository, SuitableInitiativeRepository $suitableInitiativeRepository,PrincipalManagerRepository $principalManagerRepository): Response
    {
        $user=$this->getUser();
        $social=0;
        $operation=$principalManagerRepository->findOneBy(['principal'=>$user]);
      $principlaOffice=  $operation->getPrincipalOffice()->getId();
        $suitableInitiatives=$suitableInitiativeRepository->findBy(["principalOffice"=>$principlaOffice]);   
        return $this->render('operational_task/suitable_principal.html.twig', [
            'suitableInitiatives' => $suitableInitiatives,
        ]);
    }
     /**
     * @Route("/intiative/accomplishment/list", name="initiative_accomplishment_social_list")
     */
    public function acomplishmentListSocial(Request $request,SuitableInitiativeRepository $suitableInitiativeRepository, PrincipalManagerRepository $principalManagerRepository, OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
    {
         $socialcount=1;
         $suitableId=$request->request->get("suitId");
         $social=$request->request->get("social");
         $suitableInitiative=$suitableInitiativeRepository->find($suitableId);
                
        $principalOffice=$suitableInitiative->getPrincipalOffice()->getId();
       $operatioanlSuitables=$operationalSuitableInitiativeRepository->findplanSocial($principalOffice,$suitableInitiative->getId(),$social);
        // dd($operatioanlSuitables,$social);
        return $this->render('operational_task/initiativeAccomplishment.html.twig', [
            'operatioanlSuitables' => $operatioanlSuitables,
            'social'=>$socialcount,
        ]);
    }
      /**
     * @Route("/intiative/accomplishment/{id}", name="initiative_accomplishment_list")
     */
    public function acomplishmentList(Request $request, SuitableInitiative $suitableInitiative,SuitableInitiativeRepository $suitableInitiativeRepository, PrincipalManagerRepository $principalManagerRepository, OperationalSuitableInitiativeRepository $operationalSuitableInitiativeRepository, PlanningAccomplishmentRepository $planningAccomplishmentRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
    {   
        $socialcount=0;
        $principalOffice=$suitableInitiative->getPrincipalOffice()->getId();
       $operatioanlSuitables=$operationalSuitableInitiativeRepository->findplan($principalOffice,$suitableInitiative->getId());
        // dd($operatioanlSuitables);
        return $this->render('operational_task/initiativeAccomplishment.html.twig', [
            'operatioanlSuitables' => $operatioanlSuitables,
            'social'=>$socialcount,
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
        $em=$this->getDoctrine()->getManager();
         $userId= $request->request->get("user");
       $users=$em->getRepository(User::class)->find($userId);
       $user=$users->getId();
     $delegatedUser=$em->getRepository(Delegation::class)->findOneBy(["delegatedUser"=>$user,'status'=>1]);
     if ($delegatedUser) {
   $delegatedBy=$delegatedUser->getDelegatedBy()->getId();
        $user=$delegatedBy;
        
     }
        $units = $performerTaskRepository->filterDeliverBy($request->request->get('task'),$user);
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
           $user= $this->getUser();
        $delegatedUser=$em->getRepository(Delegation::class)->findOneBy(["delegatedUser"=>$user]);
     if ($delegatedUser) {
   $delegatedBy=$delegatedUser->getDelegatedBy();
        $user=$delegatedBy;
        // dd($delegatedUser->getDelegatedUser());
     }
          $taskUsers=$taskUserRepository->findTaskUsersList($user);
        return $this->render('operational_task/show.html.twig', [
             'taskUsers' => $taskUsers,
        ]);
    }
     /**
     * @Route("/show/detail", name="operational_task_show_detail")
     */
    public function showDetail(Request $request,StaffEvaluationBehaviorCriteriaRepository $staffEvaluationBehaviorCriteriaRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository, TaskUserRepository $taskUserRepository)
    {   $em=$this->getDoctrine()->getManager();
       
       
        if ($request->request->get('reportValue')) {
            $percent=0;
            $reportValue= $request->request->get('reportValue');
            $quality=$request->request->get('quality');
          $ids= $request->request->get('taskAccomplishmentId');
        //   foreach ($ids as $key => $value) {
              $evaluation=new Evaluation();
            $taskAccomplishment=$taskAccomplishmentRepository->find($ids);
             $percent=(($reportValue * 100) / $taskAccomplishment->getExpectedValue());
            $evaluateUser=$taskAccomplishment->getTaskUser()->getAssignedTo();
            $taskAccomplishment->setAccomplishmentValue($reportValue); 
            $evaluation->setEvaluateUser($evaluateUser);
           $evaluation->setTaskAccomplishment($taskAccomplishment);
            $evaluation->setQuantity($percent);
            $evaluation->setQuality($quality);
            $taskUser=$taskUserRepository->findOneBy(['id'=>$taskAccomplishment->getTaskUser()->getId()]);
            $taskUser->setType(3);
              $em->persist($evaluation);
        //   }
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
