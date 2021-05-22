<?php

namespace App\Controller;

use App\Entity\InitiativeBehaviourCatagory;
use App\Form\InitiativeBehaviourCatagoryType;
use App\Repository\InitiativeBehaviourCatagoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/initiative/behaviour/catagory")
 */
class InitiativeBehaviourCatagoryController extends AbstractController
{
    /**
     * @Route("/", name="initiative_behaviour_catagory_index", methods={"GET"})
     */
    public function index(InitiativeBehaviourCatagoryRepository $initiativeBehaviourCatagoryRepository): Response
    {
        return $this->render('initiative_behaviour_catagory/index.html.twig', [
            'initiative_behaviour_catagories' => $initiativeBehaviourCatagoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="initiative_behaviour_catagory_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $initiativeBehaviourCatagory = new InitiativeBehaviourCatagory();
        $form = $this->createForm(InitiativeBehaviourCatagoryType::class, $initiativeBehaviourCatagory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiativeBehaviourCatagory);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_behaviour_catagory_index');
        }

        return $this->render('initiative_behaviour_catagory/new.html.twig', [
            'initiative_behaviour_catagory' => $initiativeBehaviourCatagory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_behaviour_catagory_show", methods={"GET"})
     */
    public function show(InitiativeBehaviourCatagory $initiativeBehaviourCatagory): Response
    {
        return $this->render('initiative_behaviour_catagory/show.html.twig', [
            'initiative_behaviour_catagory' => $initiativeBehaviourCatagory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_behaviour_catagory_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InitiativeBehaviourCatagory $initiativeBehaviourCatagory): Response
    {
        $form = $this->createForm(InitiativeBehaviourCatagoryType::class, $initiativeBehaviourCatagory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('initiative_behaviour_catagory_index');
        }

        return $this->render('initiative_behaviour_catagory/edit.html.twig', [
            'initiative_behaviour_catagory' => $initiativeBehaviourCatagory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_behaviour_catagory_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InitiativeBehaviourCatagory $initiativeBehaviourCatagory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$initiativeBehaviourCatagory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiativeBehaviourCatagory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_behaviour_catagory_index');
    }
}
