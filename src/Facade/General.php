<?php

namespace App\Facade;

use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\SuitableOperational;
use DateTime;
use Doctrine\ORM\EntityManager;
use App\Entity\PerformerTask;
use App\Entity\SuitableInitiative;
use App\Entity\TaskAssign;

class General
{

   

  
    public static function getTaskStatus(EntityManager $entityManager,$id,$office)
    {

        # code...
    $count= $entityManager->getRepository(PerformerTask::class)->getTaskStatus($id,$office);
    //  dd($count);
        return $count;
    }

     public static function getTaskStatusAssigned(EntityManager $entityManager,$id,$office)
    {

        # code...
    $count= $entityManager->getRepository(TaskAssign::class)->getTaskStatusAssigned($id,$office);
    //  dd($count);
        return $count;
    }
     public static function getTaskStatusSend(EntityManager $entityManager,$id,$office)
    {

        # code...
    $count= $entityManager->getRepository(PerformerTask::class)->getTaskStatusSend($id,$office);
    //  dd($count);
        return $count;
    }
     public static function getTaskList(EntityManager $entityManager,$office)
    {

        # code...
    $count= $entityManager->getRepository(TaskAssign::class)->getTaskList($office);
    //  dd($count);
        return $count;
    }
      public static function getPrincipalSelectSuitable(EntityManager $entityManager,$principalOffice)
    {
    $count= $entityManager->getRepository(SuitableInitiative::class)->getPrincipalSelectSuitable($principalOffice);
        return $count;
    }
     public static function getOperationalCascading(EntityManager $entityManager,$principalOffice)
    {

    $count= $entityManager->getRepository(OperationalPlanningAccomplishment::class)->getOperationalCascading($principalOffice);
    //  dd($count);
        return $count;
    }
      public static function getPlanningApproved(EntityManager $entityManager,$principalOffice)
    {

    $count= $entityManager->getRepository(SuitableOperational::class)->getPlanningApproved($principalOffice);
    //  dd($count);
        return $count;
    }
    
    
    
    
}
