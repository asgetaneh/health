<?php

namespace App\Controller;

use App\Entity\InitiativeMeasurement;
use App\Form\InitiativeMeasurementType;
use App\Repository\InitiativeMeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/initiative_measurement')]
class InitiativeMeasurementController extends AbstractController
{
    #[Route('/', name: 'initiative_measurement_index')]
    public function index(Request $request, InitiativeMeasurementRepository $initiativeMeasurementRepository): Response
    {
        $initiativeMeasurement = new InitiativeMeasurement();
        $form = $this->createForm(InitiativeMeasurementType::class, $initiativeMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiativeMeasurement);
            $entityManager->flush();
            $this->addFlash('success', 'Successifully Measurement Registerd');

            return $this->redirectToRoute('initiative_measurement_index');
        }

        return $this->render('initiative_measurement/index.html.twig', [
            'initiative_measurements' => $initiativeMeasurementRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    #[Route('/new', name: 'initiative_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $initiativeMeasurement = new InitiativeMeasurement();
        $form = $this->createForm(InitiativeMeasurementType::class, $initiativeMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiativeMeasurement);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_measurement_index');
        }

        return $this->render('initiative_measurement/new.html.twig', [
            'initiative_measurement' => $initiativeMeasurement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'initiative_measurement_show', methods: ['GET'])]
    public function show(InitiativeMeasurement $initiativeMeasurement): Response
    {
        return $this->render('initiative_measurement/show.html.twig', [
            'initiative_measurement' => $initiativeMeasurement,
        ]);
    }

    #[Route('/{id}/edit', name: 'initiative_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InitiativeMeasurement $initiativeMeasurement): Response
    {
        $form = $this->createForm(InitiativeMeasurementType::class, $initiativeMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('initiative_measurement_index');
        }

        return $this->render('initiative_measurement/edit.html.twig', [
            'initiative_measurement' => $initiativeMeasurement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'initiative_measurement_delete', methods: ['DELETE'])]
    public function delete(Request $request, InitiativeMeasurement $initiativeMeasurement): Response
    {
        if ($this->isCsrfTokenValid('delete' . $initiativeMeasurement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiativeMeasurement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_measurement_index');
    }
}
