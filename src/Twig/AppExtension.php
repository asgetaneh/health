<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Facade\General;
use App\Entity\SuitableInitiative;




class AppExtension extends AbstractExtension
{

    private $entityManager;
    private $urlGeneratorInterface;
    private $templating;

    public function __construct(EntityManagerInterface $em, UrlGeneratorInterface $urlGeneratorInterface, \Twig\Environment $templating)
    {

        $this->entityManager = $em;
        $this->urlGeneratorInterface = $urlGeneratorInterface;
        $this->templating = $templating;
    }


    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [$this, 'doSomething']),
            new TwigFilter('cast_to_array', [$this, 'objectFilter']),

        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getTaskStatus', [$this, 'getTaskStatus']),
            new TwigFunction('getTaskStatusAssigned', [$this, 'getTaskStatusAssigned']),
            new TwigFunction('getTaskStatusSend', [$this, 'getTaskStatusSend']),
            new TwigFunction('getYearlyPlan', [$this, 'getYearlyPlan']),




        ];
    }



    function getTaskStatus($id, $office)
    {

        $req = General::getTaskStatus($this->entityManager, $id, $office);
        return ($req);
    }
    function getTaskStatusAssigned($id, $office)
    {

        $req = General::getTaskStatusAssigned($this->entityManager, $id, $office);
        return ($req);
    }
    function getTaskStatusSend($id, $office)
    {

        $req = General::getTaskStatusSend($this->entityManager, $id, $office);
        return ($req);
    }
    public  function getYearlyPlan($suitable)
    {


        $yearlplan = 0;
        if (count($suitable->getPlanningAccomplishments()) > 0) {

            if ($suitable->getInitiative()->getInitiativeBehaviour()->getCode() == 0) {

                $yearlplan = $suitable->getPlanningAccomplishments()[0]->getPlanValue();
                return $yearlplan;
            } elseif ($suitable->getInitiative()->getInitiativeBehaviour()->getCode() == 1) {

                $yearlplan = array_sum($this->getPlanArray($suitable->getPlanningAccomplishments()));
                return $yearlplan;
            } elseif ($suitable->getInitiative()->getInitiativeBehaviour()->getCode() == 2) {
                $array = $this->getPlanArray($suitable->getPlanningAccomplishments());
                rsort($array);

                return  $array[0];
            } else {
                $array = $this->getPlanArray($suitable->getPlanningAccomplishments());
                sort($array);

                return  $array[0];
            }
            return $yearlplan;
        } else return "-";
    }

    private  function getPlanArray($plans)
    {
        $plansArray = array();
        foreach ($plans as $key => $plan) {
            array_push($plansArray, $plan->getPlanValue());
        }
        return $plansArray;
    }
}
