<?php

namespace App\Controller;

use App\Entity\Performer;
use App\Form\PerformerType;
use App\Repository\PerformerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performer")
 */
class PerformerController extends AbstractController
{
    /**
     * @Route("/", name="performer_index", methods={"GET"})
     */
    public function index(PerformerRepository $performerRepository): Response
    {
        return $this->render('performer/index.html.twig', [
            'performers' => $performerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="performer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $performer = new Performer();
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performer);
            $entityManager->flush();

            return $this->redirectToRoute('performer_index');
        }

        return $this->render('performer/new.html.twig', [
            'performer' => $performer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performer_show", methods={"GET"})
     */
    public function show(Performer $performer): Response
    {
        return $this->render('performer/show.html.twig', [
            'performer' => $performer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="performer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Performer $performer): Response
    {
        $form = $this->createForm(PerformerType::class, $performer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performer_index');
        }

        return $this->render('performer/edit.html.twig', [
            'performer' => $performer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Performer $performer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$performer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performer_index');
    }
}
