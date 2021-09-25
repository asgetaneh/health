<?php
namespace App\Helper;

use App\Entity\InitiativeAttribute;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\PlanningAccomplishment;
use App\Entity\PlanningQuarter;
use App\Entity\SuitableInitiative;
use App\Entity\SuitableOperational;
use Doctrine\ORM\EntityManagerInterface;

class Helper 
{
     public static function locales()
    {
        return ["English"=>'en',"Afaan Oromo"=>'or',"Amharic"=>'am'];
        //"Tigr"=>'tg'
    }
      public static function calculatePrincipalOfficePlan(EntityManagerInterface $em, $planInitiative)
    {


        // dd($planInitiative);
        $suitableoperationals = $em->getRepository(SuitableOperational::class)->findBy(['suitableInitiative' => $planInitiative]);
        $quarters = $em->getRepository(PlanningQuarter::class)->findAll();
        $suitableInitiative = $em->getRepository(SuitableInitiative::class)->find($planInitiative->getId());


        // if (count($planInitiative->getInitiative()->getSocialAtrribute()) > 0) {
        //     $socalAttributes = $em->getRepository(InitiativeAttribute::class)->findAll();
           
        //     foreach ($socalAttributes as $socalAttribute) {
        //         $plans = $em->getRepository(OperationalPlanningAccomplishment::class)->calculateSocialAttrQuartertPlan($planInitiative, $socalAttribute);
        //             //   if($socalAttribute->getId()==2)
        //             //    dd($plans);

        //         foreach ($quarters as $key => $quarter) {
        //             $planAcomplishment = $em->getRepository(PlanningAccomplishment::class)->findDuplication($planInitiative, $socalAttribute, $quarter);
        //             $isexist = true;
        //             if (!$planAcomplishment) {
        //                 $planAcomplishment = new PlanningAccomplishment();
        //                 $planAcomplishment->setQuarter($quarter);
        //                 $planAcomplishment->setSocialAttribute($socalAttribute);
        //                 $planAcomplishment->setSuitableInitiative($suitableInitiative);
        //                 $isexist = false;
        //             }
        //             $planAcomplishment->setPlanValue($plans[$key][1]);
        //             if (!$isexist)
        //                 $em->persist($planAcomplishment);


        //             $em->flush();
        //         }
            
        //     }
            
        // } else {

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
        
        return true;
    }
}