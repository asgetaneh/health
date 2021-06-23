<?php

namespace App\Controller;

use App\Entity\Delegation;
use App\Form\DelegationType;
use App\Repository\DelegationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/delegation")
 */
class DelegationController extends AbstractController
{
    /**
     * @Route("/", name="delegation_index")
     */
    public function index(DelegationRepository $delegationRepository,Request $request,PaginatorInterface $paginator): Response
    {
        if ($this->isGranted('vw_all_dlg')) {
        $delegations=$delegationRepository->findAlls();
        }
        else
        $delegations=$delegationRepository->findAllByUser($this->getUser());
        

      
        $data = $paginator->paginate(
           $delegations,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('delegation/index.html.twig', [
            'delegations' =>$data,
        ]);
    }
    /**
     * @Route("/return", name="delegation_return")
     */
    public function return(Request $request)
    {
       $em=$this->getDoctrine()->getManager();
       $delegation=$em->getRepository(Delegation::class)->find($request->request->get("delegation_id"));
       $delegation->setStatus(0);
       $em->flush();
        // dd($delegation);
                  return $this->redirectToRoute('delegation_index');

    }
    
    /**
     * @Route("/new", name="delegation_new", methods={"GET","POST"})
     */
    public function new(Request $request, DelegationRepository $delegationRepository): Response
    {  
        $userId=$this->getUser()->getId();
        $delegation = new Delegation();
        $form = $this->createForm(DelegationType::class, $delegation,['user'=>$userId]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $ise = $delegationRepository->findByUser($this->getUser());
           
            if ($ise) {
                $this->addFlash('danger', "sorry you have already active delegation");

                return $this->redirectToRoute('delegation_new');
            }
            $delegation->setDelegatedBy($this->getUser());
           $delegation->setStatus(1);
            $entityManager->persist($delegation);
            $entityManager->flush();
            $this->addFlash('success', "you delegate successfuly");

             return $this->redirectToRoute('delegation_new');
        }
        $delegations=$delegationRepository->findByUser($this->getUser());

        return $this->render('delegation/new.html.twig', [
            'delegations' => $delegations,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delegation_show", methods={"GET"})
     */
    public function show(Delegation $delegation): Response
    {
        return $this->render('delegation/show.html.twig', [
            'delegation' => $delegation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="delegation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Delegation $delegation): Response
    {
        $form = $this->createForm(DelegationType::class, $delegation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('delegation_index');
        }

        return $this->render('delegation/edit.html.twig', [
            'delegation' => $delegation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="delegation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Delegation $delegation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $delegation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($delegation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('delegation_index');
    }
}
