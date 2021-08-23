<?php

namespace App\Helper;

use App\Entity\Goal;
use App\Entity\Initiative;
use App\Entity\Objective;
use App\Entity\PlanAchievement;
use App\Entity\PlanningYear;
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
        $goals =$em->getRepository(Goal::class)->findAll();
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
            $datas['goal']=$goalDatas;
            return $datas;
    }
     public static function  objective(EntityManagerInterface $em,$objective=[])
    {
        $datas = [];
        $objectiveDatas = [];
        if(count($objective)<1)
        $objectives =$em->getRepository(Objective::class)->findAll();
        else
         $objectives=$objective;
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
            $datas['objective']=$objectiveDatas;
            return $datas;
    }
    public static function  Initiative(EntityManagerInterface $em,$initiative=[])
    {
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $datas = [];
        $initiativeDatas = [];
        $year=[];
        if(count($initiative)<1)
        $initiatives =$em->getRepository(Initiative::class)->findByJu();
        else
         $initiatives=$initiative;
        foreach ($initiatives as $key => $initiative) {
            $initiativedata = [];


            $achieveData = [];
            foreach ($planningYears as $planningYear) {
             $achievement = $em->getRepository(PlanAchievement::class)->findByInitiative($initiative,$planningYear);
              if($achievement){
                  $achieveData[]=$achievement->getPlan();
                   $achieveData[] = $achievement->getAccomplishmentValue();
                   
              }
              else{

                  $achieveData[]=0;
                  $achieveData[]=0;
              }
          
           

           
            $initiativedata['name'] = $initiative->getName();
            $initiativedata['achieve'] = $achieveData;
            


            $initiativeDatas[$key] = $initiativedata;
        }
          }
           $datas['year'] = self::getYear($em);
            $datas['initiative']=$initiativeDatas;
            return $datas;
    }
    public static function getYear($em)
    {
        $planyears =$em->getRepository(PlanningYear::class)->findAll();

        $planyear = array_map(function ($year) {
            return date_format($year->getYear(), "Y");
        }, $planyears);
        return $planyear;
    }
}
