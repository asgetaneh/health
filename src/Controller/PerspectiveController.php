<?php

namespace App\Controller;

use App\Entity\Perspective;
use App\Form\PerspectiveType;
use App\Helper\Helper;
use App\Repository\PerspectiveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/perspective")
 */
class PerspectiveController extends AbstractController
{
    /**
     * @Route("/", name="perspective_index")
     */
    public function index(PerspectiveRepository $perspectiveRepository, Request $request): Response
    {
        $perspective = new Perspective();
        $form = $this->createForm(PerspectiveType::class, $perspective);
        $form->handleRequest($request);
            
        $locales= Helper::locales();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
             foreach ($locales as $key => $value) {
               $perspective->translate($value)->setName($request->request->get('perspective')[$value]);
              
               $perspective->translate($value)->setDescription($request->request->get('perspective')[$value]);
            }
            $perspective->setCreatedAt(new \DateTime());
            $perspective->setUsedToPlan(1);
            $perspective->setCreatedBy($this->getUser());
            $entityManager->persist($perspective);
            $perspective->mergeNewTranslations();
             
            $entityManager->flush();

          $this->addFlash('success',"successfuly registered");


            return $this->redirectToRoute('perspective_index');
        }

       
        return $this->render('perspective/index.html.twig', [
            'perspectives' => $perspectiveRepository->findAll(),
            'form' => $form->createView(),

        ]);
    }

    /**
     * @Route("/new", name="perspective_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $perspective = new Perspective();
        $form = $this->createForm(PerspectiveType::class, $perspective);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($perspective);
            $entityManager->flush();

            return $this->redirectToRoute('perspective_index');
        }

        return $this->render('perspective/new.html.twig', [
            'perspective' => $perspective,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="perspective_show", methods={"GET"})
     */
    public function show(Perspective $perspective): Response
    {
        return $this->render('perspective/show.html.twig', [
            'perspective' => $perspective,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="perspective_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Perspective $perspective): Response
    {
        $form = $this->createForm(PerspectiveType::class, $perspective);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('perspective_index');
        }

        return $this->render('perspective/edit.html.twig', [
            'perspective' => $perspective,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="perspective_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Perspective $perspective): Response
    {
        if ($this->isCsrfTokenValid('delete'.$perspective->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($perspective);
            $entityManager->flush();
        }

        return $this->redirectToRoute('perspective_index');
    }
}
