<?php

namespace App\Controller;

use App\Entity\OfficeKpiPlan;
use App\Form\OfficeKpiPlanType;
use App\Repository\OfficeKpiPlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/office/kpi/plan')]
class OfficeKpiPlanController extends AbstractController
{
    #[Route('/', name: 'office_kpi_plan_index', methods: ['GET'])]
    public function index(OfficeKpiPlanRepository $officeKpiPlanRepository): Response
    {
        return $this->render('office_kpi_plan/index.html.twig', [
            'office_kpi_plans' => $officeKpiPlanRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'office_kpi_plan_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $officeKpiPlan = new OfficeKpiPlan();
        $form = $this->createForm(OfficeKpiPlanType::class, $officeKpiPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($officeKpiPlan);
            $entityManager->flush();

            return $this->redirectToRoute('office_kpi_plan_index');
        }

        return $this->render('office_kpi_plan/new.html.twig', [
            'office_kpi_plan' => $officeKpiPlan,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'office_kpi_plan_show', methods: ['GET'])]
    public function show(OfficeKpiPlan $officeKpiPlan): Response
    {
        return $this->render('office_kpi_plan/show.html.twig', [
            'office_kpi_plan' => $officeKpiPlan,
        ]);
    }

    #[Route('/{id}/edit', name: 'office_kpi_plan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, OfficeKpiPlan $officeKpiPlan): Response
    {
        $form = $this->createForm(OfficeKpiPlanType::class, $officeKpiPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('office_kpi_plan_index');
        }

        return $this->render('office_kpi_plan/edit.html.twig', [
            'office_kpi_plan' => $officeKpiPlan,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'office_kpi_plan_delete', methods: ['DELETE'])]
    public function delete(Request $request, OfficeKpiPlan $officeKpiPlan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$officeKpiPlan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($officeKpiPlan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('office_kpi_plan_index');
    }
}
