<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\OperationalOffice;
use App\Entity\Performer;
use App\Form\GoalType;
use App\Repository\GoalRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Helper\Helper;
use App\Repository\UserRepository;
use Proxies\__CG__\App\Entity\PrincipalOffice;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
         $this->denyAccessUnlessGranted('vw_gol');
        $goal = new Goal();
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);
        $locales = Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($locales as $key => $value) {
                $goal->translate($value)->setName($request->request->get('goal')[$value]);
                $goal->translate($value)->setOutPut($request->request->get('goal')[$value."outPut"]);
                $goal->translate($value)->setOutCome($request->request->get('goal')[$value."outCome"]);
                $goal->translate($value)->setDescription($request->request->get('goal')[$value."description"]);
            }

            $goal->setCreatedAt(new \DateTime());
            $goal->setIsActive(1);
            $goal->setCreatedBy($this->getUser());
            $entityManager->persist($goal);
            $goal->mergeNewTranslations();
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
    public function startegicPlan(Request $request,UserRepository $userRepository, PaginatorInterface $paginator): Response
    {
          
        return $this->render('goal/strategicplan.html.twig'
                
        );
    }

    /**
     * @Route("/{id}", name="goal_show", methods={"GET"})
     */
    public function show(Goal $goal): Response
    {
        $this->denyAccessUnlessGranted('vw_gol_dtl');
        return $this->render('goal/show.html.twig', [
            'goal' => $goal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="goal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Goal $goal): Response
    {
        $this->denyAccessUnlessGranted('edt_gol');
        $form = $this->createForm(GoalType::class, $goal);
        $form->handleRequest($request);
        $locales=Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($locales as $key => $value) {
                $goal->translate($value)->setName($request->request->get('goal')[$value]);
                $goal->translate($value)->setOutPut($request->request->get('goal')[$value."outPut"]);
                $goal->translate($value)->setOutCome($request->request->get('goal')[$value."outCome"]);
                $goal->translate($value)->setDescription($request->request->get('goal')[$value."description"]);
            }
            $goal->mergeNewTranslations();
             $entityManager->flush();
             $this->addFlash('success',"goal is edited successfuly");


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
        $this->denyAccessUnlessGranted('dlt_gol');
        if ($this->isCsrfTokenValid('delete' . $goal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($goal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('goal_index');
    }
}
