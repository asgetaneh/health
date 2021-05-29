<?php

namespace App\Controller;

use App\Entity\BehavioralPlanningAccomplishment;
use App\Entity\Initiative;
use App\Entity\InitiativeAttribute;
use App\Entity\InitiativeBehaviour;
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
                    
                   
                      $em->persist($suitableInitiative);
                      $em->flush();

                      }
                  

                   $this->addFlash('success', " successfuly selected Suitable initiatives for your office! thank you for responding");
               
                    
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
                       'isAllActive'=> $isallActive,
                       'quarters'=> $planningquarters

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
             $plans=$suitableInitiative->getPlanningAccomplishments();
             if (sizeof($plans)<1) {
                   $isAllActive=false;
            
             
           

                
             }
              

       }
       return  $isAllActive;
   }
   
     /**
     * @Route("/addplan", name="plan_add")
     */
    public function addPlan(Request $request){
       $em = $this->getDoctrine()->getManager();
       $quarters=$em->getRepository(PlanningQuarter::class)->findAll();
     
       if ($request->request->get('id')) {
        
         $suitableInitiative=$em->getRepository(SuitableInitiative::class)->find($request->request->get('id'));
         $initiative=$em->getRepository(Initiative::class)->find($suitableInitiative->getInitiative()->getId());
        
        // dd( count($initiative->getInitiativeBehaviour()),count($initiative->getSocialAtrribute()));
         $res = $this->renderView("plan/plan.modal.html.twig", ["suitableInitiative" =>  $suitableInitiative,'quarters'=>$quarters,
         'initiative'=>$initiative]);
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
        $planningquarters = $em->getRepository(PlanningQuarter::class)->findAll();
        
        if($request->request->get('planvalue')){

        $planValues=$request->request->get('planvalue');
      
      
        $planInitiative=$em->getRepository(SuitableInitiative::class)->find($request->request->get('suitableInitiative'));

         if ($request->request->get('denominator')) {
             $planInitiative->setDenominator($request->request->get('denominator'));
             $em->persist($planInitiative);
             };

         if (count($planInitiative->getInitiative()->getSocialAtrribute())>0){

              $socalAttributes=$planInitiative->getInitiative()->getSocialAtrribute() ;
             


                 $numberOfQuarter=count($planningquarters);
                 $numberOfAttributes=count($socalAttributes);
                 $numberOfPlan = $numberOfAttributes*$numberOfQuarter;
                
                $i=0;
               
         
                foreach ($planningquarters as $planningquarter) {
                foreach ( $socalAttributes as $key=> $socalAttribute) {
                  
                $planAcomplishment=$em->getRepository(PlanningAccomplishment::class)->findDuplication($planInitiative, $socalAttribute,$planningquarter);
                $edit=true;
                if (!$planAcomplishment)
                {
                    $planAcomplishment=new PlanningAccomplishment();
                    $edit=false;

                }

                   
                   $planAcomplishment->setSuitableInitiative($planInitiative);
                   $planAcomplishment->setSocialAttribute($socalAttributes[$i % $numberOfAttributes]);
                   if ((int) $planValues[$i]>0) {
                  $planAcomplishment->setPlanValue((int) $planValues[$i]);

                   }
                   $planAcomplishment->setQuarter($planningquarter);
                   if ($edit==false) {
                      $em->persist($planAcomplishment);
                     }
                   

                   $i++;
               
              }
              }
              $em->flush();

         }
         else {
        
              
 
                foreach ($planningquarters as $key => $planningquarter) {
                    $planAcomplishment=$em->getRepository(PlanningAccomplishment::class)->findDuplication($planInitiative,null,$planningquarter);
                if (!$planAcomplishment)
                   $planAcomplishment=new PlanningAccomplishment();

                    $planAcomplishment->setSuitableInitiative($planInitiative);
                    $planAcomplishment->setPlanValue($planValues[$key]);
                    $planAcomplishment->setQuarter($planningquarter);
                     $em->persist($planAcomplishment);

                    }

                    $em->flush();

               
           
         }

        

       
        
          

         
       
   


      $suitableplan=$em->getRepository(SuitableInitiative::class)->findByoffice($planInitiative->getPrincipalOffice(),  $planInitiative->getPlanningYear());
      
   
    return $this->render('plan/index.html.twig',[
         'suitableplans'=>$suitableplan,
         'planningYears' =>  $activePlanningYear,
        'offices' => $offices,
        'pricipaloffice' => $planInitiative->getPrincipalOffice(),
        'planyear' => $planInitiative->getPlanningYear(),
        'quarters'=>$planningquarters
        
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
