<?php

namespace App\Controller;

use App\Entity\OperationalOffice;
use App\Entity\PrincipalOffice;
use App\Form\OperationalOfficeType;
use App\Repository\OperationalOfficeRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/operational/office")
 */
class OperationalOfficeController extends AbstractController
{
    /**
     * @Route("/", name="operational_office_index", methods={"GET","POST"})
     */
    public function index(OperationalOfficeRepository $operationalOfficeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_opof');
        $filterForm=$this->createFormBuilder()
         ->setMethod('Get')
        ->add('principaloffice',EntityType::class,[
            'class'=>PrincipalOffice::class,
            'multiple'=>true
        ])->getForm();
        $filterForm->handleRequest($request);



        $operationalOffice = new OperationalOffice();
        $form = $this->createForm(OperationalOfficeType::class, $operationalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->denyAccessUnlessGranted('ad_opof');

            $entityManager = $this->getDoctrine()->getManager();
            $operationalOffice->setCreatedAt(new DateTime('now'));
            $operationalOffice->setCreatedBy($this->getUser());
            $entityManager->persist($operationalOffice);
            $entityManager->flush();
            $this->addFlash('success', "registered successfuly");

            return $this->redirectToRoute('operational_office_index');
        }
        if ($request->request->get('deactive')) {
            $this->denyAccessUnlessGranted('deact_opof');

            $operationalOffice = $operationalOfficeRepository->find($request->request->get('deactive'));
            $operationalOffice->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
            return $this->redirectToRoute('operational_office_index');
        }
        if ($request->request->get('active')) {
            $this->denyAccessUnlessGranted('act_opof');

            $operationalOffice = $operationalOfficeRepository->find($request->request->get('active'));
            $operationalOffice->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
            return $this->redirectToRoute('operational_office_index');
        }
        if ($request->query->get('search')) {
            $query = $operationalOfficeRepository->search(['name' => $request->query->get('search')]);
        } 
        elseif($filterForm->isSubmitted() && $filterForm->isValid()){
            // dd($filterForm->getData()['principaloffice']);
              $query = $operationalOfficeRepository->search($filterForm->getData());
        }
        else
            $query = $operationalOfficeRepository->findAll();
        $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10

        );

        return $this->render('operational_office/index.html.twig', [
            'operational_offices' => $data,

            'form' => $form->createView(),
            'filterform'=>$filterForm->createView()
        ]);
    }

    /**
     * @Route("/new", name="operational_office_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ad_opof');

        $operationalOffice = new OperationalOffice();
        $form = $this->createForm(OperationalOfficeType::class, $operationalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($operationalOffice);
            $entityManager->flush();

            return $this->redirectToRoute('operational_office_index');
        }

        return $this->render('operational_office/new.html.twig', [
            'operational_office' => $operationalOffice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_office_show", methods={"GET"})
     */
    public function show(OperationalOffice $operationalOffice): Response
    {
        $this->denyAccessUnlessGranted('vw_opof_dtl');

        return $this->render('operational_office/show.html.twig', [
            'operational_office' => $operationalOffice,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="operational_office_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, OperationalOffice $operationalOffice): Response
    {
        $this->denyAccessUnlessGranted('edt_opof');

        $form = $this->createForm(OperationalOfficeType::class, $operationalOffice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('operational_office_index');
        }

        return $this->render('operational_office/edit.html.twig', [
            'operational_office' => $operationalOffice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="operational_office_delete", methods={"DELETE"})
     */
    public function delete(Request $request, OperationalOffice $operationalOffice): Response
    {
        $this->denyAccessUnlessGranted('dlt_opof');

        if ($this->isCsrfTokenValid('delete' . $operationalOffice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($operationalOffice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('operational_office_index');
    }
}
