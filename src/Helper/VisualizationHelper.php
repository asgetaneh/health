<?php

namespace App\Helper;

use App\Entity\Goal;
use App\Entity\Initiative;
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



    public static function  goal(EntityManagerInterface $em)
    {
        $datas = [];
        $goalDatas = [];
        $goals = $em->getRepository(Goal::class)->findAll();
        foreach ($goals as $key => $goal) {
            $goaldata = [];


            $achieveData = [];
            $goalAchievements = $em->getRepository(PlanAchievement::class)->getByGoal($goal);

            foreach ($goalAchievements as $key2 => $achievement) {

                $achieveData[$key2] = $achievement->getAccomplishmentValue();
            }
            $goaldata['name'] = $goal->getName();
            $goaldata['achieve'] = $achieveData;

            $goalDatas[$key] = $goaldata;
        }
        $datas['year'] = self::getYear($em);
        $datas['goal'] = $goalDatas;
        return $datas;
    }
    public static function  objective(EntityManagerInterface $em, $objective = [])
    {
        $datas = [];
        $objectiveDatas = [];
        if (count($objective) < 1)
            $objectives = $em->getRepository(Objective::class)->findAll();
        else
            $objectives = $objective;
        foreach ($objectives as $key => $objective) {
            $objectivedata = [];


            $achieveData = [];
            $objectiveAchievements = $em->getRepository(PlanAchievement::class)->getByObj($objective);

            foreach ($objectiveAchievements as $key2 => $achievement) {

                $achieveData[$key2] = $achievement->getAccomplishmentValue();
            }
            $objectivedata['name'] = $objective->getName();
            $objectivedata['achieve'] = $achieveData;

            $objectiveDatas[$key] = $objectivedata;
        }
        $datas['year'] = self::getYear($em);
        $datas['objective'] = $objectiveDatas;
        return $datas;
    }
    public static function  Initiative(EntityManagerInterface $em, $initiative = [])
    {
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $datas = [];
        $initiativeDatas = [];
        $year = [];
        

        if (count($initiative) < 1)
             $initiatives = $em->getRepository(Initiative::class)->findByJu();
            // $initiatives = $em->getRepository(Initiative::class)->findBy(['id'=>20]);
        else
            $initiatives = $initiative;
            $dataLabels=[];
            $labels=[];
        foreach ($planningYears as $key2 =>  $planningYear) {
            $year[$key2] = date_format($planningYear->getYear(), "Y");
             $initiativedata = [];
             $achieveData = [];
            //   $dataLabels=[];
           

            foreach ($initiatives as $key => $initiative) {
            $labels[$key] = $initiative->getName();
                  

                

                $plan = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanByInitiative($initiative, $planningYear);
                $achievement = $em->getRepository(QuarterPlanAchievement::class)->getYearlyPlanAccompByInitiative($initiative, $planningYear);
                if ($plan) {
                    $achieveData[] = $plan;
                   
                } else {

                    $achieveData[] = 0;
                  
                }
                 if ($achievement) {
                    $achieveData[] = $achievement;
                    
                } else {

                   
                    $achieveData[] = 0;
                }
                 $dataLabels[]="Plan";
                 $dataLabels[]="Accomp";




               
               



                
            }
             $initiativedata['plan'] = $achieveData;
             
              $initiativedata['year'] = date_format($planningYear->getYear(), "Y");
             $initiativeDatas[$key2] = $initiativedata;
           
        }
        $datas['year'] = $year;
        $datas['initiative'] = $initiativeDatas;
         $datas['labels'] = $labels;
            $datas['datalabels'] =$dataLabels;
         
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
