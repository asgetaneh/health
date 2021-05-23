<?php

namespace App\Controller;

use App\Entity\PerformerTask;
use App\Entity\TaskMeasurement;
use App\Form\PerformerTaskType;
use App\Form\TaskMeasurementType;
use App\Repository\PerformerTaskRepository;
use App\Repository\TaskAssignRepository;
use App\Repository\TaskMeasurementRepository;
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
    public function index(Request $request,TaskMeasurementRepository $taskMeasurementRepository, PerformerTaskRepository $performerTaskRepository)
    {

        // dd(3);
        $performerTask = new PerformerTask();
        $form = $this->createForm(PerformerTaskType::class, $performerTask);
        $form->handleRequest($request);
        $taskMeasurement = new TaskMeasurement();
        $formtask = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $formtask->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performerTask);
            $entityManager->flush();

            return $this->redirectToRoute('performer_task_index');
        }
$count=0;
        $performerTasks = $performerTaskRepository->findAll();
// dd($operationalTasks);
        foreach($performerTasks as $operationals){
             $count=$count+
            $operationals->getWeight();
        }
        // dd($count);
        return $this->render('performer_task/index.html.twig', [
            'performer_tasks' => $performerTaskRepository->findAll(),
            'count'=>$count,
            'form' => $form->createView(),
            'measurements' => $taskMeasurementRepository->findAll(),

            'formtask'=>$formtask->createView()
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
     * @Route("/{id}", name="performer_task_show", methods={"GET"})
     */
    public function show(PerformerTask $performerTask): Response
    {
        return $this->render('performer_task/show.html.twig', [
            'performer_task' => $performerTask,
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
