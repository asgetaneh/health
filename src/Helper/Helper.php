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
use App\Entity\Objective;
use App\Entity\ObjectiveAchievement;
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

class Helper

{
    private  EntityManagerInterface $em;

    public static function locales()
    {
        return ["English" => 'en', "Afaan Oromo" => 'or', "Amharic" => 'am'];
        //"Tigr"=>$pr->getManagedBy()->getManagedBy()'tg'
    }
    public static function calculatePrincipalOfficePlan(EntityManagerInterface $em, $planInitiative)
    {
        $suitableoperationals = $em->getRepository(SuitableOperational::class)->findBy(['suitableInitiative' => $planInitiative]);
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $suitableInitiative = $em->getRepository(SuitableInitiative::class)->find($planInitiative->getId());
        $plans = $em->getRepository(OperationalPlanningAccomplishment::class)->calculateQuartertPlan($planInitiative);
        foreach ($quarters as $key => $quarter) {
            $planAcomplishment = $em->getRepository(PlanningAccomplishment::class)->findDuplication($planInitiative, null, $quarter);
            $isexist = true;
            if (!$planAcomplishment) {
                $planAcomplishment = new PlanningAccomplishment();
                $planAcomplishment->setQuarter($quarter);
                $planAcomplishment->setSuitableInitiative($suitableInitiative);
                $isexist = false;
            }
            $planAcomplishment->setPlanValue($plans[$key][1]);
            if (!$isexist)
                $em->persist($planAcomplishment);
            $em->flush();
        }
        $em->flush();
        $em->clear();
        KpiHelper::setOfficeKpiPlan($em, $suitableInitiative);

        return true;
    }
    public static function calculateInitiativePlan(EntityManagerInterface $em, $suitableInitiative)
    {
        // dd(1);
        $em->clear();
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $initiative = $em->getRepository(Initiative::class)->find($suitableInitiative->getInitiative()->getId());
        $initiativeAchievement = $em->getRepository(InitiativeAchievement::class)->getByInitiativeAndYear($initiative, $year);
        $isinitiativeAchievement = true;
        if (!$initiativeAchievement) {

            $initiativeAchievement = new InitiativeAchievement();
            $initiativeAchievement->setYear($year);
            $initiativeAchievement->setInitiative($initiative);
            $em->persist($initiativeAchievement);

            $isinitiativeAchievement = false;
        }
      
        foreach ($quarters as  $quarter) {

            $plan = $em->getRepository(PlanningAccomplishment::class)->calulateSumByInitiativeAndYear($suitableInitiative->getInitiative(), $suitableInitiative->getPlanningYear(), $quarter);
            $quarterPlanAchievement = null;
            // dd($plan);
            if ($isinitiativeAchievement)
                $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->findByInitiativeAchievementAndQuarter($initiativeAchievement, $quarter);
            $isexist = true;
            if (!$quarterPlanAchievement) {
                $quarterPlanAchievement = new QuarterPlanAchievement();
                $quarterPlanAchievement->setQuarter($quarter);
                $quarterPlanAchievement->setInitiativeAchievement($initiativeAchievement);
                $isexist = false;
            }
            if ($plan) {
                # code...
                $quarterPlanAchievement->setPlan($plan);
            }
            if (!$isexist) {
                $em->persist($quarterPlanAchievement);
            }
        }
        
        //     $em->persist($initiativeAchievement);

        $em->flush();
        $em->clear();
        // self::calculateKpiPlan($em, $suitableInitiative);
        // self::setObjectivePlan($em, $suitableInitiative);
        // self::setGoalPlan($em, $suitableInitiative);


        return;
    }
    public static function calculateKpiPlan(EntityManagerInterface $em, $suitableInitiative)
    {

        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $kpi = $em->getRepository(KeyPerformanceIndicator::class)->find($suitableInitiative->getInitiative()->getKeyPerformanceIndicator()->getId());
        $kpiAchievement = $em->getRepository(KpiAchievement::class)->getByKpiAndYear($kpi, $year);
        $iskpiAchievement = true;
        if (!$kpiAchievement) {

            $kpiAchievement = new KPiAchievement();
            $kpiAchievement->setYear($year);
            $kpiAchievement->setKpi($kpi);
            $iskpiAchievement = false;
        }
        foreach ($quarters as  $quarter) {

            $plan = $em->getRepository(QuarterPlanAchievement::class)->getSumByKpiAndYear($kpi, $year, $quarter);
            $quarterPlanAchievement = null;
            if ($iskpiAchievement)
                $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->getByKpiAchievementAndQuarter($kpiAchievement, $quarter);
            $isexist = true;
            if (!$quarterPlanAchievement) {
                $quarterPlanAchievement = new QuarterPlanAchievement();
                $quarterPlanAchievement->setQuarter($quarter);
                $quarterPlanAchievement->setKPiAchievement($kpiAchievement);
                $isexist = false;
            }
            if ($plan) {
                $quarterPlanAchievement->setPlan($plan);
            }

            if (!$isexist) {
                $kpiAchievement->addQuarterAchievement($quarterPlanAchievement);
                $em->persist($quarterPlanAchievement);
            }
        }
        if (!$iskpiAchievement)
            $em->persist($kpiAchievement);
        $em->flush();
        return;
    }
    public static function setObjectivePlan(EntityManagerInterface $em, $suitableInitiative)
    {

        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $kpi = $em->getRepository(KeyPerformanceIndicator::class)->find($suitableInitiative->getInitiative()->getKeyPerformanceIndicator()->getId());

        $objective = $em->getRepository(Objective::class)->find($kpi->getStrategy()->getObjective()->getId());
        $objectiveAchievement = $em->getRepository(ObjectiveAchievement::class)->getByObjectiveAndYear($objective, $year);
        $isObjective = true;
        if (!$objectiveAchievement) {

            $objectiveAchievement = new ObjectiveAchievement();
            $objectiveAchievement->setYear($year);
            $objectiveAchievement->setObjective($objective);
            // $em->persist($objectiveAchievement);

            $isObjective = false;
        }
        //  $em->flush();
        foreach ($quarters as  $quarter) {

            $plan = $em->getRepository(QuarterPlanAchievement::class)->getSumByObjectiveAndYear($objective, $year, $quarter);
            $quarterPlanAchievement = null;
            if ($isObjective)
                $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->getByObjectiveAchievementAndQuarter($objectiveAchievement, $quarter);
            $isexist = true;
            if (!$quarterPlanAchievement) {
                $quarterPlanAchievement = new QuarterPlanAchievement();
                $quarterPlanAchievement->setQuarter($quarter);
                $quarterPlanAchievement->setObjectiveAchievement($objectiveAchievement);
                $isexist = false;
            }
            if ($plan) {
                # code...

                $quarterPlanAchievement->setPlan($plan);
            }

            if (!$isexist) {
                $objectiveAchievement->addQuarterAchievement($quarterPlanAchievement);
                $em->persist($quarterPlanAchievement);
            }
        }
        if (!$isObjective)
            $em->persist($objectiveAchievement);


        $em->flush();

        return;
    }
    public static function setGoalPlan(EntityManagerInterface $em, $suitableInitiative)
    {

        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $kpi = $em->getRepository(KeyPerformanceIndicator::class)->find($suitableInitiative->getInitiative()->getKeyPerformanceIndicator()->getId());

        $objective = $em->getRepository(Objective::class)->find($kpi->getStrategy()->getObjective()->getId());
        $goal = $em->getRepository(Goal::class)->find($objective->getGoal()->getId());
        $goalAchievement = $em->getRepository(GoalAchievement::class)->getByGoalAndYear($goal, $year);
        $isGoal = true;
        if (!$goalAchievement) {

            $goalAchievement = new GoalAchievement();
            $goalAchievement->setYear($year);
            $goalAchievement->setGoal($goal);
            // $em->persist($goalAchievement);

            $isGoal = false;
        }
        //  $em->flush();
        foreach ($quarters as  $quarter) {

            $plan = $em->getRepository(QuarterPlanAchievement::class)->getSumByGoalAndYear($goal, $year, $quarter);
            $quarterPlanAchievement = null;
            if ($isGoal)
                $quarterPlanAchievement = $em->getRepository(QuarterPlanAchievement::class)->getByGoalAchievementAndQuarter($goalAchievement, $quarter);
            $isexist = true;
            if (!$quarterPlanAchievement) {
                $quarterPlanAchievement = new QuarterPlanAchievement();
                $quarterPlanAchievement->setQuarter($quarter);
                $quarterPlanAchievement->setGoalAchievement($goalAchievement);
                $isexist = false;
            }
            if ($plan) {
                # code...

                $quarterPlanAchievement->setPlan($plan);
            }

            if (!$isexist) {
                $goalAchievement->addQuarterAchievement($quarterPlanAchievement);
                $em->persist($quarterPlanAchievement);
            }
        }
        if (!$isGoal)
            $em->persist($goalAchievement);


        $em->flush();

        return;
    }


