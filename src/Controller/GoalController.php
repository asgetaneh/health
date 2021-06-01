<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/goal")
 */
class GoalController extends AbstractController
{
    /**
     * @Route("/", name="goal_index")
     */
    public function index(Request $request, GoalRepository $goalRepository, PaginatorInterface $paginator): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $goal->setCreatedAt(new \DateTime());
            $goal->setIsActive(1);
            $goal->setCreatedBy($this->getUser());
            $entityManager->persist($goal);
            $entityManager->flush();
            $this->addFlash('success', "new goal is added successfuly");
            return $this->redirectToRoute('goal_index');
        }

        $goals = $goalRepository->findAlls();
        $data = $paginator->paginate(
            $goals,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('goal/index.html.twig', [
            'goals' => $data,
            'totalGoals' => $goalRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/new", name="goal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($goal);
            $entityManager->flush();

            return $this->redirectToRoute('goal_index');
        }

        return $this->render('goal/new.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }
  /**
     * @Route("/startegicPlan", name="startegic_plan", methods={"GET","POST"})
     */
    public function startegicPlan(Request $request, GoalRepository $goalRepository, PaginatorInterface $paginator): Response
    {
         $goals = $goalRepository->findAlls();
          $data = $paginator->paginate(
            $goals,
            $request->query->getInt('page', 1),
            3
        );
        
        return $this->render('goal/strategicplan.html.twig', [
           'goals'=>$data
        ]);
    }

    /**
     * @Route("/{id}", name="goal_show", methods={"GET"})
     */
    public function show(Goal $goal): Response
    {
        return $this->render('goal/show.html.twig', [
            'goal' => $goal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="goal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Goal $goal): Response
    {
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('goal_index');
        }

        return $this->render('goal/edit.html.twig', [
            'goal' => $goal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="goal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Goal $goal): Response
    {
        if ($this->isCsrfTokenValid('delete' . $goal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('goal_index');
    }
}
