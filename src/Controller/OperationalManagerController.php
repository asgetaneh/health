<?php

namespace App\Controller;

use App\Entity\OperationalManager;
use App\Form\OperationalManagerType;
use App\Repository\OperationalManagerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational/manager")
 */
class OperationalManagerController extends AbstractController
{
    /**
     * @Route("/", name="operational_manager_index", methods={"GET"})
     */
    public function index(OperationalManagerRepository $operationalManagerRepository): Response
    {
        return $this->render('operational_manager/index.html.twig', [
            'operational_managers' => $operationalManagerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="operational_manager_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $operationalManager = new OperationalManager();
        $form = $this->createForm(OperationalManagerType::class, $operationalManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operationalManager);
            $entityManager->flush();

            return $this->redirectToRoute('operational_manager_index');
        }

        return $this->render('operational_manager/new.html.twig', [
            'operational_manager' => $operationalManager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_manager_show", methods={"GET"})
     */
    public function show(OperationalManager $operationalManager): Response
    {
        return $this->render('operational_manager/show.html.twig', [
            'operational_manager' => $operationalManager,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="operational_manager_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OperationalManager $operationalManager): Response
    {
        $form = $this->createForm(OperationalManagerType::class, $operationalManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operational_manager_index');
        }

        return $this->render('operational_manager/edit.html.twig', [
            'operational_manager' => $operationalManager,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_manager_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OperationalManager $operationalManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$operationalManager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationalManager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operational_manager_index');
    }
}
