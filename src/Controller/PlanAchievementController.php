<?php

namespace App\Controller;

use App\Entity\PlanAchievement;
use App\Form\PlanAchievementType;
use App\Repository\PlanAchievementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/achievement")
 */
class PlanAchievementController extends AbstractController
{
    /**
     * @Route("/", name="plan_achievement_index")
     */
    public function index(PlanAchievementRepository $planAchievementRepository): Response
    {
        return $this->render('plan_achievement/index.html.twig', [
            'plan_achievements' => $planAchievementRepository->findAll(),
        ]);
    }
     /**
     * @Route("/goal", name="plan_achievement_goal")
     */
    public function goal(PlanAchievementRepository $planAchievementRepository): Response
    {
        return $this->render('plan_achievement/goal.html.twig', [
            'plan_achievements' => $planAchievementRepository->findAll(),
        ]);
    }

 /**
     * @Route("/objective", name="plan_achievement_objective")
     */
    public function objective(PlanAchievementRepository $planAchievementRepository): Response
    {
        return $this->render('plan_achievement/objective.html.twig', [
            'plan_achievements' => $planAchievementRepository->findAll(),
        ]);
    }

    /**
     * @Route("/kpi", name="plan_achievement_kpi")
     */
    public function kpi(PlanAchievementRepository $planAchievementRepository): Response
    {
        return $this->render('plan_achievement/kpi.html.twig', [
            'plan_achievements' => $planAchievementRepository->findAll(),
        ]);
    }
    
    /**
     * @Route("/initiative", name="plan_achievement_initiative")
     */
    public function initiative(PlanAchievementRepository $planAchievementRepository): Response
    {
        return $this->render('plan_achievement/initiative.html.twig', [
            'plan_achievements' => $planAchievementRepository->findAll(),
        ]);
    }
   
    /**
     * @Route("/new", name="plan_achievement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planAchievement = new PlanAchievement();
        $form = $this->createForm(PlanAchievementType::class, $planAchievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planAchievement);
            $entityManager->flush();

            return $this->redirectToRoute('plan_achievement_index');
        }

        return $this->render('plan_achievement/new.html.twig', [
            'plan_achievement' => $planAchievement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_achievement_show", methods={"GET"})
     */
    public function show(PlanAchievement $planAchievement): Response
    {
        return $this->render('plan_achievement/show.html.twig', [
            'plan_achievement' => $planAchievement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plan_achievement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanAchievement $planAchievement): Response
    {
        $form = $this->createForm(PlanAchievementType::class, $planAchievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plan_achievement_index');
        }

        return $this->render('plan_achievement/edit.html.twig', [
            'plan_achievement' => $planAchievement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_achievement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanAchievement $planAchievement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planAchievement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planAchievement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plan_achievement_index');
    }
}
