<?php

namespace App\Controller;

use App\Entity\PerformerTask;
use App\Form\PerformerTaskType;
use App\Repository\PerformerTaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performer/task")
 */
class PerformerTaskController extends AbstractController
{
    /**
     * @Route("/", name="performer_task_index", methods={"GET"})
     */
    public function index(PerformerTaskRepository $performerTaskRepository): Response
    {
        return $this->render('performer_task/index.html.twig', [
            'performer_tasks' => $performerTaskRepository->findAll(),
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
