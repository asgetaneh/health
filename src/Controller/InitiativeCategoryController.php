<?php

namespace App\Controller;

use App\Entity\InitiativeCategory;
use App\Form\InitiativeCategoryType;
use App\Repository\InitiativeCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/initiative_category")
 */
class InitiativeCategoryController extends AbstractController
{
    /**
     * @Route("/", name="initiative_category_index", methods={"GET"})
     */
    public function index(InitiativeCategoryRepository $initiativeCategoryRepository): Response
    {
        return $this->render('initiative_category/index.html.twig', [
            'initiative_categories' => $initiativeCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="initiative_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $initiativeCategory = new InitiativeCategory();
        $form = $this->createForm(InitiativeCategoryType::class, $initiativeCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiativeCategory);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_category_index');
        }

        return $this->render('initiative_category/new.html.twig', [
            'initiative_category' => $initiativeCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_category_show", methods={"GET"})
     */
    public function show(InitiativeCategory $initiativeCategory): Response
    {
        return $this->render('initiative_category/show.html.twig', [
            'initiative_category' => $initiativeCategory,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InitiativeCategory $initiativeCategory): Response
    {
        $form = $this->createForm(InitiativeCategoryType::class, $initiativeCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('initiative_category_index');
        }

        return $this->render('initiative_category/edit.html.twig', [
            'initiative_category' => $initiativeCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_category_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InitiativeCategory $initiativeCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$initiativeCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiativeCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_category_index');
    }
}
