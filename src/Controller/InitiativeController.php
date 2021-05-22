<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Form\InitiativeType;
use App\Repository\InitiativeRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/initiative")
 */
class InitiativeController extends AbstractController
{
    /**
     * @Route("/", name="initiative_index", methods={"GET","POST"})
     */
    public function index(InitiativeRepository $initiativeRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $initiative = new Initiative();
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $initiative->setCreatedAt(new DateTime('now'));
            $initiative->setCreatedBy($this->getUser());
            $entityManager->persist($initiative);
            $entityManager->flush();
            $this->addFlash('success',"initatives are added seccuss");
            return $this->redirectToRoute('initiative_index');
        }
        $data=$paginator->paginate(
            $initiativeRepository->findAll(),
            $request->query->getInt('page',1),
            10
        );
        return $this->render('initiative/index.html.twig', [
            'initiatives' => $data,
            'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/new", name="initiative_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $initiative = new Initiative();
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiative);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_index');
        }

        return $this->render('initiative/new.html.twig', [
            'initiative' => $initiative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_show", methods={"GET"})
     */
    public function show(Initiative $initiative): Response
    {
        return $this->render('initiative/show.html.twig', [
            'initiative' => $initiative,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Initiative $initiative): Response
    {
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('initiative_index');
        }

        return $this->render('initiative/edit.html.twig', [
            'initiative' => $initiative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Initiative $initiative): Response
    {
        if ($this->isCsrfTokenValid('delete'.$initiative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_index');
    }
}