    public static function setOrganizationalInitiativePlan(EntityManagerInterface $em, $suitableInitiative, $organization)
    {

        $em->clear();
        $organization = $em->getRepository(PrincipalOfficeGroup::class)->find($organization->getId());
        $suitableInitiative = $em->getRepository(SuitableInitiative::class)->find($suitableInitiative->getId());
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $year = $em->getRepository(PlanningYear::class)->find($suitableInitiative->getPlanningYear()->getId());
        $initiative = $em->getRepository(Initiative::class)->find($suitableInitiative->getInitiative()->getId());
        $organizationSuitable = $em->getRepository(InistuitionSuitableInitiative::class)->getByInitiativeAndYear($initiative, $year, $organization);
        $isinitiativeAchievement = true;
        if (!$organizationSuitable) {

            $organizationSuitable = new InistuitionSuitableInitiative();
            $organizationSuitable->setYear($year);
            $organizationSuitable->setInitiative($initiative);
            $organizationSuitable->setInistuition($organization);

            $em->persist($organizationSuitable);

            $isinitiativeAchievement = false;
        }
        $organizationSuitable->addPrincipalSuitableInitiative($suitableInitiative);

        foreach ($quarters as  $quarter) {
            if (count($initiative->getSocialAtrribute()) > 0) {
                foreach ($initiative->getSocialAtrribute() as $attrib) {




                    $plan = $em->getRepository(PlanningAccomplishment::class)->calulateSumByInitiativeAndYear($suitableInitiative->getInitiative(), $suitableInitiative->getPlanningYear(), $quarter, $organization, $attrib);
                    $instuitionPlan = null;
                    if ($isinitiativeAchievement)
                        $instuitionPlan = $em->getRepository(InistuitionPlan::class)->getByOrganizationSuitableAndQuarter($organizationSuitable, $quarter, $attrib);
                    $isexist = true;
                    if (!$instuitionPlan) {
                        $instuitionPlan = new InistuitionPlan();
                        $instuitionPlan->setQuarter($quarter);
                        $instuitionPlan->setInstuitionSuitable($organizationSuitable);
                        $instuitionPlan->setSocialAttribute($attrib);
                        $isexist = false;
                    }
                    $instuitionPlan->setPlan($plan);


                    if (!$isexist) {
                        //$organizationSuitable->addQuarterAchievement($instuitionPlan);
                        $em->persist($instuitionPlan);
                        $em->flush();
                    }
                }
            } else {



                $plan = $em->getRepository(PlanningAccomplishment::class)->calulateSumByInitiativeAndYear($suitableInitiative->getInitiative(), $suitableInitiative->getPlanningYear(), $quarter, $organization, null);
                $instuitionPlan = null;
                if ($isinitiativeAchievement)
                    $instuitionPlan = $em->getRepository(InistuitionPlan::class)->getByOrganizationSuitableAndQuarter($organizationSuitable, $quarter);
                $isexist = true;
                if (!$instuitionPlan) {
                    $instuitionPlan = new InistuitionPlan();
                    $instuitionPlan->setQuarter($quarter);
                    $instuitionPlan->setInstuitionSuitable($organizationSuitable);
                    $isexist = false;
                }
                $instuitionPlan->setPlan($plan);


                if (!$isexist) {
                    //$organizationSuitable->addQuarterAchievement($instuitionPlan);
                    $em->persist($instuitionPlan);
                    $em->flush();
                }
            }
        }



        $em->flush();
        $em->clear();



        return;
    }



    public static function getParentOffice($principalOffice, EntityManagerInterface  $em)
    {
        $principalOffice = $em->getRepository(PrincipalOffice::class)->find($principalOffice);
        // if(
        $parent = $principalOffice->getManagedBy();

        if (!$parent)
            return $principalOffice;
        // while ($parent->getManagedBy()) {

        //     $parent = $parent->getManagedBy();
        // }


        // return $parent;
    }
}
