<?php

namespace App\Controller;

use App\Entity\Goal;
use App\Entity\GoalAchievement;
use App\Entity\Initiative;
use App\Entity\InitiativeAchievement;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\KPiAchievement;
use App\Entity\Objective;
use App\Entity\ObjectiveAchievement;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\Perspective;
use App\Entity\PlanAchievement;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\QuarterAccomplishment;
use App\Entity\Strategy;
use App\Form\PlanAchievementType;
use App\Helper\InitiativeHelper;
use App\Helper\VisualizationHelper;
use App\Repository\GoalRepository;
use App\Repository\InitiativeRepository;
use App\Repository\KeyPerformanceIndicatorRepository;
use App\Repository\ObjectiveRepository;
use App\Repository\PlanAchievementRepository;
use App\Repository\PlanningAccomplishmentRepository;
use App\Repository\PlanningQuarterRepository;
use App\Repository\PlanningYearRepository;
use App\Repository\QuarterAccomplishmentRepository;
use App\Repository\SuitableInitiativeRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/achievement")
 */
class PlanAchievementController extends AbstractController
{
    /**
     * @Route("/goalHome", name="plan_achievement_goal_home")
     */
    public function goalHome(PlanAchievementRepository $planAchievementRepository, GoalRepository $goalRepository, PaginatorInterface $paginator, Request $request, PlanningYearRepository $planningYearRepository): Response
    {


        $em = $this->getDoctrine()->getManager();

        $datas = VisualizationHelper::goal($em);
        $query = $goalRepository->findAlls();

        return $this->render('plan_achievement/goal.home.html.twig', [


            'data' => $datas
        ]);
    }
    /**
     * @Route("/planHome", name="plan_achievement_plan_home")
     */
    public function visualizionAchievement(PlanAchievementRepository $planAchievementRepository, GoalRepository $goalRepository, PaginatorInterface $paginator, Request $request, PlanningYearRepository $planningYearRepository): Response
    {


        $em = $this->getDoctrine()->getManager();




        $datas = VisualizationHelper::goal($em);
        

        $objectives = $em->getRepository(Objective::class)->findAll();
        return $this->render('plan_achievement/achievement.visualization.html.twig', [


            'data' => $datas,
            'objectives' => $objectives
        ]);
    }
    /**
     * @Route("/", name="plan_achievement_index")
     */
    public function index(PlanAchievementRepository $planAchievementRepository, GoalRepository $goalRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $datas = VisualizationHelper::goal($em);
        return $this->render('plan_achievement/index.html.twig', [

            'data' => $datas
        ]);
    }
    /**
     * @Route("/goal", name="plan_achievement_goal")
     */
    public function goal(PlanAchievementRepository $planAchievementRepository, GoalRepository $goalRepository, PaginatorInterface $paginator, Request $request, PlanningYearRepository $planningYearRepository): Response
    {


        $em = $this->getDoctrine()->getManager();
        $filterform = $this->createFormBuilder()
            ->setMethod('Get')
            ->add('goal', EntityType::class, [
                'class' => Goal::class,
                'multiple' => true,
                'required' => false
            ])


            ->add('year', EntityType::class, [
                'class' => PlanningYear::class,
                'multiple' => true,
                'required' => false,

            ])
            ->getForm();
        $filterform->handleRequest($request);
        if ($request->request->get('reload')) {

            InitiativeHelper::goalSync($em);
            $this->addFlash('success', 'load successfuly');
            return $this->redirectToRoute('plan_achievement_goal');
        }
        $datas = VisualizationHelper::goal($em);
        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $query = $em->getRepository(GoalAchievement::class)->search($filterform->getData());
        } else
            $query = $em->getRepository(GoalAchievement::class)->findAlls();;
        $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
        return $this->render('plan_achievement/goal.html.twig', [
            'plan_achievements' => $data,

            'data' => $datas,
            'filterform' => $filterform->createView(),
        ]);
    }

    /**
     * @Route("/kpivis", name="plan_achievement_kpi_vis")
     */
    public function goalVisualision(PlanAchievementRepository $planAchievementRepository, GoalRepository $goalRepository, PaginatorInterface $paginator, Request $request, PlanningYearRepository $planningYearRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $planyears = $planningYearRepository->findAll();



        if ($request->query->get('kpi')) {
            $kpi = $goalRepository->find($request->query->get('kpi'));
            $year = array();
            $accomp = array();
            foreach ($planyears as  $planyear) {
                array_push($year, date_format($planyear->getYear(), "Y"));
                $kpiAccomp = $planAchievementRepository->findByKpi($kpi, $planyear);
                if ($kpiAccomp)

                    array_push($accomp, $kpiAccomp->getAccomplishmentValue());

                else
                    array_push($accomp, 0);
            }
            //  dd($kpi->getPlanAchievements());
            $responce = $this->renderView('plan_achievement/kpi_vis.html.twig', [
                'year' => $year,
                'accomp' => $accomp,
                'kpi' => $kpi
            ]);
            return new Response($responce);
        }
        return new Response('hello');
    }


    /**
     * @Route("/objective", name="plan_achievement_objective")
     */
    public function objective(PlanAchievementRepository $planAchievementRepository, ObjectiveRepository $objectiveRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
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

            ->add('year', EntityType::class, [
                'class' => PlanningYear::class,
                'multiple' => true,
                'required' => false,

            ])
            ->getForm();
        $filterform->handleRequest($request);
        if ($request->request->get('reload')) {

            InitiativeHelper::objectiveSync($em);
            $this->addFlash('success', 'load successfuly');
            return $this->redirectToRoute('plan_achievement_objective');
        }
    //  VisualizationHelper::objective($em);
        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $query = $em->getRepository(ObjectiveAchievement::class)->search($filterform->getData());
        } else
            $query = $em->getRepository(ObjectiveAchievement::class)->findAlls();
        $data = $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
        $objectives=$em->getRepository(Objective::class)->findAll();
        
        return $this->render('plan_achievement/objective.html.twig', [
            'plan_achievements' => $data,
            
            'filterform' => $filterform->createView(),
            'objectives'=>$objectives
        ]);
    }

    /**
     * @Route("/kpi", name="plan_achievement_kpi")
     */
    public function kpi(PlanAchievementRepository $planAchievementRepository, KeyPerformanceIndicatorRepository $keyPerformanceIndicatorRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
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
            ->add('year', EntityType::class, [
                'class' => PlanningYear::class,
                'multiple' => true,
                'required' => false,

            ])
            ->getForm();
        $filterform->handleRequest($request);
        
        if ($request->request->get('reload')) {

            InitiativeHelper::kpiSync($em);
            $this->addFlash('success', 'load successfuly');
            return $this->redirectToRoute('plan_achievement_kpi');
        }
        if ($filterform->isSubmitted() && $filterform->isValid()) {
            $query = $em->getRepository(KPiAchievement::class)->search($filterform->getData());
        } else
            $query = $em->getRepository(KPiAchievement::class)->findAlls();
        $kpis = $keyPerformanceIndicatorRepository->findAll();
        $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
    // dd(VisualizationHelper::Kpi($em,[]));

        return $this->render('plan_achievement/kpi.html.twig', [
            'plan_achievements' =>  $data,
            'filterform' => $filterform->createView(),
            'kpis' => $kpis
        ]);
    }
    /**
     * @Route("/kpivis", name="plan_achievement_kpi_vis")
     */
    public function kpiVisualision(PlanAchievementRepository $planAchievementRepository, KeyPerformanceIndicatorRepository $keyPerformanceIndicatorRepository, PaginatorInterface $paginator, Request $request, PlanningYearRepository $planningYearRepository): Response
    {
        $em = $this->getDoctrine()->getManager();
        $planyears = $planningYearRepository->findAll();

        if ($request->query->get('objective')) {
            $objectives = $em->getRepository(Objective::class)->findBy(['id' => $request->query->get('objective')]);
            $datas = VisualizationHelper::objective($em, $objectives);
            $responce = $this->renderView('plan_achievement/obj.vis.html.twig', [
                'data' => $datas,

            ]);
            return new Response($responce);
        }

        if ($request->query->get('kpi')) {
            $kpi = $keyPerformanceIndicatorRepository->findBy(['id'=> $request->query->get('kpi')]);
          
            $datas=VisualizationHelper::Kpi($em,$kpi);
            $responce = $this->renderView('plan_achievement/kpi_vis.html.twig', [
                'data'=>$datas,
              
                'kpi' => $kpi
            ]);
            return new Response($responce);
        }
        if ($request->query->get('initiatives')) {
            $initiative = $em->getRepository(Initiative::class)->findBy(['id' => $request->query->get('initiatives')]);

            $datas = VisualizationHelper::initiative($em, $initiative);
            $responce = $this->renderView('plan_achievement/initiative_vis.html.twig', [
                'data' => $datas,

                // 'kpi' => $kpi
            ]);
            return new Response($responce);
        }
        if ($request->query->get('objectives')) {
            $objective = $em->getRepository(Objective::class)->findBy(['id' => $request->query->get('objectives')]);

            $datas = VisualizationHelper::objective($em, $objective);
            $responce = $this->renderView('plan_achievement/objective_vis.html.twig', [
                'data' => $datas,

                // 'kpi' => $kpi
            ]);
            return new Response($responce);
        }
        return new Response('hello');
    }

    /**
     * @Route("/initiative", name="plan_achievement_initiative")
     */
    public function initiative(
        PlanAchievementRepository $planAchievementRepository,
        InitiativeRepository $initiativeRepository,
        PlanningYearRepository $planningYearRepository,
        PlanningQuarterRepository $planningQuarterRepository,
        SuitableInitiativeRepository $suitableInitiativeRepository,
        PlanningAccomplishmentRepository $planningAccomplishmentRepository,
        QuarterAccomplishmentRepository $quarterAccomplishmentRepository,
        PaginatorInterface  $paginator,
        Request $request

    ): Response {
        $em = $this->getDoctrine()->getManager();

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
            ->add('initiative', EntityType::class, [
                'class' => Initiative::class,
                'multiple' => true,
                'required' => false,

            ])
            ->add('year', EntityType::class, [
                'class' => PlanningYear::class,
                'multiple' => true,
                'required' => false,

            ])
            ->getForm();
        $filterform->handleRequest($request);
        // if ($request->request->get('reload')) {

        //     InitiativeHelper::sync($em);
        //     $this->addFlash('success', 'load successfuly');
        //     return $this->redirectToRoute('plan_achievement_initiative');
        // }


        if ($filterform->isSubmitted()) {

            $query = $em->getRepository(InitiativeAchievement::class)->search($filterform->getData());
        } else
            $query = $em->getRepository(InitiativeAchievement::class)->findAlls();
        $data = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );
        $datas=VisualizationHelper::Initiative($em, []);
        $initiatives=$em->getRepository(Initiative::class)->findAll();
        return $this->render('plan_achievement/initiative.html.twig', [
            'plan_achievements' =>  $data,
            'filterform' => $filterform->createView(),
            'data'=>$datas,
            'initiatives'=>$initiatives
        ]);
    }
    /**
     * @Route("/sync", name="plan_achievement_initiative_syc")
     */
    public function Syncinitiative(
        PlanAchievementRepository $planAchievementRepository,
        InitiativeRepository $initiativeRepository,
        PlanningYearRepository $planningYearRepository,
        PlanningQuarterRepository $planningQuarterRepository,
        SuitableInitiativeRepository $suitableInitiativeRepository,
        PlanningAccomplishmentRepository $planningAccomplishmentRepository,
        QuarterAccomplishmentRepository $quarterAccomplishmentRepository

    ): Response {

        $em = $this->getDoctrine()->getManager();
        $data=$em->getRepository(PlanningAccomplishment::class)->SumByInitiativeAndYear();

   
        return $this->render('plan_achievement/initiative.html.twig', [
            'plan_achievements' => $planAchievementRepository->findAll(),
        ]);
    }
    /**
     * @Route("/initiative-progress", name="plan_achievement_initiative_progress")
     */
    public function initiativeProgress(
        PlanAchievementRepository $planAchievementRepository,
        InitiativeRepository $initiativeRepository,
        PlanningYearRepository $planningYearRepository,
        PlanningQuarterRepository $planningQuarterRepository,
        SuitableInitiativeRepository $suitableInitiativeRepository,
        PlanningAccomplishmentRepository $planningAccomplishmentRepository,
        QuarterAccomplishmentRepository $quarterAccomplishmentRepository

    ): Response {

        $em = $this->getDoctrine()->getManager();
        $years=$em->getRepository(PlanningYear::class)->findAll();
        $initiative=$em->getRepository(Initiative::class)->findAll();
      
        return $this->render('plan_achievement/progress/initiative.html.twig', [
            'years' =>
            $years,
            'initiatives'=>$initiative
        ]);
    }

    /**
     * @Route("/new", name="plan_achievement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $planAchievement = new PlanAchievement();
        $form = $this->createForm(PlanAchievementType::class, $planAchievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($planAchievement);
            $entityManager->flush();

            return $this->redirectToRoute('plan_achievement_index');
        }

        return $this->render('plan_achievement/new.html.twig', [
            'plan_achievement' => $planAchievement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_achievement_show", methods={"GET"})
     */
    public function show(PlanAchievement $planAchievement): Response
    {
        return $this->render('plan_achievement/show.html.twig', [
            'plan_achievement' => $planAchievement,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="plan_achievement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, PlanAchievement $planAchievement): Response
    {
        $form = $this->createForm(PlanAchievementType::class, $planAchievement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('plan_achievement_index');
        }

        return $this->render('plan_achievement/edit.html.twig', [
            'plan_achievement' => $planAchievement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="plan_achievement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, PlanAchievement $planAchievement): Response
    {
        if ($this->isCsrfTokenValid('delete' . $planAchievement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($planAchievement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('plan_achievement_index');
    }
}
