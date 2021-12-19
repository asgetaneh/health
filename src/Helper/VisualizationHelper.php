<?php

namespace App\Helper;

use App\Entity\Goal;
use App\Entity\Initiative;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\Objective;
use App\Entity\PlanAchievement;
use App\Entity\PlanningYear;
use App\Entity\QuarterPlanAchievement;
use App\Repository\GoalRepository;
use App\Repository\PlanAchievementRepository;
use App\Repository\PlanningYearRepository;
use Doctrine\ORM\EntityManagerInterface;

class VisualizationHelper
{
    private  EntityManagerInterface $entityManager;
    private static PlanAchievementRepository $planAchievementRepository;
    private static GoalRepository $goalRepository;
    private static PlanningYearRepository $planningYearRepository;



   
    
    public static function  Initiative(EntityManagerInterface $em, $initiative = [])
    {
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $datas = [];
        $initiativeDatas = [];
        $year = [];


        if (count($initiative) < 1)
            //  $initiatives = $em->getRepository(Initiative::class)->findByJu();
            $initiatives = $em->getRepository(Initiative::class)->findBy(['id' => 20]);
        else
            $initiatives = $initiative;
        $dataLabels = [];
        $labels = [];



        foreach ($initiatives as $key => $initiative) {
            $initiativedata = [];
            $achieveData = [];
            $planData = [];
            $labels[$key] = $initiative->getName();
            foreach ($planningYears as $key2 =>  $planningYear) {





                $plan = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanByInitiative($initiative, $planningYear);
                $achievement = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanAccompByInitiative($initiative, $planningYear);

                if ($plan) {
                    $planData[$key2] = $plan;
                } else {

                    $planData[$key2] = 0;
                }
                if ($achievement) {
                    $achieveData[$key2] = $achievement;
                } else {


                    $achieveData[$key2] = 0;
                }
            }
            $initiativedata['name'] = " Plan of" . $initiative->getName();
            $initiativedata['plan'] = $planData;

            $initiativedata['accomp'] = " Accomp Of " . $initiative->getName();
            $initiativedata['achieve'] = $achieveData;


            $initiativeDatas[$key] = $initiativedata;
        }


        $datas['year'] = self::getYear($em);




        $datas['initiative'] = $initiativeDatas;
        //  $datas['labels'] = $labels;
        // $datas['datalabels'] =$dataLabels;
        // dd($datas
        // );

        return $datas;
    }
    public static function  Kpi(EntityManagerInterface $em, $kpi = [])
    {
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $datas = [];
        $kpiDatas = [];
        $year = [];


        if (count($kpi) < 1)
            $kpis = $em->getRepository(KeyPerformanceIndicator::class)->findAll();
            //$kpis = $em->getRepository(KeyPerformanceIndicator::class)->findBy(['id' => 20]);
        else
            $kpis = $kpi;
        $dataLabels = [];
        $labels = [];



        foreach ($kpis as $key => $kpi) {
            $kpidata = [];
            $achieveData = [];
            $planData = [];
            $labels[$key] = $kpi->getName();
            foreach ($planningYears as $key2 =>  $planningYear) {





                $plan = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanByKpi($kpi, $planningYear);
                $achievement = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanAccompByKpi($kpi, $planningYear);

                if ($plan) {
                    $planData[$key2] = $plan;
                } else {

                    $planData[$key2] = 0;
                }
                if ($achievement) {
                    $achieveData[$key2] = $achievement;
                } else {


                    $achieveData[$key2] = 0;
                }
            }
            $kpidata['name'] = " Plan of" . $kpi->getName();
            $kpidata['plan'] = $planData;

            $kpidata['accomp'] = " Accomp Of " . $kpi->getName();
            $kpidata['achieve'] = $achieveData;


            $kpiDatas[$key] = $kpidata;
        }


        $datas['year'] = self::getYear($em);




        $datas['kpi'] = $kpiDatas;
        //  $datas['labels'] = $labels;
        // $datas['datalabels'] =$dataLabels;
        // dd($datas
        // );

        return $datas;
    }
    public static function  Objective(EntityManagerInterface $em, $objective = [])
    {
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $datas = [];
        $objectiveDatas = [];
        $year = [];


        if (count($objective) < 1)
              $objectives = $em->getRepository(Objective::class)->findAll();
           // $objectives = $em->getRepository(Objective::class)->findBy(['id' => 20]);
        else
            $objectives = $objective;
        $dataLabels = [];
        $labels = [];



        foreach ($objectives as $key => $objective) {
            $objectivedata = [];
            $achieveData = [];
            $planData = [];
            $labels[$key] = $objective->getName();
            foreach ($planningYears as $key2 =>  $planningYear) {





                $plan = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanByObjective($objective, $planningYear);
                $achievement = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanAccompByObjective($objective, $planningYear);

                if ($plan) {
                    $planData[$key2] = $plan;
                } else {

                    $planData[$key2] = 0;
                }
                if ($achievement) {
                    $achieveData[$key2] = $achievement;
                } else {


                    $achieveData[$key2] = 0;
                }
            }
            $objectivedata['name'] = " Plan of" . $objective->getName();
            $objectivedata['plan'] = $planData;

            $objectivedata['accomp'] = " Accomp Of " . $objective->getName();
            $objectivedata['achieve'] = $achieveData;


            $objectiveDatas[$key] = $objectivedata;
        }


        $datas['year'] = self::getYear($em);




        $datas['objective'] = $objectiveDatas;
        //  $datas['labels'] = $labels;
        // $datas['datalabels'] =$dataLabels;
        // dd($datas );


        return $datas;
    }

    public static function  goal(EntityManagerInterface $em, $goal = [])
    {
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $datas = [];
        $goalDatas = [];
        $year = [];


        if (count($goal) < 1)
            $goals = $em->getRepository(Goal::class)->findAll();
        // $goals = $em->getRepository(goal::class)->findBy(['id' => 20]);
        else
            $goals = $goal;
        $dataLabels = [];
        $labels = [];



        foreach ($goals as $key => $goal) {
            $goaldata = [];
            $achieveData = [];
            $planData = [];
            $labels[$key] = $goal->getName();
            foreach ($planningYears as $key2 =>  $planningYear) {





                $plan = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanByGoal($goal, $planningYear);
                $achievement = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanAccompByGoal($goal, $planningYear);

                if ($plan) {
                    $planData[$key2] = $plan;
                } else {

                    $planData[$key2] = 0;
                }
                if ($achievement) {
                    $achieveData[$key2] = $achievement;
                } else {


                    $achieveData[$key2] = 0;
                }
            }
            $goaldata['name'] = " Plan of" . $goal->getName();
            $goaldata['plan'] = $planData;

            $goaldata['accomp'] = " Accomp Of " . $goal->getName();
            $goaldata['achieve'] = $achieveData;


            $goalDatas[$key] = $goaldata;
        }


        $datas['year'] = self::getYear($em);




        $datas['goal'] = $goalDatas;
        //  $datas['labels'] = $labels;
        // $datas['datalabels'] =$dataLabels;
        // dd($datas );


        return $datas;
    }
    public static function getYear($em)
    {
        $planyears = $em->getRepository(PlanningYear::class)->findAll();

        $planyear = array_map(function ($year) {
            return date_format($year->getYear(), "Y");
        }, $planyears);
        return $planyear;
    }
}
