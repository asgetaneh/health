<?php

namespace App\Controller;

use App\Entity\QuarterAccomplishment;
use App\Form\QuarterAccomplishmentType;
use App\Repository\QuarterAccomplishmentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/quarter/accomplishment")
 */
class QuarterAccomplishmentController extends AbstractController
{
    /**
     * @Route("/", name="quarter_accomplishment_index", methods={"GET"})
     */
    public function index(QuarterAccomplishmentRepository $quarterAccomplishmentRepository): Response
    {
        return $this->render('quarter_accomplishment/index.html.twig', [
            'quarter_accomplishments' => $quarterAccomplishmentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="quarter_accomplishment_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $quarterAccomplishment = new QuarterAccomplishment();
        $form = $this->createForm(QuarterAccomplishmentType::class, $quarterAccomplishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($quarterAccomplishment);
            $entityManager->flush();

            return $this->redirectToRoute('quarter_accomplishment_index');
        }

        return $this->render('quarter_accomplishment/new.html.twig', [
            'quarter_accomplishment' => $quarterAccomplishment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quarter_accomplishment_show", methods={"GET"})
     */
    public function show(QuarterAccomplishment $quarterAccomplishment): Response
    {
        return $this->render('quarter_accomplishment/show.html.twig', [
            'quarter_accomplishment' => $quarterAccomplishment,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="quarter_accomplishment_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, QuarterAccomplishment $quarterAccomplishment): Response
    {
        $form = $this->createForm(QuarterAccomplishmentType::class, $quarterAccomplishment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('quarter_accomplishment_index');
        }

        return $this->render('quarter_accomplishment/edit.html.twig', [
            'quarter_accomplishment' => $quarterAccomplishment,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="quarter_accomplishment_delete", methods={"DELETE"})
     */
    public function delete(Request $request, QuarterAccomplishment $quarterAccomplishment): Response
    {
        if ($this->isCsrfTokenValid('delete'.$quarterAccomplishment->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($quarterAccomplishment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('quarter_accomplishment_index');
    }
}
