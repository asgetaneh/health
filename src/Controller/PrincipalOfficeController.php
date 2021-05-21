<?php

namespace App\Controller;

use App\Entity\PrincipalOffice;
use App\Form\PrincipalOfficeType;
use App\Repository\PrincipalOfficeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/principal/office")
 */
class PrincipalOfficeController extends AbstractController
{
    /**
     * @Route("/", name="principal_office_index", methods={"GET"})
     */
    public function index(PrincipalOfficeRepository $principalOfficeRepository): Response
    {
        return $this->render('principal_office/index.html.twig', [
            'principal_offices' => $principalOfficeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="principal_office_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $principalOffice = new PrincipalOffice();
        $form = $this->createForm(PrincipalOfficeType::class, $principalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($principalOffice);
            $entityManager->flush();

            return $this->redirectToRoute('principal_office_index');
        }

        return $this->render('principal_office/new.html.twig', [
            'principal_office' => $principalOffice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principal_office_show", methods={"GET"})
     */
    public function show(PrincipalOffice $principalOffice): Response
    {
        return $this->render('principal_office/show.html.twig', [
            'principal_office' => $principalOffice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="principal_office_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PrincipalOffice $principalOffice): Response
    {
        $form = $this->createForm(PrincipalOfficeType::class, $principalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('principal_office_index');
        }

        return $this->render('principal_office/edit.html.twig', [
            'principal_office' => $principalOffice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principal_office_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PrincipalOffice $principalOffice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$principalOffice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principalOffice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_office_index');
    }
}
