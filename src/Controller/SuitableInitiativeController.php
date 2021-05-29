<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\SuitableInitiative;
use App\Form\SuitableInitiativeType;
use App\Repository\PlanningQuarterRepository;
use App\Repository\SuitableInitiativeRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/suitable/initiative")
 */
class SuitableInitiativeController extends AbstractController
{
    /**
     * @Route("/", name="suitable_initiative_index", methods={"GET","POST"})
     */
    public function index(SuitableInitiativeRepository $suitableInitiativeRepository,Request $request): Response
    {
       $filterForm=$this->createFormBuilder()
       ->add("planyear",EntityType::class,[
           'class'=>PlanningYear::class,
           'multiple' => true,
           'placeholder' => 'Choose an planning year',
           'required'=>false,

       ])
        ->add("initiative",EntityType::class,[
           'class'=>Initiative::class,
           'multiple' => true,
           'placeholder' => 'Choose an planning year',
           'required'=>false,

       ])
       ->add('principaloffice',EntityType::class,[
           'class'=>PrincipalOffice::class,
            'multiple' => true,
            'required'=>false,
            
              'placeholder' => 'Choose an principal office',
       ])->getForm();
       $filterForm->handleRequest($request);
       if($filterForm->isSubmitted()&& $filterForm->isValid()){
         
           $suitableInitiatives=$suitableInitiativeRepository->search($filterForm->getData());
        
        }
        else
         $suitableInitiatives=$suitableInitiativeRepository->findAll();
       
        return $this->render('suitable_initiative/index.html.twig', [
            'suitable_initiatives' => $suitableInitiatives,
            'filterform'=>$filterForm->createView()
        ]);
    }

    /**
     * @Route("/new", name="suitable_initiative_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $suitableInitiative = new SuitableInitiative();
        $form = $this->createForm(SuitableInitiativeType::class, $suitableInitiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($suitableInitiative);
            $entityManager->flush();

            return $this->redirectToRoute('suitable_initiative_index');
        }

        return $this->render('suitable_initiative/new.html.twig', [
            'suitable_initiative' => $suitableInitiative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="suitable_initiative_show", methods={"GET"})
     */
    public function show(SuitableInitiative $suitableInitiative,PlanningQuarterRepository $planningQuarterRepository): Response
    {
         $quarter=$planningQuarterRepository->findAll();
        return $this->render('suitable_initiative/show.html.twig', [
            'suitable_initiative' => $suitableInitiative,
            'quarters'=>$quarter
        ]);
    }

    /**
     * @Route("/{id}/edit", name="suitable_initiative_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SuitableInitiative $suitableInitiative): Response
    {
        $form = $this->createForm(SuitableInitiativeType::class, $suitableInitiative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('suitable_initiative_index');
        }

        return $this->render('suitable_initiative/edit.html.twig', [
            'suitable_initiative' => $suitableInitiative,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="suitable_initiative_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SuitableInitiative $suitableInitiative): Response
    {
        if ($this->isCsrfTokenValid('delete'.$suitableInitiative->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($suitableInitiative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('suitable_initiative_index');
    }
}
