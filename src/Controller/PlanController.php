<?php

namespace App\Controller;

use App\Entity\BehavioralPlanningAccomplishment;
use App\Entity\Initiative;
use App\Entity\InitiativeAttribute;
use App\Entity\Plan;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningPhase;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\SuitableInitiative;
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
    public function index(PlanRepository $planRepository, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $offices = $em->getRepository(PrincipalOffice::class)->findOfficeByUser($this->getUser());
        $activePlanningYear = $em->getRepository(PlanningYear::class)->findBy(['isActive' => 1]);
        if ($request->request->get('office') && $request->request->get('planyear')) 
        {

            $planningyear = $em->getRepository(PlanningYear::class)->find($request->request->get('planyear'));
            $principaloffice = $em->getRepository(PrincipalOffice::class)->find($request->request->get('office'));
            $initiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($principaloffice->getId());
             
             

            $plancount = 0;
            $planningquarters = $em->getRepository(PlanningQuarter::class)->findAll();
            $numberOfYearQuarter = $planningyear->getNumberOfQuarter();
            
         

               if ($request->request->get('initiative')) 
               {
                   $selectedInitiatives=$em->getRepository(Initiative::class)->findBy(['id'=>$request->request->get('initiative')]);
                   $countinitiative = count($selectedInitiatives);

                foreach ( $selectedInitiatives as  $selectedInitiative) 
                {

                      $existinitiative=$em->getRepository(SuitableInitiative::class)->findDuplication($principaloffice,$selectedInitiative,$planningyear);
                      if(!$existinitiative){
                      $suitableInitiative=new SuitableInitiative();
                      $suitableInitiative->setPrincipalOffice($principaloffice);
                      $suitableInitiative->setInitiative($selectedInitiative);
                      $suitableInitiative->setPlanningYear($planningyear);

                    foreach ($planningquarters as $planningquarter) {
                     $planduplication = $planRepository->checkForDuplicationOfPlan($principaloffice, $selectedInitiative, $planningyear, $planningquarter);
                    if (!$planduplication)
                     {
                        $plan = new Plan();
                       
                        $plan->setQuarter($planningquarter);
                        $plan->setSuitableInitiative($suitableInitiative);
                
                        $plan->setCreatedAt(new DateTime('now'));
                        $plan->setCreatedBy($this->getUser());

                        $em->persist($plan);
                        //$em->flush();
                    }
                     else
                        $plancount = $plancount + 1;
                      }

                      $em->persist($suitableInitiative);
                      $em->flush();

                      }
                  
                   
                if ($plancount > 0)
                    $this->addFlash('warning', "you are already respond to this Plan annousment");
                else
                    $this->addFlash('success', "plan is created successfuly! thank you for responding");
                    
            }
             
                  
               }
            
                $suitableInitiatives=$em->getRepository(SuitableInitiative::class)->findByoffice($principaloffice,$planningyear);
                 //  $this->addFlash('success','now select suitable initiative with your teammates');
                 
                if ($suitableInitiatives) 
                {
                $isallActive=$this->getActivePlan($suitableInitiatives);
                 
                    return $this->render('plan/index.html.twig', [

                       'planningYears' =>  $activePlanningYear,
                       'offices' => $offices,
                       'suitableInitiatives' =>  $suitableInitiatives,
                       'pricipaloffice' => $principaloffice,
                       'planyear' => $planningyear,
                       'isAllActive'=> $isallActive

            ]);
                }

               

               

              

            return $this->render('plan/index.html.twig', [

                'planningYears' =>  $activePlanningYear,
                'offices' => $offices,
                'initiatives' => $initiatives,
                'pricipaloffice' => $principaloffice,
                'planyear' => $planningyear
            ]);
        }

        return $this->render('plan/index.html.twig', [

            'planningYears' =>  $activePlanningYear,
            'offices' => $offices
        ]);
    }

   
   private function getActivePlan($suitableInitiatives)
   {
       
       $isAllActive=true;
       foreach ($suitableInitiatives as $suitableInitiative) {
             $plans=$suitableInitiative->getPlans();
             if (sizeof($plans)<1) {
                   $isAllActive=false;
            
             
             foreach ($plans as $plan) {
                 if($plan->getIsActive() == false){
                      $isAllActive=false;
                      break;

                 }

                
             }
              }

       }
       return  $isAllActive;
   }
   
     /**
     * @Route("/addplan", name="plan_add")
     */
    public function addPlan(Request $request){
       $em = $this->getDoctrine()->getManager();
     
       if ($request->request->get('id')) {
        
         $suitableInitiative=$em->getRepository(SuitableInitiative::class)->find($request->request->get('id'));
         $res = $this->renderView("plan/plan.modal.html.twig", ["suitableInitiative" =>  $suitableInitiative]);
            return new Response($res);
       }
       return new Response("done");
      
    }
    
    /**
     * @Route("/planphase", name="plan_phase_office", methods={"GET","POST"})
     */
    public function planPhaseAndOffice(Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();
        $offices = $em->getRepository(PrincipalOffice::class)->findOfficeByUser($this->getUser());
        $activePlanningYear = $em->getRepository(PlanningYear::class)->findBy(['isActive' => 1]);
        if ($request->request->get('code')  )
         {
         
          $plans=$em->getRepository(Plan::class)->findBy(['id'=>$request->request->get('plan')]);
          $planValues=$request->request->get('planvalue');
          $planslength=sizeof($plans);

          $planInitiative=$em->getRepository(SuitableInitiative::class)->find($request->request->get('suitableInitiative'));

          if ($request->request->get('code') == 3) {
             
          $attributes=$em->getRepository(InitiativeAttribute::class)->findBy(['id'=>$request->request->get('attr')]);
          $attributelength=sizeof($attributes);
         
      
          foreach ($plans as  $plan) {
             foreach ($attributes as $key => $attribute) {
                  $accomplishmentduplication=$em->getRepository(BehavioralPlanningAccomplishment::class)->findDuplication($plan,$attribute);
                  if ($accomplishmentduplication<1) 
                  {
                    
                  $behaviorAccomp= new BehavioralPlanningAccomplishment();
                  $behaviorAccomp->setPlan($plan);
                  $behaviorAccomp->getPlan()->setIsActive(true);
                  $behaviorAccomp->getPlan()->getSuitableInitiative()->setIsActive(true);
                  $behaviorAccomp->setInitiativeAttribute($attribute);
                  $behaviorAccomp->setPlanValue($planValues[$key]);

                  $em->persist($behaviorAccomp);
                  $em->flush();
                  }
                    
                 }
                
           
          }

        }
         
         if (($request->request->get('code') == 2 || $request->request->get('code') == 1)) 
         {
            
             $denimonators=null;
             if($request->request->get('denimanitor'))
              {
                $denimonators=$request->request->get('denimanitor');
             }
               foreach ($plans as  $key => $plan) 
                {
                  $planAccomplishmentduplication=$em->getRepository(PlanningAccomplishment::class)->findDuplication($plan);
                  if($planAccomplishmentduplication<1){
                  $planAccomplishment=new PlanningAccomplishment();
                  $planAccomplishment->setPlan($plan);
                  $planAccomplishment->getPlan()->getSuitableInitiative()->setIsActive(true);
                  $planAccomplishment->setPlanValue($planValues[$key]);
                  $planAccomplishment->setDenominator($denimonators?$denimonators[$key]:null);
            
                  $em->persist($planAccomplishment);
                  $em->flush();
                  }
                  
              
                }
         
        }
   


    $suitableplan=$em->getRepository(SuitableInitiative::class)->findByoffice($planInitiative->getPrincipalOffice(),  $planInitiative->getPlanningYear());
    $activesuitable=$em->getRepository(SuitableInitiative::class)->findAllActive($planInitiative->getPrincipalOffice(),  $planInitiative->getPlanningYear(),true);
  
       
    
    if(count($suitableplan) == count($activesuitable)){
    $planAccomplishments=$em->getRepository(PlanningAccomplishment::class)->findBySuitable($suitableplan);
   
    return $this->render('plan/index.html.twig',[
         'suitableplans'=>$suitableplan,
         'planningYears' =>  $activePlanningYear,
        'offices' => $offices,
        'pricipaloffice' => $planInitiative->getPrincipalOffice(),
        'planyear' => $planInitiative->getPlanningYear(),
        'planAcomps'=>$planAccomplishments
    ]);
    }
    
    

              $isallActive=$this->getActivePlan($suitableplan);
              return $this->render('plan/index.html.twig', [

                       'planningYears' =>  $activePlanningYear,
                       'offices' => $offices,
                       'suitableInitiatives' => $suitableplan,
                       'pricipaloffice' => $planInitiative->getPrincipalOffice(),
                       'planyear' => $planInitiative->getPlanningYear(),
                       'isAllActive'=> $isallActive

            ]);
                }


    

    return $this->redirectToRoute('plan_index');
    }
     /**
     * @Route("/achievement", name="plan_achievement", methods={"GET","POST"})
     */
    public function planAchievement(Request $request): Response
    {
        $em=$this->getDoctrine()->getManager();
       
    

        
   return $this->render('plan/plan.achievement.html.twig');
   
   return $this->redirectToRoute('plan_index');
         
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
        if ($this->isCsrfTokenValid('delete' . $plan->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($plan);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plan_index');
    }
}
