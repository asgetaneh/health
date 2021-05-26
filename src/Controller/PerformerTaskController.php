<?php

namespace App\Controller;

use App\Entity\OperationalTask;
use App\Entity\PerformerTask;
use App\Entity\TaskMeasurement;
use App\Form\PerformerTaskType;
use App\Form\TaskMeasurementType;
use App\Repository\PerformerTaskRepository;
use App\Repository\TaskAccomplishmentRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
use App\Repository\TaskUserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function index(Request $request,TaskUserRepository $taskUserRepository , TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository)
    {

      $taskUsers=$taskUserRepository->findBy(['assignedTo'=>$this->getUser()]);
    //   dd($taskUsers);
       
        return $this->render('performer_task/index.html.twig', [
            'performer_tasks' => $taskUsers,
            // 'count'=>$count,
           
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
    public function show(Request $request,TaskUserRepository $taskUserRepository, TaskAccomplishmentRepository $taskAccomplishmentRepository)
    {
        $em=$this->getDoctrine()->getManager();
        if ($report= $request->request->get('reportValue')) {
            $reportValue= $request->request->get('reportValue');
          $ids= $request->request->get('taskAccomplishmentId');
          foreach ($ids as $key => $value) {
            $taskAccomplishment=$taskAccomplishmentRepository->find($value);
            $taskAccomplishment->setAccomplishmentValue($reportValue[$key]);
            $taskUser=$taskUserRepository->findOneBy(['id'=>$taskAccomplishment->getTaskUser()->getId()]);
            $taskUser->setStatus(2);
          }
          $em->flush();
                      $this->addFlash('success', 'Reported successfully !');

                      return $this->redirectToRoute('performer_task_index');

        }
          if ($request->request->get('note')) {
            $note= $request->request->get('note');
          $id= $request->request->get('taskUserid');
            $taskUserno=$taskUserRepository->find($id);

             $taskUserno->setNote($note);
            $taskUserno->setStatus(3);
          $em->flush();
                                $this->addFlash('success', 'Chalenge successfully !');

                      return $this->redirectToRoute('performer_task_index');


        }
       $taskUser= $request->request->get('taskUser');
            //   $taskUsers=$taskUserRepository->findBy(['assignedTo'=>$this->getUser(),'status'=>1]);
      $taskAccomplishments=$taskAccomplishmentRepository->findBy(['taskUser'=>$taskUser]);
          $taskUsers=$taskUserRepository->findBy(['id'=>$taskUser]);
          foreach ($taskUsers as $key ) {
              if($key->getStatus()<1){
                  $key->setStatus(1);
                  $em->flush();
              }
              
              # code...
          }
        //   if
// dd($taskUsers);
 
    //   dd($taskAccomplishments);
        return $this->render('performer_task/show.html.twig', [
            'taskAccomplishments' => $taskAccomplishments,
             'taskUsers' => $taskUsers,
        ]);
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
        if ($this->isCsrfTokenValid('delete'.$performerTask->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performerTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performer_task_index');
    }
}
