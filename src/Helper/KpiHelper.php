<?php

namespace App\Helper;

use App\Entity\Goal;
use App\Entity\GoalAchievement;
use App\Entity\InistuitionPlan;
use App\Entity\InistuitionSuitableInitiative;
use App\Entity\Initiative;
use App\Entity\InitiativeAchievement;
use App\Entity\InitiativeAttribute;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\KPiAchievement;
use App\Entity\KpiQuarterPlan;
use App\Entity\Objective;
use App\Entity\ObjectiveAchievement;
use App\Entity\OfficeKpiPlan;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\PrincipalOffice;
use App\Entity\PrincipalOfficeGroup;
use App\Entity\QuarterPlanAchievement;
use App\Entity\SuitableInitiative;
use App\Entity\SuitableOperational;
use Doctrine\ORM\EntityManagerInterface;

class KpiHelper
{

public static function setOfficeKpiPlan(EntityManagerInterface $em,$suitableInitiative){


        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $initiative = $em->getRepository(Initiative::class)->find($suitableInitiative->getInitiative()->getId());
        $office=$em->getRepository(PrincipalOffice::class)->find($suitableInitiative->getPrincipalOffice());
        $kpi=$initiative->getKeyPerformanceIndicator();
        $officeKpiPlan=$em->getRepository(OfficeKpiPlan::class)->findOneBy(['kpi'=>$kpi,'year'=>$year,'office'=>$office]);
        if(!$officeKpiPlan)
        {
            $officeKpiPlan=new OfficeKpiPlan();
            $officeKpiPlan->setKpi($kpi);
            $officeKpiPlan->setOffice($office);
            $officeKpiPlan->setYear($year);
            $em->persist($officeKpiPlan);
            $em->flush();

        }
        foreach($quarters as $quarter){
            $kpiQuarterPlan = $em->getRepository(KpiQuarterPlan::class)->findOneBy(['officeKpi' => $officeKpiPlan, 'quarter' => $quarter]);
            if(!$kpiQuarterPlan){
                $kpiQuarterPlan=new KpiQuarterPlan();
                $kpiQuarterPlan->setQuarter($quarter);
                $kpiQuarterPlan->setOfficeKpi($officeKpiPlan);
                $em->persist($kpiQuarterPlan);
            }
            $plan=$em->getRepository(PlanningAccomplishment::class)->getPlanByKpiAndYear($kpi, $year, $office, $quarter);
            $kpiQuarterPlan->setPlan($plan);
            $em->flush();

        }
       
        return ;
}

}
