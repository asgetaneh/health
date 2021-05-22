<?php

namespace App\Controller;

use App\Entity\InitiativeAttribute;
use App\Form\InitiativeAttributeType;
use App\Repository\InitiativeAttributeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/initiative/attribute")
 */
class InitiativeAttributeController extends AbstractController
{
    /**
     * @Route("/", name="initiative_attribute_index", methods={"GET"})
     */
    public function index(InitiativeAttributeRepository $initiativeAttributeRepository): Response
    {
        return $this->render('initiative_attribute/index.html.twig', [
            'initiative_attributes' => $initiativeAttributeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="initiative_attribute_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $initiativeAttribute = new InitiativeAttribute();
        $form = $this->createForm(InitiativeAttributeType::class, $initiativeAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiativeAttribute);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_attribute_index');
        }

        return $this->render('initiative_attribute/new.html.twig', [
            'initiative_attribute' => $initiativeAttribute,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_attribute_show", methods={"GET"})
     */
    public function show(InitiativeAttribute $initiativeAttribute): Response
    {
        return $this->render('initiative_attribute/show.html.twig', [
            'initiative_attribute' => $initiativeAttribute,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_attribute_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InitiativeAttribute $initiativeAttribute): Response
    {
        $form = $this->createForm(InitiativeAttributeType::class, $initiativeAttribute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('initiative_attribute_index');
        }

        return $this->render('initiative_attribute/edit.html.twig', [
            'initiative_attribute' => $initiativeAttribute,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_attribute_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InitiativeAttribute $initiativeAttribute): Response
    {
        if ($this->isCsrfTokenValid('delete'.$initiativeAttribute->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiativeAttribute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_attribute_index');
    }
}
