<?php

namespace App\Controller;

use App\Entity\Sposnsorship;
use App\Form\SposnsorshipType;
use App\Repository\SposnsorshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sposnsorship")
 */
class SposnsorshipController extends AbstractController
{
    /**
     * @Route("/", name="sposnsorship_index", methods={"GET"})
     */
    public function index(SposnsorshipRepository $sposnsorshipRepository): Response
    {
        return $this->render('sposnsorship/index.html.twig', [
            'sposnsorships' => $sposnsorshipRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sposnsorship_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sposnsorship = new Sposnsorship();
        $form = $this->createForm(SposnsorshipType::class, $sposnsorship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sposnsorship);
            $entityManager->flush();

            return $this->redirectToRoute('sposnsorship_index');
        }

        return $this->render('sposnsorship/new.html.twig', [
            'sposnsorship' => $sposnsorship,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sposnsorship_show", methods={"GET"})
     */
    public function show(Sposnsorship $sposnsorship): Response
    {
        return $this->render('sposnsorship/show.html.twig', [
            'sposnsorship' => $sposnsorship,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sposnsorship_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Sposnsorship $sposnsorship): Response
    {
        $form = $this->createForm(SposnsorshipType::class, $sposnsorship);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sposnsorship_index');
        }

        return $this->render('sposnsorship/edit.html.twig', [
            'sposnsorship' => $sposnsorship,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sposnsorship_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Sposnsorship $sposnsorship): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sposnsorship->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sposnsorship);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sposnsorship_index');
    }
}
