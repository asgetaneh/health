<?php

namespace App\Controller;

use App\Entity\KeyPerformanceIndicator;
use App\Form\KeyPerformanceIndicatorType;
use App\Repository\KeyPerformanceIndicatorRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/key/performance/indicator")
 */
class KeyPerformanceIndicatorController extends AbstractController
{
    /**
     * @Route("/", name="key_performance_indicator_index")
     */
    public function index(Request $request, KeyPerformanceIndicatorRepository $keyPerformanceIndicatorRepository,PaginatorInterface $paginator): Response
    {
        $keyPerformanceIndicator = new KeyPerformanceIndicator();
        $form = $this->createForm(KeyPerformanceIndicatorType::class, $keyPerformanceIndicator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $keyPerformanceIndicator->setCreatedAt(new \DateTime());
            $keyPerformanceIndicator->setIsActive(1);
            $keyPerformanceIndicator->setCreatedBy($this->getUser());
            $entityManager->persist($keyPerformanceIndicator);
            $entityManager->flush();

            return $this->redirectToRoute('key_performance_indicator_index');
        }
       
        $keyPerformanceIndicators=$keyPerformanceIndicatorRepository->findAlls(); 
        $data = $paginator->paginate(
            $keyPerformanceIndicators,
            $request->query->getInt('page', 1),
            6
        );     
          
        return $this->render('key_performance_indicator/index.html.twig', [
            'key_performance_indicators' => $data,
            'totalkeyperformance'=>$keyPerformanceIndicatorRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/new", name="key_performance_indicator_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $keyPerformanceIndicator = new KeyPerformanceIndicator();
        $form = $this->createForm(KeyPerformanceIndicatorType::class, $keyPerformanceIndicator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($keyPerformanceIndicator);
            $entityManager->flush();

            return $this->redirectToRoute('key_performance_indicator_index');
        }

        return $this->render('key_performance_indicator/new.html.twig', [
            'key_performance_indicator' => $keyPerformanceIndicator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="key_performance_indicator_show", methods={"GET"})
     */
    public function show(KeyPerformanceIndicator $keyPerformanceIndicator): Response
    {
        return $this->render('key_performance_indicator/show.html.twig', [
            'key_performance_indicator' => $keyPerformanceIndicator,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="key_performance_indicator_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, KeyPerformanceIndicator $keyPerformanceIndicator): Response
    {
        $form = $this->createForm(KeyPerformanceIndicatorType::class, $keyPerformanceIndicator);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('key_performance_indicator_index');
        }

        return $this->render('key_performance_indicator/edit.html.twig', [
            'key_performance_indicator' => $keyPerformanceIndicator,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="key_performance_indicator_delete", methods={"DELETE"})
     */
    public function delete(Request $request, KeyPerformanceIndicator $keyPerformanceIndicator): Response
    {
        if ($this->isCsrfTokenValid('delete'.$keyPerformanceIndicator->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($keyPerformanceIndicator);
            $entityManager->flush();
        }

        return $this->redirectToRoute('key_performance_indicator_index');
    }
}
