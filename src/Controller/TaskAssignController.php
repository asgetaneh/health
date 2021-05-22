<?php

namespace App\Controller;

use App\Entity\TaskAssign;
use App\Form\TaskAssignType;
use App\Repository\TaskAssignRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/task/assign")
 */
class TaskAssignController extends AbstractController
{
    /**
     * @Route("/", name="task_assign_index", methods={"GET"})
     */
    public function index(TaskAssignRepository $taskAssignRepository): Response
    {
        return $this->render('task_assign/index.html.twig', [
            'task_assigns' => $taskAssignRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="task_assign_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $taskAssign = new TaskAssign();
        $form = $this->createForm(TaskAssignType::class, $taskAssign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taskAssign);
            $entityManager->flush();

            return $this->redirectToRoute('task_assign_index');
        }

        return $this->render('task_assign/new.html.twig', [
            'task_assign' => $taskAssign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_assign_show", methods={"GET"})
     */
    public function show(TaskAssign $taskAssign): Response
    {
        return $this->render('task_assign/show.html.twig', [
            'task_assign' => $taskAssign,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="task_assign_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TaskAssign $taskAssign): Response
    {
        $form = $this->createForm(TaskAssignType::class, $taskAssign);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_assign_index');
        }

        return $this->render('task_assign/edit.html.twig', [
            'task_assign' => $taskAssign,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_assign_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TaskAssign $taskAssign): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taskAssign->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($taskAssign);
            $entityManager->flush();
        }

        return $this->redirectToRoute('task_assign_index');
    }
}
