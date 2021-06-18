<?php

namespace App\Helper;

use App\Entity\Initiative;
use App\Entity\KeyPerformanceIndicator;
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

    public static function sync(EntityManagerInterface $em
       
    ) {
         $initiatives = $em->getRepository(Initiative::class)->findAll();
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $quarters =  $em->getRepository(PlanningQuarter::class)->findAll();

        foreach ($initiatives as $initiative) {
            $initiativeWeight=$initiative->getWeight();
            foreach ($planningYears as $planningYear) {
                $suitableInitiatives =  $em->getRepository(SuitableInitiative::class)->findByYear($initiative, $planningYear);
                $totalOffice = count($suitableInitiatives);
               
                $planAchievement= $em->getRepository(PlanAchievement::class)->findByInitiative($initiative,$planningYear);
                $isNotexist=false;
                if(!$planAchievement){
                 $planAchievement = new PlanAchievement();
                 $planAchievement->setInitiative($initiative);
                 $planAchievement->setYear($planningYear);
                 $isNotexist=true;
                 $em->persist($planAchievement);

                }

                 foreach ($quarters as  $quarter) {
                $totalPlan=0;
                $totalAccomp=0;
                if(!$isNotexist)
                $quarterAchievement= $em->getRepository(QuarterAccomplishment::class)->findByAchievement($planAchievement,$quarter);
                $isexist=true;
               
                if(!isset($quarterAchievement)){
                    
                      $quarterAchievement=new QuarterAccomplishment();
                      $quarterAchievement->setQuarter($quarter);
                      $quarterAchievement->setYearPlan($planAchievement);
                       
                      $isexist=false;
                 
                }

                foreach ($suitableInitiatives as $suitableInitiative) {
                  
                        $planAccomplishments =  $em->getRepository(PlanningAccomplishment::class)->findByQuarter($suitableInitiative, $quarter);
                        $totalPlan =  $totalPlan + self::planSum($planAccomplishments);
                        $totalAccomp =  $totalAccomp + self::totalAccomplishment($planAccomplishments);
                       
                   
                   
                    }
                   if($totalPlan!=0){
                $netTotal=ceil(($totalAccomp/$totalPlan)*$initiativeWeight);
              
                 $quarterAchievement->setAchievementValue($netTotal);
                   }
               
                if(!$isexist)
                $em->persist($quarterAchievement);
                
                $em->flush();
                }
                
            }
        }
        return true;
    }
     private static  function planSum($planAccomplishments){
        return array_reduce($planAccomplishments,function($sum,$planAccomplishment){
          return $sum + $planAccomplishment->getPlanValue();
        });

    }
   private  static function totalAccomplishment($planAccomplishments){
        return array_reduce($planAccomplishments,function($sum,$planAccomplishment){
          return $sum + $planAccomplishment->getAccompValue();
        });

    }
    public static function kpiSync(EntityManagerInterface $em){
        // self::sync($em);
        $planningYears = $em->getRepository(PlanningYear::class)->findAll();
        $quarters =  $em->getRepository(PlanningQuarter::class)->findAll();
        $kpis=$em->getRepository(KeyPerformanceIndicator::class)->findAll();
        // $initiativeAchiev=$em->getRepository(PlanAchievement::)
        foreach ($kpis as $kpi) {
            $initiatives=$kpi->getInitiatives();
            $kpiWieght=$kpi->getWeight();
            
            foreach($planningYears as  $planningYear){
               $exist=true;
               

            $kpiAch=$em->getRepository(PlanAchievement::class)->findByKpi($kpi, $planningYear);
               if(!$kpiAch){
                   $kpiAch=new PlanAchievement();
                   $kpiAch->setYear($planningYear);
                   $kpiAch->setKpi($kpi);
                   $exist=false;
                   $em->persist($kpiAch);
               }
            foreach ($quarters as $quarter) {
            $totalAccomp=0;
            $totalPlan=0;
            foreach ($initiatives as $initiative) {
           $initAchievement =$em->getRepository(PlanAchievement::class)->findByInitiative($initiative,$planningYear);
           $quarterAchievement=$em->getRepository(QuarterAccomplishment::class)->findByAchievement($initAchievement,$quarter);
           if(!$quarterAchievement) {
               continue;
           }
           $totalAccomp= $totalAccomp+$quarterAchievement->getAchievementValue();
           $totalPlan=$totalPlan+$initiative->getWeight();
           
           
             
           }
           $netAccomp=($totalAccomp/$totalPlan)*$kpiWieght;
           if(!$exist){
            $kpiQuarterAch=new QuarterAccomplishment(); 
             $kpiQuarterAch->setQuarter($quarter);
              $kpiQuarterAch->setYearPlan($kpiAch);
              $kpiQuarterAch->setAchievementValue($netAccomp);
              $em->persist($kpiQuarterAch);
              
           }
           else{
            $kpiQuarterAch=$em->getRepository(QuarterAccomplishment::class)->findByAchievement($kpiAch,$quarter);
            $isNotexist=true;
            if(!$kpiQuarterAch){
              $kpiQuarterAch=new QuarterAccomplishment(); 
              $kpiQuarterAch->setQuarter($quarter);
              $kpiQuarterAch->setYearPlan($kpiAch);
              $isNotexist=false;
            }
             $kpiQuarterAch->setAchievementValue($netAccomp);
            if(!$isNotexist){
              $em->persist($kpiQuarterAch);
            }


           }
           $em->flush();

              
            }
            }
           
        }
 return true;

    }

}
