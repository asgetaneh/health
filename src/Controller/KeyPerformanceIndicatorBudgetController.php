<?php

namespace App\Controller;

use App\Entity\KeyPerformanceIndicatorBudget;
use App\Form\KeyPerformanceIndicatorBudgetType;
use App\Repository\KeyPerformanceIndicatorBudgetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;


#[Route('/key/performance/indicator/budget')]
class KeyPerformanceIndicatorBudgetController extends AbstractController
{
    #[Route('/', name: 'app_key_performance_indicator_budget_index')]
    public function index(Request $request,KeyPerformanceIndicatorBudgetRepository $keyPerformanceIndicatorBudgetRepository,PaginatorInterface $paginator): Response
    {
         $keyPerformanceIndicatorBudget = new KeyPerformanceIndicatorBudget();
        $form = $this->createForm(KeyPerformanceIndicatorBudgetType::class, $keyPerformanceIndicatorBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyPerformanceIndicatorBudgetRepository->add($keyPerformanceIndicatorBudget);
            return $this->redirectToRoute('app_key_performance_indicator_budget_index', [], Response::HTTP_SEE_OTHER);
        }
        
        $keyPerformanceIndicatorBudget = new KeyPerformanceIndicatorBudget();
        $form = $this->createForm(KeyPerformanceIndicatorBudgetType::class, $keyPerformanceIndicatorBudget);
        $form->handleRequest($request);
        $data = $paginator->paginate(
            $keyPerformanceIndicatorBudgetRepository->findAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('key_performance_indicator_budget/index.html.twig', [
             'form' => $form->createView(),
            'key_performance_indicator_budgets' => $data,
        ]);
    }

    #[Route('/new', name: 'app_key_performance_indicator_budget_new', methods: ['GET', 'POST'])]
    public function new(Request $request, KeyPerformanceIndicatorBudgetRepository $keyPerformanceIndicatorBudgetRepository): Response
    {
        $keyPerformanceIndicatorBudget = new KeyPerformanceIndicatorBudget();
        $form = $this->createForm(KeyPerformanceIndicatorBudgetType::class, $keyPerformanceIndicatorBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyPerformanceIndicatorBudgetRepository->add($keyPerformanceIndicatorBudget);
            return $this->redirectToRoute('app_key_performance_indicator_budget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('key_performance_indicator_budget/new.html.twig', [
            'key_performance_indicator_budget' => $keyPerformanceIndicatorBudget,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_key_performance_indicator_budget_show', methods: ['GET'])]
    public function show(KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget): Response
    {
        return $this->render('key_performance_indicator_budget/show.html.twig', [
            'key_performance_indicator_budget' => $keyPerformanceIndicatorBudget,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_key_performance_indicator_budget_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget, KeyPerformanceIndicatorBudgetRepository $keyPerformanceIndicatorBudgetRepository): Response
    {
        $form = $this->createForm(KeyPerformanceIndicatorBudgetType::class, $keyPerformanceIndicatorBudget);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $keyPerformanceIndicatorBudgetRepository->add($keyPerformanceIndicatorBudget);
            return $this->redirectToRoute('app_key_performance_indicator_budget_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('key_performance_indicator_budget/edit.html.twig', [
            'key_performance_indicator_budget' => $keyPerformanceIndicatorBudget,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_key_performance_indicator_budget_delete', methods: ['POST'])]
    public function delete(Request $request, KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget, KeyPerformanceIndicatorBudgetRepository $keyPerformanceIndicatorBudgetRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$keyPerformanceIndicatorBudget->getId(), $request->request->get('_token'))) {
            $keyPerformanceIndicatorBudgetRepository->remove($keyPerformanceIndicatorBudget);
        }

        return $this->redirectToRoute('app_key_performance_indicator_budget_index', [], Response::HTTP_SEE_OTHER);
    }
}
