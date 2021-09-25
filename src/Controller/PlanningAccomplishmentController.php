<?php

namespace App\Controller;

use App\Entity\PlanningAccomplishment;
use App\Form\PlanningAccomplishmentType;
use App\Repository\PlanningAccomplishmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planning/accomplishment")
 */
class PlanningAccomplishmentController extends AbstractController
{
    /**
     * @Route("/", name="planning_accomplishment_index", methods={"GET"})
     */
    public function index(PlanningAccomplishmentRepository $planningAccomplishmentRepository): Response
    {
        return $this->render('planning_accomplishment/index.html.twig', [
            'planning_accomplishments' => $planningAccomplishmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="planning_accomplishment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planningAccomplishment = new PlanningAccomplishment();
        $form = $this->createForm(PlanningAccomplishmentType::class, $planningAccomplishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planningAccomplishment);
            $entityManager->flush();

            return $this->redirectToRoute('planning_accomplishment_index');
        }

        return $this->render('planning_accomplishment/new.html.twig', [
            'planning_accomplishment' => $planningAccomplishment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_accomplishment_show", methods={"GET"})
     */
    public function show(PlanningAccomplishment $planningAccomplishment): Response
    {
        return $this->render('planning_accomplishment/show.html.twig', [
            'planning_accomplishment' => $planningAccomplishment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planning_accomplishment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanningAccomplishment $planningAccomplishment): Response
    {
        $form = $this->createForm(PlanningAccomplishmentType::class, $planningAccomplishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planning_accomplishment_index');
        }

        return $this->render('planning_accomplishment/edit.html.twig', [
            'planning_accomplishment' => $planningAccomplishment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_accomplishment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanningAccomplishment $planningAccomplishment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planningAccomplishment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planningAccomplishment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_accomplishment_index');
    }
}
