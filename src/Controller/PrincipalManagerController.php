<?php

namespace App\Controller;

use App\Entity\PrincipalManager;
use App\Entity\PrincipalOffice;
use App\Entity\User;
use App\Entity\UserGroup;
use App\Form\PrincipalManagerType;
use App\Repository\PrincipalManagerRepository;
use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/principal/manager")
 */
class PrincipalManagerController extends AbstractController
{
    /**
     * @Route("/", name="principal_manager_index", methods={"GET","POST"})
     */
    public function index(PrincipalManagerRepository $principalManagerRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_pr_mng');
        $principalManager = new PrincipalManager();
        $form = $this->createForm(PrincipalManagerType::class, $principalManager);
        $form->handleRequest($request);
        $filterForm = $this->createFormBuilder()
            ->setMethod('Get')

            ->add('principaloffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                'multiple' => true,
                'required' => false,
            ])->getForm();
        $filterForm->handleRequest($request);
        $session = new Session();
        $session->remove('filter');
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $isAlreadyAssigned = $principalManagerRepository->findActive($form->getData()->getPrincipalOffice(), $form->getData()->getPrincipal());
            $isActivePrincipal = $principalManagerRepository->findActive($form->getData()->getPrincipalOffice(), null);

            if ($isAlreadyAssigned) {
                $this->addFlash('danger', "this principal is already assigned to this office");

                return $this->redirectToRoute('principal_manager_index');
            }
            if ($isActivePrincipal) {
                $this->addFlash('danger', "sorry unable to assign !! the other principal is already assigned to this office");

                return $this->redirectToRoute('principal_manager_index');
            }

            $user = $form->getData()->getPrincipal()->getId();

            $userGroup = $entityManager->getRepository(UserGroup::class)->findOneBy(['name' => "Principal Managers"]);
            $userGroupcas = $entityManager->getRepository(UserGroup::class)->findOneBy(['name' => "cascading"]);

            $users = $entityManager->getRepository(User::class)->findBy(['id' => $user]);
            foreach ($users as $user) {
                $userGroup->addUser($user);
            }
            $userGroup->setUpdatedAt(new \DateTime());
            $userGroup->setUpdatedBy($this->getUser());
            foreach ($users as $user) {
                $userGroupcas->addUser($user);
            }
            $userGroupcas->setUpdatedAt(new \DateTime());
            $userGroupcas->setUpdatedBy($this->getUser());
            $principalManager->setAssignedAt(new DateTime('now'));
            $principalManager->setAssignedBy($this->getUser());
            $entityManager->persist($principalManager);
            $entityManager->flush();
            $this->addFlash('success', "new Principal manager  is assigned successfuly");

            return $this->redirectToRoute('principal_manager_index');
        }

        if ($request->request->get('deactive')) {
            $this->denyAccessUnlessGranted('deact_pr_mng');

            $principalManager = $principalManagerRepository->find($request->request->get('deactive'));
            $principalManager->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
            return $this->redirectToRoute('principal_manager_index');
        }
        if ($request->request->get('active')) {
            $this->denyAccessUnlessGranted('act_pr_mng');

            $principalManager = $principalManagerRepository->find($request->request->get('active'));
            $isActivePrincipal = $principalManagerRepository->findActive($principalManager->getPrincipalOffice(), null);
            if ($isActivePrincipal) {
                $this->addFlash('danger', "sorry unable to activate! b/c this office have active principal officer");

                return $this->redirectToRoute('principal_manager_index');
            }
            $principalManager->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
            return $this->redirectToRoute('principal_manager_index');
        }
        $count = $principalManagerRepository->findAll();

        if ($request->query->get('search')) {
            $session->set('filter', ['name' => $request->query->get('search')]);

            $query = $principalManagerRepository->search(['name' => $request->query->get('search')]);
        } elseif ($filterForm->isSubmitted() && $filterForm->isValid()) {
            $session->set('filter', $filterForm->getData());
            $query =  $principalManagerRepository->search($filterForm->getData());
        } else
            $query = $principalManagerRepository->findAll();

        // $data =$query;
        $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10

        );
        return $this->render('principal_manager/index.html.twig', [
            'principal_managers' =>  $data,
            'form' => $form->createView(),
            'filterform' => $filterForm->createView(),
            'totalcount' => $count

        ]);
    }
    /**
     * @Route("/print", name="print_principal", methods={"GET","POST"})
     */

    public function print(Request $request, PaginatorInterface $paginator, PrincipalManagerRepository $principalManagerRepository)
    {
        $session = new Session();
        // $em = $this->getDoctrine()->getManager();
        $entityManager = $this->getDoctrine()->getManager();
        if ($session->get('filter')) {

            $initiativestotal  = $principalManagerRepository->search($session->get('filter'))->getResult();
        } else
            $initiativestotal = $principalManagerRepository->findAll();


        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->setIsHtml5ParserEnabled(true);
        $dompdf = new Dompdf($pdfOptions);

        $res = $this->renderView('principal_manager/print.html.twig', [
            'principal_managers' => $initiativestotal,
            // 'year' => $year


        ]);

        $dompdf->loadHtml($res);
        $dompdf->setPaper('A4', 'Landscape');

        // Render the HTML as PDF
        $dompdf->render();
        $dompdf->stream("principal manager.pdf", [
            "Attachment" => false
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

        if ($this->isCsrfTokenValid('delete' . $principalManager->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principalManager);
            $entityManager->flush();
            $this->addFlash('success', "Delete successfuly");
        }

        return $this->redirectToRoute('principal_manager_index');
    }
}
