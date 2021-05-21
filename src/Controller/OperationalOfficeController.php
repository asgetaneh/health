<?php

namespace App\Controller;

use App\Entity\OperationalOffice;
use App\Form\OperationalOfficeType;
use App\Repository\OperationalOfficeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational/office")
 */
class OperationalOfficeController extends AbstractController
{
    /**
     * @Route("/", name="operational_office_index", methods={"GET"})
     */
    public function index(OperationalOfficeRepository $operationalOfficeRepository): Response
    {
        return $this->render('operational_office/index.html.twig', [
            'operational_offices' => $operationalOfficeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="operational_office_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $operationalOffice = new OperationalOffice();
        $form = $this->createForm(OperationalOfficeType::class, $operationalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operationalOffice);
            $entityManager->flush();

            return $this->redirectToRoute('operational_office_index');
        }

        return $this->render('operational_office/new.html.twig', [
            'operational_office' => $operationalOffice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_office_show", methods={"GET"})
     */
    public function show(OperationalOffice $operationalOffice): Response
    {
        return $this->render('operational_office/show.html.twig', [
            'operational_office' => $operationalOffice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="operational_office_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OperationalOffice $operationalOffice): Response
    {
        $form = $this->createForm(OperationalOfficeType::class, $operationalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operational_office_index');
        }

        return $this->render('operational_office/edit.html.twig', [
            'operational_office' => $operationalOffice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_office_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OperationalOffice $operationalOffice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$operationalOffice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationalOffice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operational_office_index');
    }
}
