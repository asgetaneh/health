<?php

namespace App\Controller;

use App\Entity\PlanningYear;
use App\Form\PlanningYearType;
use App\Repository\PlanningYearRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planning/year")
 */
class PlanningYearController extends AbstractController
{
    /**
     * @Route("/", name="planning_year_index", methods={"GET"})
     */
    public function index(PlanningYearRepository $planningYearRepository): Response
    {
        return $this->render('planning_year/index.html.twig', [
            'planning_years' => $planningYearRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="planning_year_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planningYear = new PlanningYear();
        $form = $this->createForm(PlanningYearType::class, $planningYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planningYear);
            $entityManager->flush();

            return $this->redirectToRoute('planning_year_index');
        }

        return $this->render('planning_year/new.html.twig', [
            'planning_year' => $planningYear,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_year_show", methods={"GET"})
     */
    public function show(PlanningYear $planningYear): Response
    {
        return $this->render('planning_year/show.html.twig', [
            'planning_year' => $planningYear,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planning_year_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanningYear $planningYear): Response
    {
        $form = $this->createForm(PlanningYearType::class, $planningYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planning_year_index');
        }

        return $this->render('planning_year/edit.html.twig', [
            'planning_year' => $planningYear,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_year_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanningYear $planningYear): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planningYear->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planningYear);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_year_index');
    }
}
