<?php

namespace App\Controller;

use App\Entity\PlanningPhase;
use App\Form\PlanningPhaseType;
use App\Repository\PlanningPhaseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Plan;

/**
 * @Route("/planning/phase")
 */
class PlanningPhaseController extends AbstractController
{
    /**
     * @Route("/", name="planning_phase_index", methods={"GET"})
     */
    public function index(PlanningPhaseRepository $planningPhaseRepository): Response
    {
        return $this->render('planning_phase/index.html.twig', [
            'planning_phases' => $planningPhaseRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="planning_phase_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planningPhase = new PlanningPhase();
        $form = $this->createForm(PlanningPhaseType::class, $planningPhase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planningPhase);
            $entityManager->flush();

            return $this->redirectToRoute('planning_phase_index');
        }

        return $this->render('planning_phase/new.html.twig', [
            'planning_phase' => $planningPhase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_phase_show", methods={"GET"})
     */
    public function show(PlanningPhase $planningPhase): Response
    {
        return $this->render('planning_phase/show.html.twig', [
            'planning_phase' => $planningPhase,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planning_phase_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanningPhase $planningPhase): Response
    {
        $form = $this->createForm(PlanningPhaseType::class, $planningPhase);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planning_phase_index');
        }

        return $this->render('planning_phase/edit.html.twig', [
            'planning_phase' => $planningPhase,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_phase_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanningPhase $planningPhase): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planningPhase->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planningPhase);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_phase_index');
    }
     /**
     * @Route("/{id}/plan", name="plan_creation",methods={"GET","POST"})
     */
    public function PlanCreationForPhase(Request $request, PlanningPhase $planningPhase): Response
    {
        
       $em=$this->getDoctrine()->getManager();
       $office=$this->getUser()->getPrincipalManagers()
       ;
       $offices=array();

       foreach ($office as $key => $value) {
          array_push ($offices,$value->getPrincipalOffice()->getName());
       }
       dd($offices);
       $plan = new Plan();
       $planningyear=$planningPhase->getPlanningYear();



        return $this->redirectToRoute('planning_phase_index');
    }
    
}
