<?php

namespace App\Controller;

use App\Entity\OperationalManager;
use App\Form\OperationalManagerType;
use App\Repository\OperationalManagerRepository;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/", name="operational_manager_index", methods={"GET","POST"})
     */
    public function index(OperationalManagerRepository $operationalManagerRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $operationalManager = new OperationalManager();
        $form = $this->createForm(OperationalManagerType::class, $operationalManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

             $isAlreadyAssigned=$operationalManagerRepository->findActive($form->getData()->getOperationalOffice(),$form->getData()->getManager());
             $isActivePrincipal=$operationalManagerRepository->findActive($form->getData()->getOperationalOffice(),null);
            
             if ($isAlreadyAssigned) {
                  $this->addFlash('danger'," operational manager  is already assigned to this office");

                     return $this->redirectToRoute('operational_manager_index');
             }
             if ($isActivePrincipal) {
                  $this->addFlash('danger',"sorry unable to assign! the other operational manager  is already assigned to this office");

                     return $this->redirectToRoute('operational_manager_index');
             }

            $entityManager->persist($operationalManager);
            $entityManager->flush();

             $this->addFlash('success',"operational manager is assigned  successfuly");

            return $this->redirectToRoute('operational_manager_index');
        }
         if($request->request->get('deactive')){
            $operationalManager=$operationalManagerRepository->find($request->request->get('deactive'));
            $operationalManager->setIsActive(false);
              $this->getDoctrine()->getManager()->flush();
               $this->addFlash('success',"deactivated successfuly");
              return $this->redirectToRoute('operational_manager_index');
           
        }
          if($request->request->get('active')){
            $operationalManager=$operationalManagerRepository->find($request->request->get('active'));
           
              $isActivePrincipal=$operationalManagerRepository->findActive($operationalManager->getOperationalOffice(),null);
               if ($isActivePrincipal) {
                  $this->addFlash('danger',"sorry unable to activate! b/c this office has Active operational manager");

                     return $this->redirectToRoute('operational_manager_index');
                  }
            $operationalManager->setIsActive(true);
              $this->getDoctrine()->getManager()->flush();
               $this->addFlash('success',"activated successfuly");
              return $this->redirectToRoute('operational_manager_index');
           
         }
           $data=$paginator->paginate(
             $operationalManagerRepository->findAll(),
             $request->query->getInt('page',1),
             10

        );
        return $this->render('operational_manager/index.html.twig', [
            'operational_managers' => $data,
            'form'=>$form->createView()
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
