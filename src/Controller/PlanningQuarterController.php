<?php

namespace App\Controller;

use Andegna\DateTimeFactory;
use App\Entity\PlanningQuarter;
use App\Form\PlanningQuarterType;
use App\Helper\AmharicHelper;
use App\Repository\PlanningQuarterRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planning-quarter")
 */
class PlanningQuarterController extends AbstractController
{
    /**
     * @Route("/", name="planning_quarter_index", methods={"GET"})
     */
    public function index(PlanningQuarterRepository $planningQuarterRepository): Response
    {
        return $this->render('planning_quarter/index.html.twig', [
            'planning_quarters' => $planningQuarterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="planning_quarter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planningQuarter = new PlanningQuarter();
        $form = $this->createForm(PlanningQuarterType::class, $planningQuarter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
           $data= $form->getData();
           $startDate=$request->request->get("startDate");
           $endDate=$request->request->get("endDate");
           $startDate=explode('/',$startDate);
            $endDate=explode('/',$endDate);
           
            $planningQuarter->setStartDay(1);
            $planningQuarter->setEndDay(30);
            $planningQuarter->setStartMonth(11);
            $planningQuarter->setEndMonth(1);

           
            $startYear=AmharicHelper::getCurrentYear();
            $endYear=AmharicHelper::getCurrentYear();

            if($planningQuarter->getStartMonth() > $planningQuarter->getEndMonth()){
                $endYear++;
            }
            $startDate1=DateTimeFactory::of($startYear,$planningQuarter->getStartMonth() ,$planningQuarter->getStartDay());
           $endDate1=DateTimeFactory::of($endYear, $planningQuarter->getEndMonth(), $planningQuarter->getEndDay());
            $gergorianStart = AmharicHelper::fromEthtoGre($startDate1);
            $gergorianEnd = AmharicHelper::fromEthtoGre($endDate1);
            $planningQuarter->setStartDate($gergorianStart);
            $planningQuarter->setEndDate($gergorianEnd);
            $planningQuarter->setCreatedAt(new DateTime('now'));
            $planningQuarter->setCreatedBy($this->getUser());
            $entityManager->persist($planningQuarter);
            $entityManager->flush();

            return $this->redirectToRoute('planning_quarter_index');
        }

        return $this->render('planning_quarter/new.html.twig', [
            'planning_quarter' => $planningQuarter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/regenerate", name="planning_quarter_regenerate")
     */
    public function regenerate(PlanningQuarterRepository $planningQuarterRepository): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
       foreach ($planningQuarterRepository->findAll() as $key => $planningQuarter) {
           
           
            $startYear=AmharicHelper::getCurrentYear()+1;
            $endYear=AmharicHelper::getCurrentYear()+1;
           
            if($planningQuarter->getStartMonth() > $planningQuarter->getEndMonth()){
                $startYear--;
            }
            $startDate1=DateTimeFactory::of($startYear,$planningQuarter->getStartMonth() ,$planningQuarter->getStartDay());
           $endDate1=DateTimeFactory::of($endYear, $planningQuarter->getEndMonth(), $planningQuarter->getEndDay());
            $gergorianStart = AmharicHelper::fromEthtoGre($startDate1);
            $gergorianEnd = AmharicHelper::fromEthtoGre($endDate1);
            $planningQuarter->setStartDate($gergorianStart);
            $planningQuarter->setEndDate($gergorianEnd);
            $entityManager->flush();
            
       }
    //      foreach ($planningQuarterRepository->findAll() as $key => $planningQuarter) {
           
           
    //       dump(AmharicHelper::fromGretoEthstr($planningQuarter->getStartDate()),AmharicHelper::fromGretoEthstr($planningQuarter->getEndDate()));
            
    //    }
    //    dd("sfd");
       return $this->redirectToRoute('planning_quarter_index');
    }


    /**
     * @Route("/{id}", name="planning_quarter_show", methods={"GET"})
     */
    public function show(PlanningQuarter $planningQuarter): Response
    {
        return $this->render('planning_quarter/show.html.twig', [
            'planning_quarter' => $planningQuarter,
        ]);
    }
    
    /**
     * @Route("/{id}/edit", name="planning_quarter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanningQuarter $planningQuarter): Response
    {
        $form = $this->createForm(PlanningQuarterType::class, $planningQuarter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planning_quarter_index');
        }

        return $this->render('planning_quarter/edit.html.twig', [
            'planning_quarter' => $planningQuarter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_quarter_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanningQuarter $planningQuarter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$planningQuarter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planningQuarter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_quarter_index');
    }
}
