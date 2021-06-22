<?php
namespace App\Helper;
use DateTime;
use Andegna\DateTime as AD;
class AmharicHelper 
{
    public function fromGretoEthstr($gregorian)
    {
        $ethipic = new AD($gregorian);
        return $ethipic->format('F j Y');
    }
    public  function fromGretoEthstrint($gregorian)
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
}