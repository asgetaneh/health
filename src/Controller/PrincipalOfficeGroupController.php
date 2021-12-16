<?php

namespace App\Controller;

use App\Entity\PrincipalOfficeGroup;
use App\Form\PrincipalOfficeGroupType;
use App\Repository\PrincipalOfficeGroupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/officegroup')]
class PrincipalOfficeGroupController extends AbstractController
{
    #[Route('/', name: 'principal_office_group_index', methods: ['GET'])]
    public function index(PrincipalOfficeGroupRepository $principalOfficeGroupRepository): Response
    {
        return $this->render('principal_office_group/index.html.twig', [
            'principal_office_groups' => $principalOfficeGroupRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'principal_office_group_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $principalOfficeGroup = new PrincipalOfficeGroup();
        $form = $this->createForm(PrincipalOfficeGroupType::class, $principalOfficeGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($principalOfficeGroup);
            $entityManager->flush();
             $this->addFlash('success', "new Principal office Category is added successfuly");

            return $this->redirectToRoute('principal_office_group_index');
        }

        return $this->render('principal_office_group/new.html.twig', [
            'principal_office_group' => $principalOfficeGroup,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'principal_office_group_show', methods: ['GET'])]
    public function show(PrincipalOfficeGroup $principalOfficeGroup): Response
    {
        return $this->render('principal_office_group/show.html.twig', [
            'principal_office_group' => $principalOfficeGroup,
        ]);
    }

    #[Route('/{id}/edit', name: 'principal_office_group_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PrincipalOfficeGroup $principalOfficeGroup): Response
    {
        $form = $this->createForm(PrincipalOfficeGroupType::class, $principalOfficeGroup);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
             $this->addFlash('success', "edited successfuly");

            return $this->redirectToRoute('principal_office_group_index');
        }

        return $this->render('principal_office_group/edit.html.twig', [
            'principal_office_group' => $principalOfficeGroup,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'principal_office_group_delete', methods: ['DELETE'])]
    public function delete(Request $request, PrincipalOfficeGroup $principalOfficeGroup): Response
    {
        if ($this->isCsrfTokenValid('delete'.$principalOfficeGroup->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principalOfficeGroup);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_office_group_index');
    }
}
