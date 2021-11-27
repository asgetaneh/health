<?php

namespace App\Controller;

use App\Entity\InistuitionSuitableInitiative;
use App\Form\InistuitionSuitableInitiativeType;
use App\Repository\InistuitionSuitableInitiativeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/inistuition/suitable/initiative')]
class InistuitionSuitableInitiativeController extends AbstractController
{
    #[Route('/', name: 'inistuition_suitable_initiative_index', methods: ['GET'])]
    public function index(InistuitionSuitableInitiativeRepository $inistuitionSuitableInitiativeRepository): Response
    {
        return $this->render('inistuition_suitable_initiative/index.html.twig', [
            'suitableplans' => $inistuitionSuitableInitiativeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'inistuition_suitable_initiative_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $inistuitionSuitableInitiative = new InistuitionSuitableInitiative();
        $form = $this->createForm(InistuitionSuitableInitiativeType::class, $inistuitionSuitableInitiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inistuitionSuitableInitiative);
            $entityManager->flush();

            return $this->redirectToRoute('inistuition_suitable_initiative_index');
        }

        return $this->render('inistuition_suitable_initiative/new.html.twig', [
            'inistuition_suitable_initiative' => $inistuitionSuitableInitiative,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'inistuition_suitable_initiative_show', methods: ['GET'])]
    public function show(InistuitionSuitableInitiative $inistuitionSuitableInitiative): Response
    {
        return $this->render('inistuition_suitable_initiative/show.html.twig', [
            'inistuition_suitable_initiative' => $inistuitionSuitableInitiative,
        ]);
    }

    #[Route('/{id}/edit', name: 'inistuition_suitable_initiative_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, InistuitionSuitableInitiative $inistuitionSuitableInitiative): Response
    {
        $form = $this->createForm(InistuitionSuitableInitiativeType::class, $inistuitionSuitableInitiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inistuition_suitable_initiative_index');
        }

        return $this->render('inistuition_suitable_initiative/edit.html.twig', [
            'inistuition_suitable_initiative' => $inistuitionSuitableInitiative,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'inistuition_suitable_initiative_delete', methods: ['DELETE'])]
    public function delete(Request $request, InistuitionSuitableInitiative $inistuitionSuitableInitiative): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inistuitionSuitableInitiative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inistuitionSuitableInitiative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inistuition_suitable_initiative_index');
    }
}
