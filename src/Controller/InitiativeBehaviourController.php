<?php

namespace App\Controller;

use App\Entity\InitiativeBehaviour;
use App\Form\InitiativeBehaviourType;
use App\Repository\InitiativeBehaviourRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/initiative/behaviour")
 */
class InitiativeBehaviourController extends AbstractController
{
    /**
     * @Route("/", name="initiative_behaviour_index", methods={"GET"})
     */
    public function index(InitiativeBehaviourRepository $initiativeBehaviourRepository): Response
    {
        return $this->render('initiative_behaviour/index.html.twig', [
            'initiative_behaviours' => $initiativeBehaviourRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="initiative_behaviour_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $initiativeBehaviour = new InitiativeBehaviour();
        $form = $this->createForm(InitiativeBehaviourType::class, $initiativeBehaviour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiativeBehaviour);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_behaviour_index');
        }

        return $this->render('initiative_behaviour/new.html.twig', [
            'initiative_behaviour' => $initiativeBehaviour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_behaviour_show", methods={"GET"})
     */
    public function show(InitiativeBehaviour $initiativeBehaviour): Response
    {
        return $this->render('initiative_behaviour/show.html.twig', [
            'initiative_behaviour' => $initiativeBehaviour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_behaviour_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InitiativeBehaviour $initiativeBehaviour): Response
    {
        $form = $this->createForm(InitiativeBehaviourType::class, $initiativeBehaviour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('initiative_behaviour_index');
        }

        return $this->render('initiative_behaviour/edit.html.twig', [
            'initiative_behaviour' => $initiativeBehaviour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_behaviour_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InitiativeBehaviour $initiativeBehaviour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$initiativeBehaviour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiativeBehaviour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_behaviour_index');
    }
}
