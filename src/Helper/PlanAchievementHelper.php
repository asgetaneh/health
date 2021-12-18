<?php

namespace App\Helper;

use App\Entity\Initiative;
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
        return;
    }
    public static function setKpiAchievement(EntityManagerInterface $em, $suitableInitiative)
    {
        $em->clear();
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $kpi = $em->getRepository(KeyPerformanceIndicator::class)->find($suitableInitiative->getInitiative()->getKeyPerformanceIndicator()->getId());
        $kpiAchievement = $em->getRepository(KpiAchievement::class)->getByKpiAndYear($kpi, $year);
        $initiatives = $kpi->getInitiatives();

        foreach ($quarters as  $quarter) {
            $accomp = 0;
            $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->getByKpiAchievementAndQuarter($kpiAchievement, $quarter);

            foreach ($initiatives as $initiative) {

                $accompPlan = $em->getRepository(QuarterPlanAchievement::class)->getByInitiativeAndQuarter($initiative, $quarter, $year);
                $accompValue = 0;
                $wieght = $initiative->getWieght();
                if ($accompPlan) {
                    $accompValue = $accompPlan->getAccomp();
                    $plan = $accompPlan->getPlan();

                    $accomp = $accomp + ($accompValue / $plan) * $wieght;
                }
            }
            $quarterPlanAchievement->setAccomp($accomp);
            $em->flush();



            // $quarterPlanAchievement->setPlan($plan);
        }
        return;
    }
    public static function setObjectiveAchievement(EntityManagerInterface $em, $suitableInitiative)
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
        return;
    }
}
