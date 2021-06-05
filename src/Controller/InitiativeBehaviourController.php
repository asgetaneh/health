<?php

namespace App\Controller;

use App\Entity\InitiativeBehaviour;
use App\Form\InitiativeBehaviourType;
use App\Helper\Helper;
use App\Repository\InitiativeBehaviourRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/initiative/behaviour")
 */
class InitiativeBehaviourController extends AbstractController
{
    /**
     * @Route("/", name="initiative_behaviour_index")
     */
    public function index(InitiativeBehaviourRepository $initiativeBehaviourRepository, Request $request): Response
    {
        $this->denyAccessUnlessGranted('vw_intv_bvr');
        $initiativeBehaviour = new InitiativeBehaviour();
        $form = $this->createForm(InitiativeBehaviourType::class, $initiativeBehaviour);
        $form->handleRequest($request);
        $locales = Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
             $this->denyAccessUnlessGranted('ad_intv_bvr');
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($locales as $key => $value) {
                $initiativeBehaviour->translate($value)->setName($request->request->get('initiative_behaviour')[$value]);

                $initiativeBehaviour->translate($value)->setDescription($request->request->get('initiative_behaviour')[$value."description"]);
            }
             $initiativeBehaviour->setCreatedAt(new DateTime('now'));
             $initiativeBehaviour->setCreatedBy($this->getUser());
            $entityManager->persist($initiativeBehaviour);
            $initiativeBehaviour->mergeNewTranslations();

            $entityManager->flush();

            $this->addFlash('success', "registered successfuly");
            return $this->redirectToRoute('initiative_behaviour_index');
        }
        return $this->render('initiative_behaviour/index.html.twig', [
            'initiative_behaviours' => $initiativeBehaviourRepository->findAll(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/new", name="initiative_behaviour_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $initiativeBehaviour = new InitiativeBehaviour();
        $form = $this->createForm(InitiativeBehaviourType::class, $initiativeBehaviour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($initiativeBehaviour);
            $entityManager->flush();

            return $this->redirectToRoute('initiative_behaviour_index');
        }

        return $this->render('initiative_behaviour/new.html.twig', [
            'initiative_behaviour' => $initiativeBehaviour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_behaviour_show", methods={"GET"})
     */
    public function show(InitiativeBehaviour $initiativeBehaviour): Response
    {
        return $this->render('initiative_behaviour/show.html.twig', [
            'initiative_behaviour' => $initiativeBehaviour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_behaviour_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, InitiativeBehaviour $initiativeBehaviour): Response
    {
        $form = $this->createForm(InitiativeBehaviourType::class, $initiativeBehaviour);
        $form->handleRequest($request);
           $locales=Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
             foreach ($locales as $key => $value) {
                $initiativeBehaviour->translate($value)->setName($request->request->get('initiative_behaviour')[$value]);

                $initiativeBehaviour->translate($value)->setDescription($request->request->get('initiative_behaviour')[$value."description"]);
            }
             $initiativeBehaviour->mergeNewTranslations();
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('initiative_behaviour_index');
        }

        return $this->render('initiative_behaviour/edit.html.twig', [
            'initiative_behaviour' => $initiativeBehaviour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="initiative_behaviour_delete", methods={"DELETE"})
     */
    public function delete(Request $request, InitiativeBehaviour $initiativeBehaviour): Response
    {
        if ($this->isCsrfTokenValid('delete' . $initiativeBehaviour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiativeBehaviour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_behaviour_index');
    }
}
