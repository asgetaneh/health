<?php

namespace App\Controller;

use App\Entity\Strategy;
use App\Form\StrategyType;
use App\Repository\StrategyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/strategy")
 */
class StrategyController extends AbstractController
{
    /**
     * @Route("/", name="strategy_index")
     */
    public function index(Request $request, StrategyRepository $strategyRepository,PaginatorInterface $paginator): Response
    {
        $strategy = new Strategy();
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $strategy->setCreatedAt(new \DateTime());
            $strategy->setIsActive(1);
            $strategy->setCreatedBy($this->getUser());
            $entityManager->persist($strategy);
            $entityManager->flush();

            return $this->redirectToRoute('strategy_index');
        }
        $strategies=$strategyRepository->findAlls(); 
        $data = $paginator->paginate(
            $strategies,
            $request->query->getInt('page', 1),
            6
        );     
          
        return $this->render('strategy/index.html.twig', [
            'strategies' => $data,
            'totalStrategies'=>$strategyRepository->findAll(),
            'form' => $form->createView(),


        ]);
    }

    /**
     * @Route("/new", name="strategy_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $strategy = new Strategy();
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($strategy);
            $entityManager->flush();

            return $this->redirectToRoute('strategy_index');
        }

        return $this->render('strategy/new.html.twig', [
            'strategy' => $strategy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strategy_show", methods={"GET"})
     */
    public function show(Strategy $strategy): Response
    {
        return $this->render('strategy/show.html.twig', [
            'strategy' => $strategy,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="strategy_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Strategy $strategy): Response
    {
        $form = $this->createForm(StrategyType::class, $strategy);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('strategy_index');
        }

        return $this->render('strategy/edit.html.twig', [
            'strategy' => $strategy,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="strategy_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Strategy $strategy): Response
    {
        if ($this->isCsrfTokenValid('delete'.$strategy->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($strategy);
            $entityManager->flush();
        }

        return $this->redirectToRoute('strategy_index');
    }
}
