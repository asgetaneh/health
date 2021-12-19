<?php

namespace App\Controller;

use App\Entity\BehavioralPlanningAccomplishment;
use App\Helper\DomPrint;
use App\Entity\Delegation;
use App\Entity\Goal;
use App\Entity\Initiative;
use App\Entity\InitiativeAttribute;
use App\Entity\InitiativeBehaviour;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\Objective;
use App\Entity\OperationalManager;
use App\Entity\OperationalOffice;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\Plan;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningPhase;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\Strategy;
use App\Entity\SuitableInitiative;
use App\Entity\SuitableOperational;
use App\Form\PlanType;
use App\Helper\Helper;
use App\Helper\KpiHelper;
use App\Helper\PlanAchievementHelper;
use App\Repository\InitiativeRepository;
use App\Repository\PlanningAccomplishmentRepository;
use App\Repository\PlanRepository;
use App\Repository\SuitableInitiativeRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Component\Pager\PaginatorInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/plan")
 */
class PlanController extends AbstractController
{
    /**
     * @Route("/", name="plan_index", methods={"GET","POST"})
     */
    public function index(PlanRepository $planRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $em = $this->getDoctrine()->getManager();

        $delegation = $em->getRepository(Delegation::class)->findDelegationUser($this->getUser());

        $delegationUser = $this->getDelegationUser($delegation);

        $offices = $em->getRepository(PrincipalOffice::class)->findOfficeByUser($this->getUser(), $delegationUser);
        $activePlanningYear = $em->getRepository(PlanningYear::class)->findBy(['isActive' => 1]);
        if ($request->query->get('office') && $request->query->get('planyear')) {

            $planningyear = $em->getRepository(PlanningYear::class)->find($request->query->get('planyear'));
            $principaloffice = $em->getRepository(PrincipalOffice::class)->find($request->query->get('office'));
            $parentOffice = Helper::getParentOffice($principaloffice->getId(), $em);
            $initiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($principaloffice);
            $recoverInitiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($principaloffice);
            //  $recoverData=$recoverInitiatives;
            //  dd($recoverData);
            $recoverData = $paginator->paginate($recoverInitiatives, $request->query->getInt('page', 1), 10);

            $plancount = 0;
            $planningquarters = $em->getRepository(PlanningQuarter::class)->findAll();
            $numberOfYearQuarter = $planningyear->getNumberOfQuarter();


            if ($request->query->get('initiative')) {



                if ($request->query->get('nonsuitable')) {
                    $removableId = $request->query->get('initiative');

                    $this->removeSuitableInitiative($em, $principaloffice, $planningyear,  $removableId);
                    $this->addFlash('success', " successfuly selected  As Non Suitable initiatives");
                    //  return $this->redirectToRoute('plan_index');
                } else {


                    $selectedInitiatives = $em->getRepository(Initiative::class)->findBy(['id' => $request->query->get('initiative')]);
                    $countinitiative = count($selectedInitiatives);

                    foreach ($selectedInitiatives as  $selectedInitiative) {

                        $existinitiative = $em->getRepository(SuitableInitiative::class)->findDuplication($principaloffice, $selectedInitiative, $planningyear);
                        if (!$existinitiative) {
                            $suitableInitiative = new SuitableInitiative();
                            $suitableInitiative->setPrincipalOffice($principaloffice);
                            $suitableInitiative->setInitiative($selectedInitiative);
                            $suitableInitiative->setPlanningYear($planningyear);

                            $em->persist($suitableInitiative);
                            $em->flush();
                        }
                    }
                    $this->addFlash('success', " successfuly selected Suitable initiatives for your office! thank you for responding");
                }
            }
            $operationalPlans = $em->getRepository(SuitableOperational::class)->findAll();

            $suitableInitiatives = $this->findSuitableInitiative($em, $principaloffice, $planningyear);

            if ($suitableInitiatives) {
                $suitdata = $paginator->paginate(
                    $suitableInitiatives,
                    $request->query->getInt('page', 1),
                    10
                );
                $isallActive = $this->getActivePlan($suitableInitiatives);
                $isOperationalReport = $isallActive ? true : false;

                return $this->render('plan/index.html.twig', [
                    'operational_office_report' => $isOperationalReport,
                    'planningYears' =>  $activePlanningYear,
                    'offices' => $offices,
                    'suitableplans' =>  $suitdata,
                    'pricipaloffice' => $principaloffice,
                    'planyear' => $planningyear,
                    'isAllActive' => $isallActive,
                    'quarters' => $planningquarters,
                    'recoverInitiatives' => $recoverData,
                    'operationalPlans' => $operationalPlans


                ]);
            }



            return $this->render('plan/index.html.twig', [

                'planningYears' =>  $activePlanningYear,
                'offices' => $offices,
                'initiatives' =>  $initiatives,
                'pricipaloffice' => $principaloffice,
                'planyear' => $planningyear,
                'recoverInitiatives' => $recoverData

            ]);
        }

        return $this->render('plan/index.html.twig', [

            'planningYears' =>  $activePlanningYear,
            'offices' => $offices
        ]);
    }


