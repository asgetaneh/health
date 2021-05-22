<?php

namespace App\Controller;

use App\Entity\PrincipalManager;
use App\Form\PrincipalManagerType;
use App\Repository\PrincipalManagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/principal/manager")
 */
class PrincipalManagerController extends AbstractController
{
    /**
     * @Route("/", name="principal_manager_index", methods={"GET"})
     */
    public function index(PrincipalManagerRepository $principalManagerRepository): Response
    {
        return $this->render('principal_manager/index.html.twig', [
            'principal_managers' => $principalManagerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="principal_manager_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $principalManager = new PrincipalManager();
        $form = $this->createForm(PrincipalManagerType::class, $principalManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($principalManager);
            $entityManager->flush();

            return $this->redirectToRoute('principal_manager_index');
        }

        return $this->render('principal_manager/new.html.twig', [
            'principal_manager' => $principalManager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principal_manager_show", methods={"GET"})
     */
    public function show(PrincipalManager $principalManager): Response
    {
        return $this->render('principal_manager/show.html.twig', [
            'principal_manager' => $principalManager,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="principal_manager_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PrincipalManager $principalManager): Response
    {
        $form = $this->createForm(PrincipalManagerType::class, $principalManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('principal_manager_index');
        }

        return $this->render('principal_manager/edit.html.twig', [
            'principal_manager' => $principalManager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principal_manager_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PrincipalManager $principalManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$principalManager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principalManager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_manager_index');
    }
}
