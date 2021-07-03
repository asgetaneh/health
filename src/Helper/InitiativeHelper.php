<?php

namespace App\Helper;

use App\Entity\Goal;
use App\Entity\Initiative;
use App\Entity\KeyPerformanceIndicator;
use App\Entity\Objective;
use App\Entity\PlanAchievement;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\PlanningYear;
use App\Entity\QuarterAccomplishment;
use App\Entity\SuitableInitiative;
use App\Repository\InitiativeRepository;
use App\Repository\KeyPerformanceIndicatorRepository;
use App\Repository\PlanAchievementRepository;
use App\Repository\PlanningAccomplishmentRepository;
use App\Repository\PlanningQuarterRepository;
use App\Repository\PlanningYearRepository;
use App\Repository\QuarterAccomplishmentRepository;
use App\Repository\SuitableInitiativeRepository;
use Doctrine\ORM\EntityManagerInterface;

class InitiativeHelper
{

    public static function sync(
        EntityManagerInterface $em

    ) {
        $initiatives = $em->getRepository(Initiative::class)->findAll();
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $quarters =  $em->getRepository(PlanningQuarter::class)->findAll();

        foreach ($initiatives as $initiative) {
            $initiativeWeight = $initiative->getWeight();
            foreach ($planningYears as $planningYear) {
                $suitableInitiatives =  $em->getRepository(SuitableInitiative::class)->findByYear($initiative, $planningYear);
                $totalOffice = count($suitableInitiatives);

                $planAchievement = $em->getRepository(PlanAchievement::class)->findByInitiative($initiative, $planningYear);
                $isNotexist = false;
                if (!$planAchievement) {
                    $planAchievement = new PlanAchievement();
                    $planAchievement->setInitiative($initiative);
                    $planAchievement->setYear($planningYear);
                    $isNotexist = true;
                    $em->persist($planAchievement);
                }

                foreach ($quarters as  $quarter) {
                    $totalPlan = 0;
                    $totalAccomp = 0;
                    if (!$isNotexist)
                        $quarterAchievement = $em->getRepository(QuarterAccomplishment::class)->findByAchievement($planAchievement, $quarter);
                    $isexist = true;

                    if (!isset($quarterAchievement)) {

                        $quarterAchievement = new QuarterAccomplishment();
                        $quarterAchievement->setQuarter($quarter);
                        $quarterAchievement->setYearPlan($planAchievement);

                        $isexist = false;
                    }

                    foreach ($suitableInitiatives as $suitableInitiative) {

                        $planAccomplishments =  $em->getRepository(PlanningAccomplishment::class)->findByQuarter($suitableInitiative, $quarter);
                        if ($planAccomplishments) {
                            $totalPlan =  $totalPlan + self::planSum($planAccomplishments);
                            $totalAccomp =  $totalAccomp + self::totalAccomplishment($planAccomplishments);
                        }
                    }
                    if ($totalPlan != 0) {
                        $netTotal = ceil(($totalAccomp / $totalPlan) * $initiativeWeight);

                        $quarterAchievement->setAchievementValue($netTotal);
                    }

                    if (!$isexist)
                        $em->persist($quarterAchievement);

                    $em->flush();
                }
            }
        }
        return true;
    }
    private static  function planSum($planAccomplishments)
    {
        return array_reduce($planAccomplishments, function ($sum, $planAccomplishment) {
            return $sum + $planAccomplishment->getPlanValue();
        });
    }
    private  static function totalAccomplishment($planAccomplishments)
    {
        return array_reduce($planAccomplishments, function ($sum, $planAccomplishment) {
            return $sum + $planAccomplishment->getAccompValue();
        });
    }
    public static function kpiSync(EntityManagerInterface $em)
    {
        // self::sync($em);
       
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $quarters =  $em->getRepository(PlanningQuarter::class)->findAll();
        $kpis = $em->getRepository(KeyPerformanceIndicator::class)->findAll();
       $quarterSize=count($quarters);
        foreach ($kpis as $kpi) {
            $initiatives = $kpi->getInitiatives();
            $kpiWieght = $kpi->getWeight();

            foreach ($planningYears as  $planningYear) {
                $exist = true;

                $kpiAch = $em->getRepository(PlanAchievement::class)->findByKpi($kpi, $planningYear);
                if (!$kpiAch) {
                    $kpiAch = new PlanAchievement();
                    $kpiAch->setYear($planningYear);
                    $kpiAch->setKpi($kpi);
                    $exist = false;
                    $em->persist($kpiAch);
                }
                foreach ($quarters as $quarter) {
                    $totalAccomp = 0;
                    $totalPlan = 0;
                    foreach ($initiatives as $initiative) {
                        $initAchievement = $em->getRepository(PlanAchievement::class)->findByInitiative($initiative, $planningYear);
                        $quarterAchievement = $em->getRepository(QuarterAccomplishment::class)->findByAchievement($initAchievement, $quarter);
                        if ($quarterAchievement) {
                            $totalAccomp = $totalAccomp + $quarterAchievement->getAchievementValue();
                        }
                        $totalPlan = $totalPlan + $initiative->getWeight();
                    }
                    $netAccomp = round(($totalAccomp / $totalPlan) * $kpiWieght,2);
                    if (!$exist) {
                        $kpiQuarterAch = new QuarterAccomplishment();
                        $kpiQuarterAch->setQuarter($quarter);
                        $kpiQuarterAch->setYearPlan($kpiAch);
                        $kpiQuarterAch->setAchievementValue($netAccomp);
                        $em->persist($kpiQuarterAch);
                    } else {
                        $kpiQuarterAch = $em->getRepository(QuarterAccomplishment::class)->findByAchievement($kpiAch, $quarter);
                        $isNotexist = true;
                        if (!$kpiQuarterAch) {
                            $kpiQuarterAch = new QuarterAccomplishment();
                            $kpiQuarterAch->setQuarter($quarter);
                            $kpiQuarterAch->setYearPlan($kpiAch);
                            $isNotexist = false;
                        }
                        $kpiQuarterAch->setAchievementValue($netAccomp);
                        if (!$isNotexist) {
                            $em->persist($kpiQuarterAch);
                        }
                    }
                    $em->flush();
                }
                
            }
        }
         self::calculateYearly($em);
        return true;
    }