    private function getActivePlan($suitableInitiatives)
    {
        $isAllActive = true;
        foreach ($suitableInitiatives as $suitableInitiative) {
            $plans = $suitableInitiative->getPlanningAccomplishments();
            if (sizeof($plans) < 1) {
                $isAllActive = false;
                break;
            }
        }
        return  $isAllActive;
    }

    private function getDelegationUser($delegations)
    {
        $user = array();
        foreach ($delegations as $delegation) {
            array_push($user, $delegation->getDelegatedBy());
        }
        return $user;
    }


    private function findSuitableInitiative(EntityManagerInterface $em, $principaloffice, $planningyear)
    {

        $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findByoffice($principaloffice, $planningyear);
        return $suitableInitiatives;
    }

    private function removeSuitableInitiative(EntityManagerInterface $em, $principaloffice, $planningyear, $removableId)
    {
        $removableInitiatives = $em->getRepository(Initiative::class)->findBy(['id' => $removableId]);

        foreach ($removableInitiatives as $removableInitiative) {
            $removableSuitable = $em->getRepository(SuitableInitiative::class)->getRemovable($principaloffice, $removableInitiative, $planningyear);

            if ($removableSuitable) {
                $isacomplish = false;
                $planAcomplishments = $removableSuitable->getPlanningAccomplishments();
                if (count($planAcomplishments) <= 0) {
                    $em->remove($removableSuitable);
                    $em->flush();
                }
            }
        }

        return true;
    }


    /**
     * @Route("/addplan", name="plan_add")
     */
    public function addPlan(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $isOperationalManager = false;

        if ($request->request->get('id')) {

            $operationaloffice = $em->getRepository(OperationalOffice::class)->find($request->request->get('operational'));
            $suitableInitiative = $em->getRepository(SuitableInitiative::class)->findwithPlan($request->request->get('id'));
            $planInitiative = $em->getRepository(SuitableInitiative::class)->find($request->request->get('id'));
            $operationalSuitable = $em->getRepository(SuitableOperational::class)->findOneBy(['suitableInitiative' => $planInitiative, 'operationalOffice' => $operationaloffice]);
            $plan = $em->getRepository(OperationalPlanningAccomplishment::class)->findBy(['operationalSuitable' => $operationalSuitable]);

            $initiative = $em->getRepository(Initiative::class)->find($suitableInitiative->getInitiative()->getId());

            if ($request->request->get('isOperational')) {
                $isOperationalManager = true;
            }

            $res = $this->renderView("plan/plan.modal.html.twig", [
                "suitableInitiative" =>  $suitableInitiative, 'quarters' => $quarters,
                'initiative' => $initiative,
                'plans' => $plan,
                'operational' => $operationaloffice,
                'isOperationalManager' => $isOperationalManager
            ]);
            return new Response($res);
        }
        return new Response("done");
    }

