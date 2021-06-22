<?php

namespace App\Controller;

use App\Entity\FeedBack;
use App\Form\FeedBackType;
use App\Repository\FeedBackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/feed/back")
 */
class FeedBackController extends AbstractController
{
    /**
     * @Route("/", name="feed_back_index", methods={"GET"})
     */
    public function index(FeedBackRepository $feedBackRepository): Response
    {
        return $this->render('feed_back/index.html.twig', [
            'feed_back' => $feedBackRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="feed_back_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $feedBack = new FeedBack();
        $form = $this->createForm(FeedBackType::class, $feedBack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($feedBack);
            $entityManager->flush();

            return $this->redirectToRoute('feed_back_new');
        }

        return $this->render('feed_back/new.html.twig', [
            'feed_back' => $feedBack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="feed_back_show", methods={"GET"})
     */
    public function show(FeedBack $feedBack): Response
    {
        return $this->render('feed_back/show.html.twig', [
            'feed_back' => $feedBack,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="feed_back_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FeedBack $feedBack): Response
    {
        $form = $this->createForm(FeedBackType::class, $feedBack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('feed_back_index');
        }

        return $this->render('feed_back/edit.html.twig', [
            'feed_back' => $feedBack,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="feed_back_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FeedBack $feedBack): Response
    {
        if ($this->isCsrfTokenValid('delete'.$feedBack->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($feedBack);
            $entityManager->flush();
        }

        return $this->redirectToRoute('feed_back_index');
    }
}
