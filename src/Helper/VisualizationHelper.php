<?php

namespace App\Helper;

use App\Entity\Goal;
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



    // public function __construct(EntityManagerInterface $entityManager, PlanAchievementRepository $planAchievementRepository, GoalRepository $goalRepository, PlanningYearRepository $planningYearRepository)
    // {
    //     $this->entityManager = $entityManager;
    //     $this->planAchievementRepository = $planAchievementRepository;
    //     $this->goalRepository = $goalRepository;
    //     $this->planningYearRepository = $planningYearRepository;
    // }
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
    public static function getYear($em)
    {
        $planyears =$em->getRepository(PlanningYear::class)->findAll();

        $planyear = array_map(function ($year) {
            return date_format($year->getYear(), "Y");
        }, $planyears);
        return $planyear;
    }
}