    /**
     * @Route("/recover", name="plan_recover")
     */
    public function Recover(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->query->get('office') && $request->query->get('planyear')) {
            $planningyear = $em->getRepository(PlanningYear::class)->find($request->query->get('planyear'));
            $principaloffice = $em->getRepository(PrincipalOffice::class)->find($request->query->get('office'));

            $parentOffice = Helper::getParentOffice($principaloffice->getId(), $em);
            $recoverInitiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($principaloffice);

            $recoverData = $paginator->paginate($recoverInitiatives, $request->query->getInt('page', 1), 10);
            if ($request->query->get('nonsuitable')) {
                $removableId = $request->query->get('initiative');

                $this->removeSuitableInitiative($em, $principaloffice, $planningyear,  $removableId);
                $this->addFlash('success', " successfuly selected  As Non Suitable initiatives");
                //  return $this->redirectToRoute('plan_index');
            } else {


                $selectedInitiatives = $em->getRepository(Initiative::class)->findBy(['id' => $request->query->get('initiative')]);
                $countinitiative = count($selectedInitiatives);

                foreach ($selectedInitiatives as  $selectedInitiative) {

                    $existinitiative = $em->getRepository(SuitableInitiative::class)->findDuplication($principaloffice, $selectedInitiative, $planningyear);
                    if (!$existinitiative) {
                        $suitableInitiative = new SuitableInitiative();
                        $suitableInitiative->setPrincipalOffice($principaloffice);
                        $suitableInitiative->setInitiative($selectedInitiative);
                        $suitableInitiative->setPlanningYear($planningyear);

                        $em->persist($suitableInitiative);
                        $em->flush();
                    }
                }
                if ($request->query->get('initiative'))
                    $this->addFlash('success', " successfuly selected Suitable initiatives for your office! thank you for responding");
            }
        }
        return $this->render('plan/initiative.html.twig', [




            'pricipaloffice' => $principaloffice,
            'planyear' => $planningyear,
            'recoverInitiatives' => $recoverData

        ]);
    }
    /**
     * @Route("/principalplan", name="plan_principal")
     */
    public function principalOfficePlan(Request $request, PaginatorInterface $paginator, SuitableInitiativeRepository $suitableInitiativeRepository, DomPrint $domPrint, PlanningAccomplishmentRepository $planningAccomplishmentRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $offices = $em->getRepository(PrincipalOffice::class)->findOfficeByUser($this->getUser());
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $planningyear = $em->getRepository(PlanningYear::class)->findLast();

        if (!$offices)
            $offices = $em->getRepository(PrincipalOffice::class)->findPrincipalOffice($this->getUser());
        // dd($offices);
        // dd($em->getRepository(Initiative::class)->findBySuitable( $offices));
        $filterForm = $this->createFormBuilder()
            ->setMethod('Get')
            ->add("planyear", EntityType::class, [
                'class' => PlanningYear::class,
                'multiple' => false,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add("initiative", EntityType::class, [
                'class' => Initiative::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add("kpi", EntityType::class, [
                'class' => KeyPerformanceIndicator::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add("strategy", EntityType::class, [
                'class' => Strategy::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add("objective", EntityType::class, [
                'class' => Objective::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add("goal", EntityType::class, [
                'class' => Goal::class,
                'multiple' => true,
                'placeholder' => 'Choose an planning year',
                'required' => false,

            ])
            ->add('principaloffice', EntityType::class, [
                'class' => PrincipalOffice::class,
                'placeholder' => "All",
                'multiple' => false,
                'required' => false,

            ])

            ->getForm();
        $filterForm->handleRequest($request);



        if ($filterForm->isSubmitted() && $filterForm->isValid()) {

            $suitableInitiative = $suitableInitiativeRepository->search($filterForm->getData());
        } else {
            if ($this->isGranted('vw_all_pln')) {

                $suitableInitiative = $em->getRepository(SuitableInitiative::class)->findBy(['planningYear' => $planningyear]);
                $initiatives = $em->getRepository(Initiative::class)->findAll();
            } else
                $suitableInitiative =  $em->getRepository(SuitableInitiative::class)->findByPrincipalAndOffice($offices);
            $initiatives = $em->getRepository(Initiative::class)->findBySuitable($offices);
        }
        if ($request->request->get('print')) {
            $domPrint->print('plan/print_plan.html.twig', [
                "suitableplans" =>   $suitableInitiative,
                'quarters' => $quarters,


            ], 'plan report', 'landscape');
        }
        if ($request->request->get("excel")) {
            // dd(1);

            $spreadsheet = new Spreadsheet();


            foreach (range('A', 'M') as $columnID) {
                $spreadsheet->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
            }
            $count = 1;
            foreach ($suitableInitiative as $result) {
                $count = $count + 1;
            }

            $sheet = $spreadsheet->getActiveSheet();




            $sheet->setCellValue('A1', 'Initiative');
            $sheet->setCellValue('B1', 'Behavior');
            $sheet->setCellValue('C1', 'PrincipalOffice');
            $sheet->setCellValue('D1', 'Year');
            $sheet->setCellValue('E1', 'Yearly Plan');
            $sheet->setCellValue('F1', 'Yearly Plan Accomp');
            $sheet->setCellValue('G1', 'Q1 Plan');
            $sheet->setCellValue('H1', 'Q1 Plan Accomp');
            $sheet->setCellValue('I1', 'Q2 Plan');
            $sheet->setCellValue('J1', 'Q2 Plan Accomp');
            $sheet->setCellValue('K1', 'Q3 Plan');
            $sheet->setCellValue('L1', 'Q3 Plan Accomp');
            $sheet->setCellValue('M1', 'Q4 Plan');
            $sheet->setCellValue('N1', 'Q4 Plan Accomp');

            // $totalResult = $initiativestotal;
            // dd($totalResult);
            $x = 2;
            $soh = 0;
            foreach ($suitableInitiative as $result) {
                $plan = "";
                $planAccomp = "";
                $quarter1 = "";
                $quarter2 = "";
                $quarter3 = "";
                $quarter4 = "";
                $quarter1 = "";
                $quarter1Accomp = "";
                $quarter2Accomp = "";
                $quarter3Accomp = "";
                $quarter4Accomp = "";

                if (count($result->getInitiative()->getSocialAtrribute()) > 0) {
                    foreach ($result->getInitiative()->getSocialAtrribute() as $social) {
                        $plan = $plan . strtoupper(substr($social->getName(), 0, 1)) . ":" . $planningAccomplishmentRepository->findYearlyPlan($result, $social, $result->getInitiative()->getInitiativeBehaviour()->getCode()) . " ";
                        $planAccomp = $planAccomp . strtoupper(substr($social->getName(), 0, 1)) . ":" . $planningAccomplishmentRepository->findYearlyPlanAccomp($result, $social, $result->getInitiative()->getInitiativeBehaviour()->getCode()) . " ";


                        $quarter1 =  $quarter1 . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlan($result, $social, 1) . " ";
                        $quarter1Accomp = $quarter1Accomp . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlanAccomp($result, $social, 1) . " ";

                        $quarter2 =  $quarter2 . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlan($result, $social, 2) . " ";
                        $quarter2Accomp = $quarter2Accomp . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlanAccomp($result, $social, 2) . " ";

                        $quarter3 =  $quarter3 . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlan($result, $social, 3) . " ";
                        $quarter3Accomp = $quarter3Accomp . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlanAccomp($result, $social, 3) . " ";

                        $quarter4 =  $quarter4 . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlan($result, $social, 4) . " ";
                        $quarter4Accomp = $quarter4Accomp . strtoupper(substr($social->getName(), 0, 1)) . ":"  . $planningAccomplishmentRepository->findQuarterPlanAccomp($result, $social, 4) . " ";
                    }
                } else {
                    $plan =  $planningAccomplishmentRepository->findYearlyPlan($result, null, $result->getInitiative()->getInitiativeBehaviour()->getCode());

                    $planAccomp = $planningAccomplishmentRepository->findYearlyPlanAccomp($result, null, $result->getInitiative()->getInitiativeBehaviour()->getCode());

                    $quarter1 =  $planningAccomplishmentRepository->findQuarterPlan($result, null, 1);
                    $quarter1Accomp = $planningAccomplishmentRepository->findQuarterPlanAccomp($result, null, 1);
                    $quarter2 =  $planningAccomplishmentRepository->findQuarterPlan($result, null, 2);
                    $quarter2Accomp = $planningAccomplishmentRepository->findQuarterPlanAccomp($result, null, 2);
                    $quarter3 =  $planningAccomplishmentRepository->findQuarterPlan($result, null, 3);
                    $quarter3Accomp = $planningAccomplishmentRepository->findQuarterPlanAccomp($result, null, 3);
                    $quarter4 =  $planningAccomplishmentRepository->findQuarterPlan($result, null, 4);
                    $quarter4Accomp = $planningAccomplishmentRepository->findQuarterPlanAccomp($result, null, 4);
                }



                $sheet->setCellValue('A' . $x, $result->getInitiative());
                $sheet->setCellValue('B' . $x, $result->getInitiative()->getInitiativeBehaviour()->getName());
                $sheet->setCellValue('C' . $x, $result->getPrincipalOffice()->getName());
                $sheet->setCellValue('D' . $x, $result->getPlanningYear());
                $sheet->setCellValue('E' . $x, $plan);
                $sheet->setCellValue('F' . $x, $planAccomp);
                $sheet->setCellValue('G' . $x, $quarter1);
                $sheet->setCellValue('H' . $x, $quarter1Accomp);
                $sheet->setCellValue('I' . $x, $quarter2);
                $sheet->setCellValue('J' . $x, $quarter2Accomp);
                $sheet->setCellValue('K' . $x, $quarter3);
                $sheet->setCellValue('L' . $x, $quarter3Accomp);
                $sheet->setCellValue('M' . $x, $quarter4);
                $sheet->setCellValue('N' . $x, $quarter4Accomp);



                $x++;
            }

            $writer = new Xlsx($spreadsheet);
            $fileName =   "Principal Office Plan" . '.xlsx';
            $temp_file = tempnam(sys_get_temp_dir(), $fileName);
            $writer->save($temp_file);
            return $this->file($temp_file, $fileName, ResponseHeaderBag::DISPOSITION_INLINE);
        }







        $data = $paginator->paginate($suitableInitiative, $request->query->getInt('page', 1), 5);

        return $this->render("plan/plan.html.twig", [
            "suitableplans" =>  $data,
            'quarters' => $quarters,
            // 'initiatives' => $initiatives,
            'filterform' => $filterForm->createView()

        ]);
    }
    private function calculatePrincipalOfficePlan(EntityManagerInterface $em, $planInitiative)
    {
        $suitableoperationals = $em->getRepository(SuitableOperational::class)->findBy(['suitableInitiative' => $planInitiative]);
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $suitableInitiative = $em->getRepository(SuitableInitiative::class)->find($planInitiative->getId());


        if (count($planInitiative->getInitiative()->getSocialAtrribute()) > 0) {
            $socalAttributes = $em->getRepository(InitiativeAttribute::class)->findAll();

            foreach ($socalAttributes as $socalAttribute) {
                $plans = $em->getRepository(OperationalPlanningAccomplishment::class)->calculateSocialAttrQuartertPlan($planInitiative, $socalAttribute);
                //   if($socalAttribute->getId()==2)
                //    dd($plans);

                foreach ($quarters as $key => $quarter) {
                    $planAcomplishment = $em->getRepository(PlanningAccomplishment::class)->findDuplication($planInitiative, $socalAttribute, $quarter);
                    $isexist = true;
                    if (!$planAcomplishment) {
                        $planAcomplishment = new PlanningAccomplishment();
                        $planAcomplishment->setQuarter($quarter);
                        $planAcomplishment->setSocialAttribute($socalAttribute);
                        $planAcomplishment->setSuitableInitiative($suitableInitiative);
                        $isexist = false;
                    }
                    $planAcomplishment->setPlanValue($plans[$key][1]);
                    if (!$isexist)
                        $em->persist($planAcomplishment);


                    $em->flush();
                }
            }
        } else {

            $plans = $em->getRepository(OperationalPlanningAccomplishment::class)->calculateQuartertPlan($planInitiative);



            foreach ($quarters as $key => $quarter) {
                $planAcomplishment = $em->getRepository(PlanningAccomplishment::class)->findDuplication($planInitiative, null, $quarter);
                $isexist = true;
                if (!$planAcomplishment) {
                    $planAcomplishment = new PlanningAccomplishment();
                    $planAcomplishment->setQuarter($quarter);
                    $planAcomplishment->setSuitableInitiative($suitableInitiative);
                    $isexist = false;
                }
                $planAcomplishment->setPlanValue($plans[$key][1]);
                if (!$isexist)
                    $em->persist($planAcomplishment);


                $em->flush();
            }
            $em->flush();
            $em->clear();
        }
        $em->clear();
        KpiHelper::setOfficeKpiPlan($em, $suitableInitiative);

        return;
    }

    /**
     * @Route("/planphase", name="plan_phase_office", methods={"GET","POST"})
     */
    public function planPhaseAndOffice(Request $request, PaginatorInterface $paginator): Response
    {
        $em = $this->getDoctrine()->getManager();
        $offices = $em->getRepository(PrincipalOffice::class)->findOfficeByUser($this->getUser());
        $activePlanningYear = $em->getRepository(PlanningYear::class)->findBy(['isActive' => 1]);
        $planningquarters = $em->getRepository(PlanningQuarter::class)->findAll();

        if ($request->request->get('planvalue')) {

            $planValues = $request->request->get('planvalue');
            $currentPage = $request->request->get("currentPage");


            $planInitiative = $em->getRepository(SuitableInitiative::class)->find($request->request->get('suitableInitiative'));
            $operationaloffice = $em->getRepository(OperationalOffice::class)->find($request->request->get('operationalOffice'));

            $isexist = true;
            $operationalSuitable = $em->getRepository(SuitableOperational::class)->findOneBy(['suitableInitiative' => $planInitiative, 'operationalOffice' => $operationaloffice]);

            if (!$operationalSuitable) {

                $operationalSuitable = new SuitableOperational();
                $operationalSuitable->setSuitableInitiative($planInitiative);
                $operationalSuitable->setOperationalOffice($operationaloffice);
                $operationalSuitable->setStatus(1);
                $isexist = false;
                $em->persist($operationalSuitable);
                $em->flush();
            } else
                $operationalSuitable->setStatus(1);








            if ($request->request->get('denominator')) {
                $operationalSuitable->setDenimonator($request->request->get('denominator'));
            };




            if (count($planInitiative->getInitiative()->getSocialAtrribute()) > 0) {

                $socalAttributes = $planInitiative->getInitiative()->getSocialAtrribute();



                $numberOfQuarter = count($planningquarters);
                $numberOfAttributes = count($socalAttributes);
                $numberOfPlan = $numberOfAttributes * $numberOfQuarter;

                $i = 0;


                foreach ($planningquarters as $planningquarter) {
                    foreach ($socalAttributes as $key => $socalAttribute) {
                        $edit = true;


                        $planAcomplishment = $em->getRepository(OperationalPlanningAccomplishment::class)->findDuplication($operationalSuitable, $socalAttribute, $planningquarter);
                        $isplanexist = true;
                        if (!$planAcomplishment) {
                            $planAcomplishment = new OperationalPlanningAccomplishment();
                            $isplanexist = false;
                            $edit = false;
                        }


                        $planAcomplishment->setOperationalSuitable($operationalSuitable);
                        $planAcomplishment->setSocialAttribute($socalAttributes[$i % $numberOfAttributes]);


                        if (isset($planValues[$i])) {
                            $planAcomplishment->setPlanValue($planValues[$i]);
                        }
                        $planAcomplishment->setQuarter($planningquarter);
                        if ($edit == false) {
                            $em->persist($planAcomplishment);
                        }


                        $i++;
                    }
                }
                $em->flush();

                $em->clear();
            } else {



                foreach ($planningquarters as $key => $planningquarter) {
                    // $planAcomplishment = null;

                    $planAcomplishment = $em->getRepository(OperationalPlanningAccomplishment::class)->findDuplication($operationalSuitable, null, $planningquarter);
                    $isplanexist = true;
                    if (!$planAcomplishment) {
                        $planAcomplishment = new OperationalPlanningAccomplishment();
                        $isplanexist = false;
                    }

                    $planAcomplishment->setOperationalSuitable($operationalSuitable);
                    $planAcomplishment->setPlanValue($planValues[$key]);
                    $planAcomplishment->setQuarter($planningquarter);

                    if (!$isplanexist) {
                        $em->persist($planAcomplishment);
                    }
                    $em->flush();
                }

                $em->flush();
                $em->clear();
            }


            $this->calculatePrincipalOfficePlan($em, $planInitiative);
            Helper::calculateInitiativePlan($em, $planInitiative);
            // PlanAchievementHelper::setInitiativeAchievement($em,$planInitiative);
            if ($operationaloffice->getPrincipalOffice()->getOfficeGroup()) {
                Helper::setOrganizationalInitiativePlan($em, $planInitiative, $operationaloffice->getPrincipalOffice()->getOfficeGroup());
            }


            $operationalPlans = $em->getRepository(SuitableOperational::class)->findAll();

            $suitableplan = $this->findSuitableInitiative($em, $planInitiative->getPrincipalOffice(), $planInitiative->getPlanningYear());
            $suitableData = $paginator->paginate($suitableplan, $request->query->getInt('page', $currentPage), 10);
            $recoverInitiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($planInitiative->getPrincipalOffice());
            $recoverData = $paginator->paginate($recoverInitiatives, $request->query->getInt('page', 1), 10);
            $isallActive = $this->getActivePlan($suitableplan);
            $isOperationalReport = $isallActive ? true : false;
            $this->addFlash('success', " successfuly register your plan for  Suitable initiatives of your office! thank you for responding");

            return $this->render('plan/index.html.twig', [
                'suitableplans' => $suitableData,
                'planningYears' =>  $activePlanningYear,
                'offices' => $offices,
                'operational_office_report' => $isOperationalReport,
                'pricipaloffice' => $planInitiative->getPrincipalOffice(),
                'planyear' => $planInitiative->getPlanningYear(),
                'quarters' => $planningquarters,
                'recoverInitiatives' => $recoverData,
                'operationalPlans' => $operationalPlans

            ]);
        }









        return $this->redirectToRoute('plan_index');
    }

    /**
     * @Route("/operationalplan", name="operational_office_plan", methods={"GET","POST"})
     */
    public function  operationalOfficePlan(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $isOperationalSuitableSelected = false;
        $activePlanningYear = $em->getRepository(PlanningYear::class)->findOneBy(['isActive' => 1]);
        $operationalManager = $em->getRepository(OperationalManager::class)->findOneBy(['manager' => $this->getUser(), 'isActive' => 1]);

        $operationaloffice = $operationalManager->getOperationalOffice();
        $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findBy(['planningYear' => $activePlanningYear, 'principalOffice' => $operationaloffice->getPrincipalOffice()]);

        if ($request->request->get('suitableId')) {
            $selectedSuitables = $em->getRepository(SuitableInitiative::class)->findBy(['id' => $request->request->get('suitableId')]);
            foreach ($selectedSuitables as $selectedSuitable) {
                $operationalSuitable = $em->getRepository(SuitableOperational::class)->findOneBy(['suitableInitiative' => $selectedSuitable, 'operationalOffice' => $operationaloffice]);

                if (!$operationalSuitable) {

                    $operationalSuitable = new SuitableOperational();
                    $operationalSuitable->setSuitableInitiative($selectedSuitable);
                    $operationalSuitable->setOperationalOffice($operationaloffice);
                    $operationalSuitable->setStatus(1);

                    $em->persist($operationalSuitable);
                    $em->flush();
                }
            }
            $operationalSuitables = $em->getRepository(SuitableOperational::class)->findBy(['suitableInitiative' => $selectedSuitables, 'operationalOffice' => $operationaloffice]);
            $isOperationalSuitableSelected = true;
            $this->addFlash('success', 'successfuly selected operational suitable');
        }
        if ($request->request->get('planvalue')) {
            $plans = $request->request->get('planvalue');
            $currentPage = $request->request->get("currentPage");
            $suitableInitiativeId = $request->request->get('suitableInitiative');
            $operationalofficeId = $request->request->get('operationalOffice');
            $denominator = null;
            if ($request->request->get('denominator')) {
                $denominator = $request->request->get('denominator');
            }
            $this->addplans($plans, $currentPage, $operationalofficeId, $suitableInitiativeId, $denominator);
            $this->addFlash('success', 'Success');
            return $this->redirectToRoute('operational_office_plan');
        }
        $operationalSuitables = $em->getRepository(SuitableOperational::class)->getBySuitableInitiatve($operationaloffice, $suitableInitiatives);
        if ($operationalSuitables) {
            $isOperationalSuitableSelected = true;
            return $this->render('plan/operational_plan.html.twig', [

                'operationaloffice' => $operationaloffice,
                'pricipaloffice' => $operationaloffice->getPrincipalOffice(),
                'planyear' => $activePlanningYear,
                'isOperationalSuitableSelected' => $isOperationalSuitableSelected,
                'operationalSuitables' => $operationalSuitables

            ]);
        }




        return $this->render('plan/operational_plan.html.twig', [
            'suitableInitiatives' => $suitableInitiatives,
            'operationaloffice' => $operationaloffice,
            'pricipaloffice' => $operationaloffice->getPrincipalOffice(),
            'planyear' => $activePlanningYear,
            'isOperationalSuitableSelected' => $isOperationalSuitableSelected

        ]);
    }

    private function addplans($planValue, $currentpage, $operationaloffice, $suitableInitiative, $denominator = null)
    {
        $em = $this->getDoctrine()->getManager();
        $offices = $em->getRepository(PrincipalOffice::class)->findOfficeByUser($this->getUser());
        $activePlanningYear = $em->getRepository(PlanningYear::class)->findBy(['isActive' => 1]);
        $planningquarters = $em->getRepository(PlanningQuarter::class)->findAll();

        if ($planValue) {

            $planValues = $planValue;
            $currentPage = $currentpage;


            $planInitiative = $em->getRepository(SuitableInitiative::class)->find($suitableInitiative);
            $operationaloffice = $em->getRepository(OperationalOffice::class)->find($operationaloffice);

            $isexist = true;
            $operationalSuitable = $em->getRepository(SuitableOperational::class)->findOneBy(['suitableInitiative' => $planInitiative, 'operationalOffice' => $operationaloffice]);

            if (!$operationalSuitable) {

                $operationalSuitable = new SuitableOperational();
                $operationalSuitable->setSuitableInitiative($planInitiative);
                $operationalSuitable->setOperationalOffice($operationaloffice);
                $operationalSuitable->setStatus(1);
                $isexist = false;
                $em->persist($operationalSuitable);
                $em->flush();
            } else
                $operationalSuitable->setStatus(1);








            if ($denominator) {
                $operationalSuitable->setDenimonator($denominator);
            };




            if (count($planInitiative->getInitiative()->getSocialAtrribute()) > 0) {

                $socalAttributes = $planInitiative->getInitiative()->getSocialAtrribute();



                $numberOfQuarter = count($planningquarters);
                $numberOfAttributes = count($socalAttributes);
                $numberOfPlan = $numberOfAttributes * $numberOfQuarter;

                $i = 0;


                foreach ($planningquarters as $planningquarter) {
                    foreach ($socalAttributes as $key => $socalAttribute) {
                        $edit = true;


                        $planAcomplishment = $em->getRepository(OperationalPlanningAccomplishment::class)->findDuplication($operationalSuitable, $socalAttribute, $planningquarter);
                        $isplanexist = true;
                        if (!$planAcomplishment) {
                            $planAcomplishment = new OperationalPlanningAccomplishment();
                            $isplanexist = false;
                            $edit = false;
                        }


                        $planAcomplishment->setOperationalSuitable($operationalSuitable);
                        $planAcomplishment->setSocialAttribute($socalAttributes[$i % $numberOfAttributes]);


                        if (isset($planValues[$i])) {
                            $planAcomplishment->setPlanValue($planValues[$i]);
                        }
                        $planAcomplishment->setQuarter($planningquarter);
                        if ($edit == false) {
                            $em->persist($planAcomplishment);
                        }


                        $i++;
                    }
                }
                $em->flush();

                $em->clear();
            } else {



                foreach ($planningquarters as $key => $planningquarter) {
                    // $planAcomplishment = null;

                    $planAcomplishment = $em->getRepository(OperationalPlanningAccomplishment::class)->findDuplication($operationalSuitable, null, $planningquarter);
                    $isplanexist = true;
                    if (!$planAcomplishment) {
                        $planAcomplishment = new OperationalPlanningAccomplishment();
                        $isplanexist = false;
                    }

                    $planAcomplishment->setOperationalSuitable($operationalSuitable);
                    $planAcomplishment->setPlanValue($planValues[$key]);
                    $planAcomplishment->setQuarter($planningquarter);

                    if (!$isplanexist) {
                        $em->persist($planAcomplishment);
                    }
                    $em->flush();
                }

                $em->flush();
                $em->clear();
            }


            $this->calculatePrincipalOfficePlan($em, $planInitiative);
            Helper::calculateInitiativePlan($em, $planInitiative);
            if ($operationaloffice->getPrincipalOffice()->getOfficeGroup()) {
                Helper::setOrganizationalInitiativePlan($em, $planInitiative, $operationaloffice->getPrincipalOffice()->getOfficeGroup());
            }
            return true;
        }
        return false;
    }
    /**
     * @Route("/initiative", name="plan_initiative", methods={"GET","POST"})
     */
    public function initiative(InitiativeRepository $initiativeRepository, Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $planyear = $em->getRepository(PlanningYear::class)->find($request->query->get('planyear'));
        $office = $em->getRepository(PrincipalOffice::class)->find($request->query->get('office'));
        $initiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($office->getId());
        $initiativeData = $paginator->paginate($initiatives, $request->query->getInt('page', 1), 3);
        return $this->render('plan/initiative.html.twig', [
            'initiatives' => $initiativeData,
            'planyear' => $planyear,
            'pricipaloffice' =>   $office,
        ]);
    }

    /**
     * @Route("/print", name="plan_print", methods={"GET","POST"})
     */
    public function print(InitiativeRepository $initiativeRepository, Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        $planningquarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $planyear = $em->getRepository(PlanningYear::class)->find($request->request->get('planyear'));
        $office = $em->getRepository(PrincipalOffice::class)->find($request->request->get('office'));
        $initiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($office->getId());
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->setIsHtml5ParserEnabled(true);
        $dompdf = new Dompdf($pdfOptions);
        $suitableInitiatives = $em->getRepository(SuitableInitiative::class)->findByoffice($office, $planyear);
        $res = $this->renderView('plan/plan_print.html.twig', [
            'suitableplans' => $suitableInitiatives,
            'quarters' => $planningquarters,
            'year' => $planyear,
            'office' => $office

        ]);

        $dompdf->loadHtml($res);
        $dompdf->setPaper('A4', 'Landscape');

        // Render the HTML as PDF
        $dompdf->render();
        $dompdf->stream("plan.pdf", [
            "Attachment" => false
        ]);
    }
     /**
     * @Route("/operational_print", name="operational_print", methods={"GET","POST"})
     */
    public function operationalPrint(InitiativeRepository $initiativeRepository, Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();
        // dd(1);
        $planningquarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $planyear = $em->getRepository(PlanningYear::class)->findOneBy(['ethYear'=>$request->request->get('planyear')])->getId();
        $office = $em->getRepository(OperationalOffice::class)->findOneBy(['name'=>$request->request->get('office')])->getId();
        // $initiatives = $em->getRepository(Initiative::class)->findByPrincipalAndOffice($office->getId());
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->set('isRemoteEnabled', true);
        $pdfOptions->setIsHtml5ParserEnabled(true);
        $dompdf = new Dompdf($pdfOptions);
        // dd($planyear);
        $operationalSuitables = $em->getRepository(SuitableOperational::class)->findByoffice($office, $planyear);
        // dd($suitableInitiatives);
        $res = $this->renderView('plan/operational_plan_print.html.twig', [
            'operationalSuitables' => $operationalSuitables,
            'quarters' => $planningquarters,
            'year' => $planyear,
            'office' => $office

        ]);

        $dompdf->loadHtml($res);
        $dompdf->setPaper('A4', 'Landscape');

        // Render the HTML as PDF
        $dompdf->render();
        $dompdf->stream("plan.pdf", [
            "Attachment" => false
        ]);
    }

    /**
     * @Route("/achievement", name="plan_achievement", methods={"GET","POST"})
     */
    public function planAchievement(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();




        return $this->render('plan/plan.achievement.html.twig');

        return $this->redirectToRoute('plan_index');
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
