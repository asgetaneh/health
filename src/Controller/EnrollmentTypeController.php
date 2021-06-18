<?php

namespace App\Controller;

use App\Entity\EnrollmentType;
use App\Form\EnrollmentTypeType;
use App\Repository\EnrollmentTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/enrollment/type")
 */
class EnrollmentTypeController extends AbstractController
{
    /**
     * @Route("/", name="enrollment_type_index", methods={"GET"})
     */
    public function index(EnrollmentTypeRepository $enrollmentTypeRepository): Response
    {
        return $this->render('enrollment_type/index.html.twig', [
            'enrollment_types' => $enrollmentTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="enrollment_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $enrollmentType = new EnrollmentType();
        $form = $this->createForm(EnrollmentTypeType::class, $enrollmentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($enrollmentType);
            $entityManager->flush();

            return $this->redirectToRoute('enrollment_type_index');
        }

        return $this->render('enrollment_type/new.html.twig', [
            'enrollment_type' => $enrollmentType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enrollment_type_show", methods={"GET"})
     */
    public function show(EnrollmentType $enrollmentType): Response
    {
        return $this->render('enrollment_type/show.html.twig', [
            'enrollment_type' => $enrollmentType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="enrollment_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EnrollmentType $enrollmentType): Response
    {
        $form = $this->createForm(EnrollmentTypeType::class, $enrollmentType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enrollment_type_index');
        }

        return $this->render('enrollment_type/edit.html.twig', [
            'enrollment_type' => $enrollmentType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="enrollment_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EnrollmentType $enrollmentType): Response
    {
        if ($this->isCsrfTokenValid('delete'.$enrollmentType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($enrollmentType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('enrollment_type_index');
    }
}
