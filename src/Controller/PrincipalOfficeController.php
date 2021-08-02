<?php

namespace App\Controller;

use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Form\PrincipalOfficeType;
use App\Repository\PrincipalOfficeRepository;
use DateTime;
use Knp\Component\Pager\Paginator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @Route("/principal/office")
 */
class PrincipalOfficeController extends AbstractController
{
    /**
     * @Route("/", name="principal_office_index", methods={"GET","POST"})
     */
    public function index(PrincipalOfficeRepository $principalOfficeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_pof');
        $filterForm = $this->createFormBuilder()
            ->setMethod('Get')
            ->add('principaloffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                'multiple' => true,
                'required'=>false
            ])->getForm();
        $filterForm->handleRequest($request);
        $principalOffice = new PrincipalOffice();
        $form = $this->createForm(PrincipalOfficeType::class, $principalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->denyAccessUnlessGranted('ad_pof');
            $entityManager = $this->getDoctrine()->getManager();
            $principalOffice->setCreateAt(new DateTime('now'));
            $principalOffice->setCreatedBy($this->getUser());
            $entityManager->persist($principalOffice);
            $entityManager->flush();
            $this->addFlash('success', "new Principal office is added successfuly");

            return $this->redirectToRoute('principal_office_index');
        }
        if ($request->request->get('deactive')) {
            $this->denyAccessUnlessGranted('deact_pof');
            $principalOffice =  $principalOfficeRepository->find($request->request->get('deactive'));
            $principalOffice->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
            return $this->redirectToRoute('principal_office_index');
        }
        if ($request->request->get('active')) {
            $this->denyAccessUnlessGranted('act_pof');
            $principalOffice =  $principalOfficeRepository->find($request->request->get('active'));
            $principalOffice->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
            return $this->redirectToRoute('principal_office_index');
        }

        $principal_officestotal = $principalOfficeRepository->findAll();
        if ($request->query->get('search')) {
            $query = $principalOfficeRepository->search(['name' => $request->query->get('search')]);
        } elseif ($filterForm->isSubmitted() && $filterForm->isValid()) {
            // dd($filterForm->getData()['principaloffice']);
            $query = $principalOfficeRepository->search($filterForm->getData());
        } else{
            $query = $principalOfficeRepository->findAll();}
        $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10

        );
        return $this->render('principal_office/index.html.twig', [
            'principal_offices' => $data,
            'principal_officestotal' => $principal_officestotal,
            'form' => $form->createView(),
            'filterform' => $filterForm->createView()

        ]);
    }

    /**
     * @Route("/plan", name="principal_office_plan", methods={"GET","POST"})
     */
    public function new(Request $request, PaginatorInterface $paginator, PrincipalOfficeRepository $principalOfficeRepository): Response
    {
        //  $this->denyAccessUnlessGranted('ad_pof');
        $entityManager = $this->getDoctrine()->getManager();
        $year = $entityManager->getRepository(PlanningYear::class)->findLast();

        $plan = $principalOfficeRepository->findPlannedOffice($year);


        $data = $paginator->paginate(
            $plan,
            $request->query->getInt('page', 1),
            10

        );
        return $this->render('principal_office/new.html.twig', [
            'principal_offices' => $data,
            'year' => $year

        ]);
    }

    /**
     * @Route("/{id}", name="principal_office_show", methods={"GET"})
     */
    public function show(PrincipalOffice $principalOffice): Response
    {
        $this->denyAccessUnlessGranted('vw_pof_dtl');
        return $this->render('principal_office/show.html.twig', [
            'principal_office' => $principalOffice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="principal_office_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PrincipalOffice $principalOffice): Response
    {
        $this->denyAccessUnlessGranted('edt_pof');
        $form = $this->createForm(PrincipalOfficeType::class, $principalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('principal_office_index');
        }

        return $this->render('principal_office/edit.html.twig', [
            'principal_office' => $principalOffice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="principal_office_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PrincipalOffice $principalOffice): Response
    {
        $this->denyAccessUnlessGranted('dlt_pof');
        if ($this->isCsrfTokenValid('delete' . $principalOffice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($principalOffice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('principal_office_index');
    }
}
