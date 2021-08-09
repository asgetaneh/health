<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\Initiative;
use App\Entity\InitiativeAttribute;
use App\Entity\InitiativeCategory;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\Objective;
use App\Entity\Perspective;
use App\Entity\PrincipalOffice;
use App\Entity\Strategy;
use App\Form\InitiativeType;
use App\Helper\Helper;
use App\Repository\InitiativeRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * @Route("/initiative")
 */
class InitiativeController extends AbstractController
{
    /**
     * @Route("/", name="initiative_index", methods={"GET","POST"})
     */
    public function index(InitiativeRepository $initiativeRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('vw_intv');

        $initiative = new Initiative();
        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);
        $locales = Helper::locales();
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            foreach ($locales as $key => $value) {
                $initiative->translate($value)->setName($request->request->get('initiative')[$value]);

                $initiative->translate($value)->setDescription($request->request->get('initiative')[$value."description"]);
            }
            $initiative->setCreatedAt(new DateTime('now'));
            $initiative->setCreatedBy($this->getUser());
            $entityManager->persist($initiative);
            $initiative->mergeNewTranslations();
            $entityManager->flush();

            $this->addFlash('success', "initatives are added seccussfuly");
            return $this->redirectToRoute('initiative_index');
        }
        $filterform = $this->createFormBuilder()
           ->setMethod('Get')
            ->add('goal', EntityType::class, [
                'class' => Goal::class,
                'multiple' => true,
                'required' => false
            ])
            
            ->add('objective', EntityType::class, [
                'class' => Objective::class,
                'multiple' => true,
                'required' => false

            ])
            ->add('perspective', EntityType::class, [
                'class' => Perspective::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('strategy', EntityType::class, [
                'class' => Strategy::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('kpi', EntityType::class, [
                'class' => KeyPerformanceIndicator::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('principaloffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('category', EntityType::class, [
                'class' => InitiativeCategory::class,
                'multiple' => true,
                'required' => false,

            ])
            ->getForm();










        if ($request->request->get('deactive')) {
            $this->denyAccessUnlessGranted('deact_intv');

            $initiatives = $initiativeRepository->find($request->request->get('deactive'));
            $initiatives->setIsActive(false);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "deactivated successfuly");
            return $this->redirectToRoute('initiative_index');
        }
        if ($request->request->get('active')) {
            $this->denyAccessUnlessGranted('act_intv');

            $initiatives = $initiativeRepository->find($request->request->get('active'));
            $initiatives->setIsActive(true);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "activated successfuly");
            return $this->redirectToRoute('initiative_index');
        }

        $filterform->handleRequest($request);

        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $initiatives = $initiativeRepository->search($filterform->getData());
        } elseif ($request->query->get('search')) {
           
            $initiatives = $initiativeRepository->search(['name' =>$request->query->get('search')]);
        } else
            $initiatives = $initiativeRepository->findAlls();
            $initiativestotal = $initiativeRepository->findAll();

        $data = $paginator->paginate(
            $initiatives,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('initiative/index.html.twig', [
            'initiatives' => $data,
            'initiativestotal'=>$initiativestotal,
            'form' => $form->createView(),
            'filterform' => $filterform->createView(),
        ]);
    }

    /**
     * @Route("/new", name="initiative_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ad_intv');

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
        $this->denyAccessUnlessGranted('vw_intv_dtl');

        return $this->render('initiative/show.html.twig', [
            'initiative' => $initiative,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="initiative_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Initiative $initiative): Response
    {
        $this->denyAccessUnlessGranted('edt_intv');

        $form = $this->createForm(InitiativeType::class, $initiative);
        $form->handleRequest($request);
        $locales = Helper::locales();

        if ($form->isSubmitted() && $form->isValid()) {
           
            foreach ($locales as $key => $value) {
                $initiative->translate($value)->setName($request->request->get('initiative')[$value]);

                $initiative->translate($value)->setDescription($request->request->get('initiative')[$value."description"]);
            }
            $initiative->mergeNewTranslations();

            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('success', "edited successfuly");

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
        $this->denyAccessUnlessGranted('dlt_intv');

        if ($this->isCsrfTokenValid('delete' . $initiative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($initiative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('initiative_index');
    }
}
