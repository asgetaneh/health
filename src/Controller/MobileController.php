<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\OperationalOffice;
use App\Entity\Performer;
use App\Entity\StaffType;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helper\Helper;
use App\Repository\OperationalOfficeRepository;
use App\Repository\PerformerTaskRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\UserInfoRepository;
use App\Repository\UserRepository;
use Proxies\__CG__\App\Entity\PrincipalOffice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/mobile")
 */
class MobileController extends AbstractController
{
  
     /**
     * @Route("/performertask", name="mobile_performer_task")
     */
    // public function performertask(Request $request, TaskUserRepository $taskUserRepository, TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     if ($request->request->get("taskUserId")) {
    //         $taskUserId = $request->request->get("taskUserId");
    //         $reason = $request->request->get("reason");
    //         $taskUsers = $taskUserRepository->find($taskUserId);
    //         $taskUsers->setStatus(6);
    //         $taskUsers->setRejectReason($reason);
    //         $em->flush();
    //         $this->addFlash('success', 'Task Reject successfully !');
    //         return $this->redirectToRoute('mobile_performer_task');


            
    //     }
    //     $taskUsers = $taskUserRepository->findPerformerTaskUsers($this->getUser());

    //     return $this->render('mobile/perfrormerTask.html.twig', [
    //         'taskUsers' => $taskUsers,
    //         // 'count'=>$count,

    //     ]);
    // }
     /**
     * @Route("/show", name="mobile_performer_task_show", methods={"GET","POST"})
     */
    // public function show(Request $request, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $narativeForm = $this->createFormBuilder()
    //     ->add('narrative', FileType::class, array(
    //         'attr' => array(
    //             'id'=>'filePhoto',
    //             // 'class' => 'sr-only',
    //         //  'accept' => 'image/jpeg,image/png,image/jpg'
    //         ),
    //         'label'=>'',
            
            
    //     ))
    //     ->getForm();


    // $narativeForm->handleRequest($request);

    // if ($narativeForm->isSubmitted() && $narativeForm->isValid()) {
    //     $taskPerformId=$request->request->get("id");
    //     $taskAc=$taskAccomplishmentRepository->findOneBy(['taskUser'=>$taskPerformId]);
    //     $taskUsers = $taskUserRepository->find($request->request->get('id'));
    //     $taskUsers->setStatus(4);
    //     $em = $this->getDoctrine()->getManager();
    //     $uploadedFile = $narativeForm['narrative']->getData();
    //     // dd($uploadedFile);

    //     $destination = $this->getParameter('kernel.project_dir') . '/public/narrative';
    //     $newFilename = $taskAc->getId().uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
    //     $uploadedFile->move($destination, $newFilename);
    // //   dd($newFilename);
    //     //$user=$this->getUser()->getUserInfo();
    //      $taskUsers->setNarrative($newFilename);
    //     $em->flush();
    //     $this->addFlash("tsuccess","Narrative Report Successfully uploaded !!");
    //     return $this->redirectToRoute('mobile_performer_task');

    //  }
    //     if ($taskAcoompId = $request->request->get('taskAcoompId')) {
    //         $editedReportValue = $request->request->get('editedReportValue');
    //         $taskAcoompId = $request->request->get('taskAcoompId');

    //         $taskAccomplishment = $taskAccomplishmentRepository->find($taskAcoompId);
    //         $taskAccomplishment->setReportedValue($editedReportValue);
    //         // $taskUser=$taskUserRepository->findOneBy(['id'=>$taskAccomplishment->getTaskUser()->getId()]);
    //         // $taskUser->setStatus(2);

    //         $em->flush();
    //         $this->addFlash('success', 'Reported Value Edited Successfully !');
    //         return $this->redirectToRoute('mobile_performer_task');
    //     }
    //     if ($report = $request->request->get('reportValue')) {
    //         $reportValue = $request->request->get('reportValue');
    //         $ids = $request->request->get('taskAccomplishmentId');
    //         foreach ($ids as $key => $value) {
    //             $taskAccomplishment = $taskAccomplishmentRepository->find($value);
    //             $taskAccomplishment->setReportedValue($reportValue[$key]);
    //             $taskUser = $taskUserRepository->findOneBy(['id' => $taskAccomplishment->getTaskUser()->getId()]);
    //             $taskUser->setStatus(2);
    //         }
    //         $em->flush();
    //         $this->addFlash('success', 'Reported successfully !');
    //         return $this->redirectToRoute('mobile_performer_task');
    //     }
    //     if ($request->request->get('note')) {
    //         $note = $request->request->get('note');
    //         $id = $request->request->get('taskUserid');
    //         $taskUserno = $taskUserRepository->find($id);

