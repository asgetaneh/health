<?php

namespace App\Controller;

use App\Entity\OperationalTask;
use App\Form\OperationalTaskType;
use App\Repository\OperationalTaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational/task")
 */
class OperationalTaskController extends AbstractController
{
    /**
     * @Route("/", name="operational_task_index")
     */
    public function index(Request $request, OperationalTaskRepository $operationalTaskRepository): Response
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

      
        return $this->render('operational_task/index.html.twig', [
            'operational_tasks' => $operationalTaskRepository->findAll(),
            'form' => $form->createView(),

        ]);
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
