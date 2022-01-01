<?php

namespace App\Controller;

use App\Entity\CoreTask;
use App\Form\CoreTaskType;
use App\Repository\CoreTaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/core_task')]
class CoreTaskController extends AbstractController
{
    #[Route('/', name: 'core_task_index')]
    public function index(Request $request, CoreTaskRepository $coreTaskRepository): Response
    {
        $coreTask = new CoreTask();
        $form = $this->createForm(CoreTaskType::class, $coreTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $name = $form->getData()->getName();
            $names = $entityManager->getRepository(CoreTask::class)->findOneBy(['name' => $name]);
            if ($names) {
                $this->addFlash('danger', 'Duplicate Task Name');
                return $this->redirectToRoute('core_task_index');
            }
        
            $entityManager->persist($coreTask);
            $entityManager->flush();
            $this->addFlash('success', 'Successifully Core Task Registerd');

            return $this->redirectToRoute('core_task_index');
        }

        return $this->render('core_task/index.html.twig', [
            'core_tasks' => $coreTaskRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    #[Route('/new', name: 'core_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $coreTask = new CoreTask();
        $form = $this->createForm(CoreTaskType::class, $coreTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($coreTask);
            $entityManager->flush();

            return $this->redirectToRoute('core_task_index');
        }

        return $this->render('core_task/new.html.twig', [
            'core_task' => $coreTask,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'core_task_show', methods: ['GET'])]
    public function show(CoreTask $coreTask): Response
    {
        return $this->render('core_task/show.html.twig', [
            'core_task' => $coreTask,
        ]);
    }

    #[Route('/{id}/edit', name: 'core_task_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CoreTask $coreTask): Response
    {
        $form = $this->createForm(CoreTaskType::class, $coreTask);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('core_task_index');
        }

        return $this->render('core_task/edit.html.twig', [
            'core_task' => $coreTask,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'core_task_delete', methods: ['DELETE'])]
    public function delete(Request $request, CoreTask $coreTask): Response
    {
        if ($this->isCsrfTokenValid('delete' . $coreTask->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($coreTask);
            $entityManager->flush();
        }

        return $this->redirectToRoute('core_task_index');
    }
}
