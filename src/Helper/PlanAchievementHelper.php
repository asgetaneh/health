<?php

namespace App\Helper;

use App\Entity\Goal;
use App\Entity\GoalAchievement;
use App\Entity\Initiative;
use App\Entity\InitiativeAchievement;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\KPiAchievement;
use App\Entity\Objective;
use App\Entity\ObjectiveAchievement;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\QuarterPlanAchievement;
use Doctrine\ORM\EntityManagerInterface;

class PlanAchievementHelper
{
    public static function setInitiativeAchievement(EntityManagerInterface $em, $suitableInitiative)
    {
        $em->clear();
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $initiative = $em->getRepository(Initiative::class)->find($suitableInitiative->getInitiative()->getId());
        $initiativeAchievement = $em->getRepository(InitiativeAchievement::class)->getByInitiativeAndYear($initiative, $year);

        foreach ($quarters as  $quarter) {


            $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->findByInitiativeAchievementAndQuarter($initiativeAchievement, $quarter);

            $plan = $quarterPlanAchievement->getPlan();
            $accomp = $em->getRepository(PlanningAccomplishment::class)->calulateAchievementByInitiativeAndYear($suitableInitiative->getInitiative(), $suitableInitiative->getPlanningYear(), $quarter);
            $quarterPlanAchievement->setAccomp($accomp);
            $em->flush();
        }
        // self::setKpiAchievement($em,$suitableInitiative);
        // self::setObjectiveAchievement($em, $suitableInitiative);
        // self::setGoalAchievement($em, $suitableInitiative);
        return;
    }
    public static function setKpiAchievement(EntityManagerInterface $em, $suitableInitiative)
    {
        $em->clear();
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $kpi = $em->getRepository(KeyPerformanceIndicator::class)->find($suitableInitiative->getInitiative()->getKeyPerformanceIndicator()->getId());
        $kpiAchievement = $em->getRepository(KPiAchievement::class)->getByKpiAndYear($kpi, $year);
        $initiatives = $kpi->getInitiatives();

        foreach ($quarters as  $quarter) {
            $accomp = 0;
            $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->getByKpiAchievementAndQuarter($kpiAchievement, $quarter);

            foreach ($initiatives as $initiative) {

                $accompPlan = $em->getRepository(QuarterPlanAchievement::class)->getByInitiativeAndQuarter($initiative, $quarter, $year);
                $accompValue = 0;
                $wieght = $initiative->getWeight();

                if ($accompPlan) {
                    $accompValue = $accompPlan->getAccomp();
                    $plan = $accompPlan->getPlan();
                    if ($plan) {
                    $accomp = $accomp + ($accompValue / $plan) * $wieght;
                    }

                }
            }
            $accomp=round($accomp, 2);
            $quarterPlanAchievement->setAccomp($accomp);
            $em->flush();
        }
        return;
    }
    public static function setObjectiveAchievement(EntityManagerInterface $em, $suitableInitiative)
    {
        $em->clear();
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $kpi = $em->getRepository(KeyPerformanceIndicator::class)->find($suitableInitiative->getInitiative()->getKeyPerformanceIndicator()->getId());

        $objective = $em->getRepository(Objective::class)->find($kpi->getStrategy()->getObjective()->getId());
        $objectiveAchievement = $em->getRepository(ObjectiveAchievement::class)->getByObjectiveAndYear($objective, $year);
        $kpis = $objective->getKeyPerformanceIndicators();

        foreach ($quarters as  $quarter) {
            $accomp = 0;
            $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->getByObjectiveAchievementAndQuarter($objectiveAchievement, $quarter);

            foreach ($kpis as $kpi) {

                $accompPlan = $em->getRepository(QuarterPlanAchievement::class)->getByKpiAndQuarter($kpi, $quarter, $year);
                // dd($accompPlan);
                $accompValue = 0;
                $wieght = $kpi->getWeight();
                // dd($wieght);
                if ($accompPlan) {
                                    if ($plan = $accompPlan->getPlan()) {

                    $accompValue = $accompPlan->getAccomp();
                    $plan = $accompPlan->getPlan();
                    $accomp = $accomp + ($accompValue / $plan) * $wieght;
                }}
            }
         $accomp=round($accomp, 2);
            $quarterPlanAchievement->setAccomp($accomp);
            $em->flush();
        }
        return;
    }
    public static function setGoalAchievement(EntityManagerInterface $em, $suitableInitiative)
    {
        $em->clear();
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $kpi = $em->getRepository(KeyPerformanceIndicator::class)->find($suitableInitiative->getInitiative()->getKeyPerformanceIndicator()->getId());

        $objective = $em->getRepository(Objective::class)->find($kpi->getStrategy()->getObjective()->getId());
        $goal = $em->getRepository(Goal::class)->find($objective->getGoal()->getId());
        $goalAchievement = $em->getRepository(GoalAchievement::class)->getByGoalAndYear($goal, $year);
        $objectives = $goal->getObjectives();

        foreach ($quarters as  $quarter) {
            $accomp = 0;
          
            $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->getByGoalAchievementAndQuarter($goalAchievement, $quarter);

            foreach ($objectives as $objective) {

                $accompPlan = $em->getRepository(QuarterPlanAchievement::class)->getByObjectiveAndQuarter($objective, $quarter, $year);
                $accompValue = 0;
                $wieght = $objective->getWeight();
                if ($accompPlan) {
                    $accompValue = $accompPlan->getAccomp();
                    $plan = $accompPlan->getPlan();

                    $accomp = $accomp + ($accompValue / $plan) * $wieght;
                }
            }
                     $accomp=round($accomp, 2);

            $quarterPlanAchievement->setAccomp($accomp);
            $em->flush();
                   }
        return;
    }
}