    public static function calculateYearly($em){
         $planningYears = $em->getRepository(PlanningYear::class)->findAll();
         $quarters =  $em->getRepository(PlanningQuarter::class)->findAll();
         $kpis = $em->getRepository(KeyPerformanceIndicator::class)->findAll();
         $quarterSize=count($quarters);

         foreach ($kpis as $kpi) {
            foreach ($planningYears as $planningYear) {
                 $kpiAch = $em->getRepository(PlanAchievement::class)->findByKpi($kpi, $planningYear);
                 $quarterSum = $em->getRepository(PlanAchievement::class)->findKpiSum($kpi, $planningYear);
                 $quarterAverage= round($quarterSum/$quarterSize,2);
                 if($quarterAverage!=$kpiAch->getAccomplishmentValue()){
                   $kpiAch->setAccomplishmentValue($quarterAverage);
                   $em->flush();
                 }
                
               

              
            }
         }
    
        

    }
     public static function objectiveSync($em){
         self::kpiSync($em);
         $objectives=$em->getRepository(Objective::class)->findAll();
         $planningYears = $em->getRepository(PlanningYear::class)->findAll();
         $quarters =  $em->getRepository(PlanningQuarter::class)->findAll();
         foreach ($objectives as $objective) {
             $objWieght=$objective->getWeight();
             
            foreach ($planningYears as $planningYear) {
                $totalPlan=$em->getRepository(PlanAchievement::class)->getObjkpiWieghtSum($objective, $planningYear);
                $objectiveAchiev=$em->getRepository(PlanAchievement::class)->findByObj($objective,$planningYear);
                $isexist=true;
               if(!$objectiveAchiev){
                 $isexist=false;
                 $objectiveAchiev=new PlanAchievement();
                 $objectiveAchiev->setObjective($objective);
                 $objectiveAchiev->setYear($planningYear);

                  }
                foreach($quarters as $quarter){
                    $exist=true;
                    if(!$isexist){
                         $objQuarterAch=new QuarterAccomplishment();
                         $objQuarterAch->setQuarter($quarter);
                         $objQuarterAch->setYearPlan( $objectiveAchiev);

                         $exist=false;
                    }
                    else{
                    $objQuarterAch = $em->getRepository(QuarterAccomplishment::class)->findByAchievement($objectiveAchiev, $quarter);
                    if(!$objQuarterAch){
                         $objQuarterAch=new QuarterAccomplishment();
                         $objQuarterAch->setQuarter($quarter);
                         $objQuarterAch->setYearPlan( $objectiveAchiev);
                         $exist=false;
                    }
                    }
                    
                     $quarterTotal =   $em->getRepository(QuarterAccomplishment::class)->getSumByObjkpi($objective, $planningYear,$quarter);
                     $net=round($quarterTotal/ $totalPlan,2)*$objWieght;

                      $objQuarterAch->setAchievementValue($net);
                      if(!$exist){
                          $em->persist($objQuarterAch);
                      }
                }
                
               if(!$isexist){
                          $em->persist($objectiveAchiev);
                      }
                      $em->flush();
               
            }
         }

       return true; 
    }
    public static function goalSync($em){
         $goals=$em->getRepository(Goal::class)->findAll();
         $planningYears = $em->getRepository(PlanningYear::class)->findAll();
         $quarters =  $em->getRepository(PlanningQuarter::class)->findAll();
         foreach ($goals as $goal) {
         foreach ($planningYears as $planningYear) {
            $totalPlan=$em->getRepository(PlanAchievement::class)->getGoalObjWieghtSum($goal, $planningYear);
            $goalAchiev=$em->getRepository(PlanAchievement::class)->findByGoal($goal,$planningYear);
            $isexist=true;
               if(!$goalAchiev){
                 $isexist=false;
                 $goalAchiev=new PlanAchievement();
                 $goalAchiev->setGoal($goal);
                 $goalAchiev->setYear($planningYear);

                  }
            foreach($quarters as $quarter){
            $exist=true;
            if(!$isexist){
                $goalQuarterAch=new QuarterAccomplishment();
                $goalQuarterAch->setQuarter($quarter);
                $goalQuarterAch->setYearPlan($goalAchiev);
                $exist=false;
                    }
                    else{
                     $goalQuarterAch = $em->getRepository(QuarterAccomplishment::class)->findByAchievement($goalAchiev, $quarter);
                    if(! $goalQuarterAch){
                          $goalQuarterAch=new QuarterAccomplishment();
                          $goalQuarterAch->setQuarter($quarter);
                          $goalQuarterAch->setYearPlan( $goalAchiev);
                          $exist=false;
                    }
                    }
                    
                     $quarterTotal = $em->getRepository(QuarterAccomplishment::class)->getSumOfObjGoal($goal, $planningYear,$quarter);
                     $net=round($quarterTotal/ $totalPlan,2);

                       $goalQuarterAch->setAchievementValue($net);
                      if(!$exist){
                          $em->persist( $goalQuarterAch);
                      }
                }
                
               if(!$isexist){
                          $em->persist($goalAchiev);
                      }
                      $em->flush();
               
            }
           
        }
    } 
}
