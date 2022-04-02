<?php

namespace App\Controller;

use App\Entity\UnitOfMeasurement;
use App\Form\UnitOfMeasurementType;
use App\Repository\UnitOfMeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/unit/of/measurement')]
class UnitOfMeasurementController extends AbstractController
{
    #[Route('/', name: 'unit_of_measurement_index', methods: ['GET'])]
    public function index(UnitOfMeasurementRepository $unitOfMeasurementRepository): Response
    {
        $this->denyAccessUnlessGranted('ad_intv');
        return $this->render('unit_of_measurement/index.html.twig', [
            'unit_of_measurements' => $unitOfMeasurementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'unit_of_measurement_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ad_intv');
        $unitOfMeasurement = new UnitOfMeasurement();
        $form = $this->createForm(UnitOfMeasurementType::class, $unitOfMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($unitOfMeasurement);
            $entityManager->flush();

            return $this->redirectToRoute('unit_of_measurement_index');
        }

        return $this->render('unit_of_measurement/new.html.twig', [
            'unit_of_measurement' => $unitOfMeasurement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'unit_of_measurement_show', methods: ['GET'])]
    public function show(UnitOfMeasurement $unitOfMeasurement): Response
    {
        $this->denyAccessUnlessGranted('ad_intv');
        return $this->render('unit_of_measurement/show.html.twig', [
            'unit_of_measurement' => $unitOfMeasurement,
        ]);
    }

    #[Route('/{id}/edit', name: 'unit_of_measurement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, UnitOfMeasurement $unitOfMeasurement): Response
    {
        $this->denyAccessUnlessGranted('ad_intv');
        $form = $this->createForm(UnitOfMeasurementType::class, $unitOfMeasurement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('unit_of_measurement_index');
        }

        return $this->render('unit_of_measurement/edit.html.twig', [
            'unit_of_measurement' => $unitOfMeasurement,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'unit_of_measurement_delete', methods: ['DELETE'])]
    public function delete(Request $request, UnitOfMeasurement $unitOfMeasurement): Response
    {
        $this->denyAccessUnlessGranted('ad_intv');
        if ($this->isCsrfTokenValid('delete' . $unitOfMeasurement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($unitOfMeasurement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('unit_of_measurement_index');
    }
}
