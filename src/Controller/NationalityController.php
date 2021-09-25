<?php

namespace App\Controller;

use App\Entity\Nationality;
use App\Form\NationalityType;
use App\Repository\NationalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/nationality")
 */
class NationalityController extends AbstractController
{
    /**
     * @Route("/", name="nationality_index", methods={"GET"})
     */
    public function index(NationalityRepository $nationalityRepository): Response
    {
        return $this->render('nationality/index.html.twig', [
            'nationalities' => $nationalityRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="nationality_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $nationality = new Nationality();
        $form = $this->createForm(NationalityType::class, $nationality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($nationality);
            $entityManager->flush();

            return $this->redirectToRoute('nationality_index');
        }

        return $this->render('nationality/new.html.twig', [
            'nationality' => $nationality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nationality_show", methods={"GET"})
     */
    public function show(Nationality $nationality): Response
    {
        return $this->render('nationality/show.html.twig', [
            'nationality' => $nationality,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="nationality_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Nationality $nationality): Response
    {
        $form = $this->createForm(NationalityType::class, $nationality);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('nationality_index');
        }

        return $this->render('nationality/edit.html.twig', [
            'nationality' => $nationality,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="nationality_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Nationality $nationality): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nationality->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($nationality);
            $entityManager->flush();
        }

        return $this->redirectToRoute('nationality_index');
    }
}