    //         $taskUserno->setNote($note);
    //         $taskUserno->setStatus(3);
    //         $em->flush();
    //         $this->addFlash('success', 'Chalenge successfully !');
    //         return $this->redirectToRoute('mobile_performer_task');
    //     }
    //     $taskUser = $request->request->get('taskUser');
    //     $taskAccomplishments = $taskAccomplishmentRepository->findBy(['taskUser' => $taskUser]);
    //     $taskUsers = $taskUserRepository->findBy(['id' => $taskUser]);
    //     foreach ($taskUsers as $key) {
    //         if ($key->getStatus() < 1) {
    //             $key->setStatus(1);
    //             $em->flush();
    //             $this->addFlash('success', 'Task Accept successfully !');
    //         }
    //     }

    //     return $this->render('mobile/show.html.twig', [
    //         'taskAccomplishments' => $taskAccomplishments,
    //         'taskUsers' => $taskUsers,
    //         'narativeForm'=>$narativeForm->createView()

    //     ]);
    // }
     /**
     * @Route("/send", name="mobile_performer_task_send")
     */
    // public function send(Request $request, TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    // {
    //     $em = $this->getDoctrine()->getManager();

    //     $taskId = $request->request->get('taskUserId');
    //     $taskUser = $taskUserRepository->find($taskId);
    //     $taskUser->setStatus(5);
    //     // $taskUser->setType(1);
    //     $em->flush();
    //     return $this->redirectToRoute('mobile_performer_task');
    // }

       /**
     * @Route("/choose", name="mobile_choose_office")
     */
    // public function choose(Request $request, OperationalOfficeRepository $operationalOfficeRepository, UserInfoRepository $userInfoRepository, UserRepository $userRepository)
    // {
    //     $em = $this->getDoctrine()->getManager();
    //     $filterform = $this->createFormBuilder()

    //         ->add('principalOffice', EntityType::class, [
    //             'class' => PrincipalOffice::class,
    //             // 'multiple' => true,
    //             'required' => true
    //         ])
    //         ->add('stafType', EntityType::class, [
    //             'class' => StaffType::class,
    //             // 'multiple' => true,
    //             'required' => true
    //         ])
    //         // ->add('phoneNumber', NumberType::class, [

    //         //     'required' => true
    //         // ])
    //         ->add('alternativeEmail', EmailType::class, [

    //             'required' => false
    //         ])
    //         ->getForm();
    //     $filterform->handleRequest($request);

    //     if ($filterform->isSubmitted() && $filterform->isValid()) {
    //         // $operationalOffice= $filterform->getData([]);
    //         $data = $filterform->getData();
    //         $stafType = $data['stafType'];
    //         // $phoneNumber = $data['phoneNumber'];
    //         $alternativeEmail = $data['alternativeEmail'];
    //  $phoneNumber = $request->request->get('phoneNumber');


    //         $operatin = $request->request->get("oper");
    //         // dd($operatin);
    //         if ($operatin == null) {
    //         $operatin=$request->request->get("oper"); 
    //         $phoneNumber = $request->request->get('phoneNumber');
    //         // dd($phoneNumber);

    //             $this->addFlash('danger', "Operational Office Not Choose ");

    //             return $this->redirectToRoute('choose_office');
    //         } else {
    //             $operationalOffices = $operationalOfficeRepository->findOneBy(['name' => $request->request->get("oper")]);
    //             // $operationalOffice=$operationalOffices->getId();
    //             $performer = new Performer();
    //             $performer->setOperationalOffice($operationalOffices);
    //             $performer->setPerformer($this->getUser());
    //             $users = $userRepository->find($this->getUser()->getId());
    //             // $userInfo = $userInfoRepository->findOneBy(['user' => $users->getId()]);
    //             $users->setStaffType($stafType);
    //             $users->setMobile($phoneNumber);
    //             $users->setAlternativeEmail($alternativeEmail);
    //             $users->setStatus(1);
    //             $em->persist($performer);
    //             $em->flush();
    //             $this->addFlash('success', "Successfully update your Information ");

    //             return $this->redirectToRoute('mobile_choose_office');
    //         }
    //     }
    //        return $this->render('mobile/chooseOffice.html.twig', [
    //         'filterform' => $filterform->createView(),
    //     ]);
    // }
     
     /**
     * @Route("/operationalfetch", name="mobile_operational_fetch")
     */
    public function mobiletaskFetch(Request $request, OperationalOfficeRepository $operationalOfficeRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $principal = $request->request->get("principal");
        //  dd($principal);
        $principals = $operationalOfficeRepository->filterOperationalOffice($principal);
        // dd($principals);

        return new JsonResponse($principals);
    }

 
}
