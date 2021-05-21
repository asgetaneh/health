<?php

namespace App\Controller;

use App\Entity\TaskMeasurement;
use App\Form\TaskMeasurementType;
use App\Repository\TaskMeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/task/measurement")
 */
class TaskMeasurementController extends AbstractController
{
    /**
     * @Route("/", name="task_measurement_index", methods={"GET"})
     */
    public function index(TaskMeasurementRepository $taskMeasurementRepository): Response
    {
        return $this->render('task_measurement/index.html.twig', [
            'task_measurements' => $taskMeasurementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="task_measurement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $taskMeasurement = new TaskMeasurement();
        $form = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($taskMeasurement);
            $entityManager->flush();

            return $this->redirectToRoute('task_measurement_index');
        }

        return $this->render('task_measurement/new.html.twig', [
            'task_measurement' => $taskMeasurement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_measurement_show", methods={"GET"})
     */
    public function show(TaskMeasurement $taskMeasurement): Response
    {
        return $this->render('task_measurement/show.html.twig', [
            'task_measurement' => $taskMeasurement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="task_measurement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TaskMeasurement $taskMeasurement): Response
    {
        $form = $this->createForm(TaskMeasurementType::class, $taskMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_measurement_index');
        }

        return $this->render('task_measurement/edit.html.twig', [
            'task_measurement' => $taskMeasurement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="task_measurement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TaskMeasurement $taskMeasurement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$taskMeasurement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($taskMeasurement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('task_measurement_index');
    }
}
