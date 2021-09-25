<?php

namespace App\Controller;

use App\Entity\Disablity;
use App\Form\DisablityType;
use App\Repository\DisablityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/disablity")
 */
class DisablityController extends AbstractController
{
    /**
     * @Route("/", name="disablity_index", methods={"GET"})
     */
    public function index(DisablityRepository $disablityRepository): Response
    {
        return $this->render('disablity/index.html.twig', [
            'disablities' => $disablityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="disablity_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $disablity = new Disablity();
        $form = $this->createForm(DisablityType::class, $disablity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($disablity);
            $entityManager->flush();

            return $this->redirectToRoute('disablity_index');
        }

        return $this->render('disablity/new.html.twig', [
            'disablity' => $disablity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="disablity_show", methods={"GET"})
     */
    public function show(Disablity $disablity): Response
    {
        return $this->render('disablity/show.html.twig', [
            'disablity' => $disablity,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="disablity_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Disablity $disablity): Response
    {
        $form = $this->createForm(DisablityType::class, $disablity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('disablity_index');
        }

        return $this->render('disablity/edit.html.twig', [
            'disablity' => $disablity,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="disablity_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Disablity $disablity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$disablity->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($disablity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('disablity_index');
    }
}
