<?php

namespace App\Facade;

use DateTime;
use Doctrine\ORM\EntityManager;
use App\Entity\PerformerTask;
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
    
    
}
