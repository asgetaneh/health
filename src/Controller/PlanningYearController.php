<?php

namespace App\Controller;

use App\Entity\PlanningYear;
use App\Form\PlanningYearType;
use App\Repository\PlanningYearRepository;
use DateTime;
use App\Helper\SmsHelper;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/planningyear")
 */
class PlanningYearController extends AbstractController
{
    /**
     * @Route("/", name="planning_year_index", methods={"GET","POST"})
     */
    public function index(PlanningYearRepository $planningYearRepository,Request $request): Response
    {
        $this->denyAccessUnlessGranted('vw_pln_yr');
        $planningYear = new PlanningYear();
        $form = $this->createForm(PlanningYearType::class, $planningYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             $this->denyAccessUnlessGranted('ad_pln_yr');
            $entityManager = $this->getDoctrine()->getManager();
            $planningYear->setCreatedAt(new DateTime('now'));
            $planningYear->setCreatedBy($this->getUser());
            // $planningYear->setIsActive(0);
            $entityManager->persist($planningYear);

            $entityManager->flush();
            $this->addFlash('success',"planning year is added successfuly");

            return $this->redirectToRoute('planning_year_index');
        }

        return $this->render('planning_year/index.html.twig', [
            'planning_years' => $planningYearRepository->findAll(),
            'form'=>$form->createView()
        ]);
    }
    /**
     * @Route("/sms/year", name="sms_send_year")
     */
    public function smsSend(Request $request, SmsHelper $smsHelper)
    {
                //   dd(1);

        // $this->denyAccessUnlessGranted('vw_pln_yr');
       
            // $entityManager = $this->getDoctrine()->getManager();
          $message="2014 Plan Created ";
          $userInfo="0923707888";
        //   dd(1);
  $smsHelper->sendSms("Account Update ", $message, '["' . $userInfo . '"]');

            $this->addFlash('success',"planning year is created successfuly");

            return $this->redirectToRoute('planning_year_index');
        

     
    }
    
    /**
     * @Route("/{id}/activate", name="planning_year_activate", methods={"GET","POST"})
     */
    public function activatePlanningYear(Request $request,PlanningYear $planningYear): Response
    {
         $this->denyAccessUnlessGranted('act_pln_yr');
        $entityManager = $this->getDoctrine()->getManager();
        
        if($request->request->get('active')){
            $planningYear->setIsActive(1);
            $entityManager->persist($planningYear);
            $this->addFlash('success',"planning year is Activated successfuly");


        }
        if($request->request->get('deactive')){
             $this->denyAccessUnlessGranted('deact_pln_yr');
            $planningYear->setIsActive(0);
            $entityManager->persist($planningYear);
            $this->addFlash('success',"planning year is deactivated successfuly");
        }
        $entityManager->flush();
      return   $this->redirectToRoute('planning_year_index');

        
    }



    /**
     * @Route("/new", name="planning_year_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
         $this->denyAccessUnlessGranted('ad_pln_yr');
        $planningYear = new PlanningYear();
        $form = $this->createForm(PlanningYearType::class, $planningYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planningYear);
            $entityManager->flush();

            return $this->redirectToRoute('planning_year_index');
        }

        return $this->render('planning_year/new.html.twig', [
            'planning_year' => $planningYear,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_year_show", methods={"GET"})
     */
    public function show(PlanningYear $planningYear): Response
    {
         $this->denyAccessUnlessGranted('vw_pln_yr_dtl');
        return $this->render('planning_year/show.html.twig', [
            'planning_year' => $planningYear,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="planning_year_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanningYear $planningYear): Response
    {
         $this->denyAccessUnlessGranted('edt_pln_yr');
        $form = $this->createForm(PlanningYearType::class, $planningYear);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('planning_year_index');
        }

        return $this->render('planning_year/edit.html.twig', [
            'planning_year' => $planningYear,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="planning_year_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanningYear $planningYear): Response
    {
         $this->denyAccessUnlessGranted('dlt_pln_yr');
        if ($this->isCsrfTokenValid('delete'.$planningYear->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planningYear);
            $entityManager->flush();
        }

        return $this->redirectToRoute('planning_year_index');
    }
}
