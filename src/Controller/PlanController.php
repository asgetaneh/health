<?php

namespace App\Controller;

use App\Entity\Initiative;
use App\Entity\Plan;
use App\Entity\PlanningPhase;
use App\Entity\PrincipalOffice;
use App\Form\PlanType;
use App\Repository\PlanRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plan")
 */
class PlanController extends AbstractController
{
    /**
     * @Route("/", name="plan_index", methods={"GET","POST"})
     */
    public function index(PlanRepository $planRepository,Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $offices=$em->getRepository(PrincipalOffice::class)->findOfficeByUser($this->getUser());
        $activePlanningPhase=$em->getRepository(PlanningPhase::class)->findBy(['isActive'=>1]);
        if ($request->request->get('office') && $request->request->get('phase')) {
            $planningphase=$em->getRepository(PlanningPhase::class)->find($request->request->get('phase'));
         $principaloffice=$em->getRepository(PrincipalOffice::class)->find($request->request->get('office'));
          $initiatives=$em->getRepository(Initiative::class)->findByPrincipalAndOffice($principaloffice->getId());
          $countinitiative=count($initiatives);
          $plancount=0;
         
          foreach ($initiatives as $initiative) {
              
            $planduplication=$planRepository->checkForDuplicationOfPlan($principaloffice,$initiative,$planningphase);
            if(!$planduplication){
            
            $plan = new Plan();
            $plan->setOffice($principaloffice);
            $plan->setPlanningPhase($planningphase);
            $plan->setPlanningYear($planningphase->getPlanningYear());
            $plan->setInitiative($initiative);
            $plan->setCreatedAt(new DateTime('now'));
            $plan->setCreatedBy($this->getUser());
            $em->persist($plan);
            $em->flush();
            $this->addFlash('success',"plan is created successfuly! thank you for responding");
               }
               else
              $this->addFlash('warning',"you are already respond to this Plan annousment");
              
            



         
          }
         

          return $this->render('plan/index.html.twig', [
           
            'planphases'=> $activePlanningPhase,
            'offices'=>$offices,
            'initiatives'=>$initiatives,
            'pricipaloffice'=>$principaloffice,
            'planphase'=>$planningphase
        ]);
        }

        return $this->render('plan/index.html.twig', [
           
            'planphases'=> $activePlanningPhase,
            'offices'=>$offices
        ]);
    }
    private function findPrincipalOffice(){

    }
      private function activePlanningPhase(EntityManagerInterface $em){
         // $em = $this->getDoctrine()->getManager();
        
    }

    /**
     * @Route("/planphase", name="plan_phase_office", methods={"GET","POST"})
     */
    public function planPhaseAndOffice(Request $request, Plan $plan): Response
    {
       
 return $this->render('plan/index.html.twig', [
            'plans' => 'plam',
        ]);
       
    }
    
    /**
     * @Route("/new", name="plan_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $plan = new Plan();
        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($plan);
            $entityManager->flush();

            return $this->redirectToRoute('plan_index');
        }

        return $this->render('plan/new.html.twig', [
            'plan' => $plan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_show", methods={"GET"})
     */
    public function show(Plan $plan): Response
    {
        return $this->render('plan/show.html.twig', [
            'plan' => $plan,
        ]);
    }



    /**
     * @Route("/{id}/edit", name="plan_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Plan $plan): Response
    {
        $form = $this->createForm(PlanType::class, $plan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plan_index');
        }

        return $this->render('plan/edit.html.twig', [
            'plan' => $plan,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Plan $plan): Response
    {
        if ($this->isCsrfTokenValid('delete'.$plan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plan_index');
    }
    
}
