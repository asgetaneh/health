<?php

namespace App\Controller;

use App\Entity\PrincipalManager;
use App\Form\PrincipalManagerType;
use App\Repository\PrincipalManagerRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/", name="principal_manager_index", methods={"GET","POST"})
     */
    public function index(PrincipalManagerRepository $principalManagerRepository,Request $request,PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_pr_mng');
     $principalManager = new PrincipalManager();
        $form = $this->createForm(PrincipalManagerType::class, $principalManager);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
        
             $isAlreadyAssigned=$principalManagerRepository->findActive($form->getData()->getPrincipalOffice(),$form->getData()->getPrincipal());
             $isActivePrincipal=$principalManagerRepository->findActive($form->getData()->getPrincipalOffice(),null);
            
             if ($isAlreadyAssigned) {
                  $this->addFlash('danger',"this principal is already assigned to this office");

                     return $this->redirectToRoute('principal_manager_index');
             }
             if ($isActivePrincipal) {
                  $this->addFlash('danger',"sorry unable to assign !! the other principal is already assigned to this office");

                     return $this->redirectToRoute('principal_manager_index');
             }


            $principalManager->setAssignedAt(new DateTime('now'));
            $principalManager->setAssignedBy($this->getUser());
            $entityManager->persist($principalManager);
            $entityManager->flush();
             $this->addFlash('success',"new Principal manager  is assigned successfuly");

            return $this->redirectToRoute('principal_manager_index');
        }

        if($request->request->get('deactive')){
                    $this->denyAccessUnlessGranted('deact_pr_mng');

            $principalManager=$principalManagerRepository->find($request->request->get('deactive'));
            $principalManager->setIsActive(false);
              $this->getDoctrine()->getManager()->flush();
               $this->addFlash('success',"deactivated successfuly");
                return $this->redirectToRoute('principal_manager_index');
           
        }
         if($request->request->get('active')){
                     $this->denyAccessUnlessGranted('act_pr_mng');

              $principalManager=$principalManagerRepository->find($request->request->get('active'));
              $isActivePrincipal=$principalManagerRepository->findActive($principalManager->getPrincipalOffice(),null);
               if ($isActivePrincipal) {
                  $this->addFlash('danger',"sorry unable to activate! b/c this office have active principal officer");

                     return $this->redirectToRoute('principal_manager_index');
                  }
              $principalManager->setIsActive(true);
              $this->getDoctrine()->getManager()->flush();
               $this->addFlash('success',"activated successfuly");
                return $this->redirectToRoute('principal_manager_index');
           
        }

        $data=$paginator->paginate(
             $principalManagerRepository->findAll(),
             $request->query->getInt('page',1),
             10

        );
        return $this->render('principal_manager/index.html.twig', [
            'principal_managers' =>  $data,
             'form'=>$form->createView()
        ]);
    }

    /**
     * @Route("/new", name="principal_manager_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
                $this->denyAccessUnlessGranted('ad_pr_mng');

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
                $this->denyAccessUnlessGranted('vw_pr_mng_dtl');

        return $this->render('principal_manager/show.html.twig', [
            'principal_manager' => $principalManager,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="principal_manager_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PrincipalManager $principalManager): Response
    {
                $this->denyAccessUnlessGranted('edt_pr_mng');

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
                $this->denyAccessUnlessGranted('dlt_pr_mng');

        if ($this->isCsrfTokenValid('delete'.$principalManager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principalManager);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_manager_index');
    }
}
