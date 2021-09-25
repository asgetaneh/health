<?php

namespace App\Controller;

use App\Entity\TaskAccomplishment;
use App\Form\TaskAccomplishmentType;
use App\Repository\TaskAccomplishmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/task/accomplishment")
 */
class TaskAccomplishmentController extends AbstractController
{
    /**
     * @Route("/", name="task_accomplishment_index", methods={"GET"})
     */
    public function index(TaskAccomplishmentRepository $taskAccomplishmentRepository): Response
    {
        return $this->render('task_accomplishment/index.html.twig', [
            'task_accomplishments' => $taskAccomplishmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="task_accomplishment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $taskAccomplishment = new TaskAccomplishment();
        $form = $this->createForm(TaskAccomplishmentType::class, $taskAccomplishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taskAccomplishment);
            $entityManager->flush();

            return $this->redirectToRoute('task_accomplishment_index');
        }

        return $this->render('task_accomplishment/new.html.twig', [
            'task_accomplishment' => $taskAccomplishment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_accomplishment_show", methods={"GET"})
     */
    public function show(TaskAccomplishment $taskAccomplishment): Response
    {
        return $this->render('task_accomplishment/show.html.twig', [
            'task_accomplishment' => $taskAccomplishment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="task_accomplishment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TaskAccomplishment $taskAccomplishment): Response
    {
        $form = $this->createForm(TaskAccomplishmentType::class, $taskAccomplishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_accomplishment_index');
        }

        return $this->render('task_accomplishment/edit.html.twig', [
            'task_accomplishment' => $taskAccomplishment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_accomplishment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TaskAccomplishment $taskAccomplishment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taskAccomplishment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($taskAccomplishment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('task_accomplishment_index');
    }
}
