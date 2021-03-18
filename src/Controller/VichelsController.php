<?php

namespace App\Controller;

use App\Entity\Vichels;
use App\Form\VichelsType;
use App\Repository\VichelsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vichels")
 */
class VichelsController extends AbstractController
{
    /**
     * @Route("/", name="vichels_index", methods={"GET"})
     */
    public function index(VichelsRepository $vichelsRepository): Response
    {
        return $this->render('vichels/index.html.twig', [
            'vichels' => $vichelsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vichels_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vichel = new Vichels();
        $form = $this->createForm(VichelsType::class, $vichel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vichel);
            $entityManager->flush();

            return $this->redirectToRoute('vichels_index');
        }

        return $this->render('vichels/new.html.twig', [
            'vichel' => $vichel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vichels_show", methods={"GET"})
     */
    public function show(Vichels $vichel): Response
    {
        return $this->render('vichels/show.html.twig', [
            'vichel' => $vichel,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vichels_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vichels $vichel): Response
    {
        $form = $this->createForm(VichelsType::class, $vichel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vichels_index');
        }

        return $this->render('vichels/edit.html.twig', [
            'vichel' => $vichel,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vichels_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vichels $vichel): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vichel->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vichel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vichels_index');
    }
}
