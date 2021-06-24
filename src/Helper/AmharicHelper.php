<?php
namespace App\Helper;
use DateTime;
use Andegna\DateTime as AD;
class AmharicHelper 
{
    public static function fromGretoEthstr($gregorian)
    {
        $ethipic = new AD($gregorian);
        return $ethipic->format('F j Y');
    }
    public static function fromGretoEthstrint($gregorian)
    {
        # code..
        $ethipic = new AD($gregorian);
        return $ethipic->format('F j');
    }
      public static function fromEthtoGre($ethipic)
    {
        # code..

        return $ethipic->toGregorian();
    }
     public static function getCurrentYear()
    {
        $gregorian=new DateTime();
        $ethipic = new AD($gregorian);
        // dump($gregorian);
        return $ethipic->format('Y');
    }
}