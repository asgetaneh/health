<?php

namespace App\Controller;

use App\Entity\InistuitionPlan;
use App\Form\InistuitionPlanType;
use App\Repository\InistuitionPlanRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inistuition/plan')]
class InistuitionPlanController extends AbstractController
{
    #[Route('/', name: 'inistuition_plan_index', methods: ['GET'])]
    public function index(InistuitionPlanRepository $inistuitionPlanRepository): Response
    {
        return $this->render('inistuition_plan/index.html.twig', [
            'inistuition_plans' => $inistuitionPlanRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'inistuition_plan_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $inistuitionPlan = new InistuitionPlan();
        $form = $this->createForm(InistuitionPlanType::class, $inistuitionPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inistuitionPlan);
            $entityManager->flush();

            return $this->redirectToRoute('inistuition_plan_index');
        }

        return $this->render('inistuition_plan/new.html.twig', [
            'inistuition_plan' => $inistuitionPlan,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'inistuition_plan_show', methods: ['GET'])]
    public function show(InistuitionPlan $inistuitionPlan): Response
    {
        return $this->render('inistuition_plan/show.html.twig', [
            'inistuition_plan' => $inistuitionPlan,
        ]);
    }

    #[Route('/{id}/edit', name: 'inistuition_plan_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InistuitionPlan $inistuitionPlan): Response
    {
        $form = $this->createForm(InistuitionPlanType::class, $inistuitionPlan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inistuition_plan_index');
        }

        return $this->render('inistuition_plan/edit.html.twig', [
            'inistuition_plan' => $inistuitionPlan,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'inistuition_plan_delete', methods: ['DELETE'])]
    public function delete(Request $request, InistuitionPlan $inistuitionPlan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inistuitionPlan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inistuitionPlan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inistuition_plan_index');
    }
}
