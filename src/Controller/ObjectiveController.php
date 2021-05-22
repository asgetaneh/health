<?php

namespace App\Controller;

use App\Entity\Objective;
use App\Form\ObjectiveType;
use App\Repository\ObjectiveRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/objective")
 */
class ObjectiveController extends AbstractController
{
    /**
     * @Route("/", name="objective_index")
     */
    public function index(Request $request,PaginatorInterface $paginator, ObjectiveRepository $objectiveRepository): Response
    {
        $objective = new Objective();
        $form = $this->createForm(ObjectiveType::class, $objective);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $objective->setCreatedAt(new \DateTime());
            $objective->setIsActive(1);
            $objective->setCreatedBy($this->getUser());
            $entityManager->persist($objective);
            $entityManager->flush();

            return $this->redirectToRoute('objective_index');
        }

        
        $objectives=$objectiveRepository->findAlls(); 
        $data = $paginator->paginate(
            $objectives,
            $request->query->getInt('page', 1),
            10
        );     
           return $this->render('objective/index.html.twig', [
            'objectives' => $data,
            'totalObjectives'=>$objectiveRepository->findAll(),
            'form' => $form->createView(),

        ]);
      
    }

    /**
     * @Route("/new", name="objective_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $objective = new Objective();
        $form = $this->createForm(ObjectiveType::class, $objective);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($objective);
            $entityManager->flush();

            return $this->redirectToRoute('objective_index');
        }

        return $this->render('objective/new.html.twig', [
            'objective' => $objective,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objective_show", methods={"GET"})
     */
    public function show(Objective $objective): Response
    {
        return $this->render('objective/show.html.twig', [
            'objective' => $objective,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="objective_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Objective $objective): Response
    {
        $form = $this->createForm(ObjectiveType::class, $objective);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('objective_index');
        }

        return $this->render('objective/edit.html.twig', [
            'objective' => $objective,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="objective_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Objective $objective): Response
    {
        if ($this->isCsrfTokenValid('delete'.$objective->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($objective);
            $entityManager->flush();
        }

        return $this->redirectToRoute('objective_index');
    }
}
