<?php

namespace App\Twig;

use App\Entity\PlanningAccomplishment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

use App\Facade\General;
use App\Entity\SuitableInitiative;
use App\Entity\OperationalPlanningAccomplishment;
use App\Entity\PlanningYear;
use App\Entity\QuarterPlanAchievement;

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
            new TwigFunction('getPrincipalSelectSuitable', [$this, 'getPrincipalSelectSuitable']),
            new TwigFunction('getOperationalCascading', [$this, 'getOperationalCascading']),
            new TwigFunction('getPlanningApproved', [$this, 'getPlanningApproved']),
            new TwigFunction('getTaskStatus', [$this, 'getTaskStatus']),
            new TwigFunction('getTaskList', [$this, 'getTaskList']),
            new TwigFunction('getProgress', [$this, 'getProgress']),
            new TwigFunction('getTaskStatusAssigned', [$this, 'getTaskStatusAssigned']),
            new TwigFunction('getTaskStatusSend', [$this, 'getTaskStatusSend']),
            new TwigFunction('getYearlyPlan', [$this, 'getYearlyPlan']),
            new TwigFunction('getYearlyPlanAccomp', [$this, 'getYearlyPlanAccomp']),
            new TwigFunction('getQuarterPlan', [$this, 'getQuarterPlan']),
            new TwigFunction('getQuarterPlanAccomp', [$this, 'getQuarterPlanAccomp']),
            new TwigFunction('getOperationalYearlyPlan', [$this, 'getOperationalYearlyPlan']),
            new TwigFunction('getOperationalYearlyPlanAccomp', [$this, 'getOperationalYearlyPlanAccomp']),
            new TwigFunction('getOperationalQuarterPlan', [$this, 'getOperationalQuarterPlan']),
            new TwigFunction('getOperationalQuarterPlanAccomp', [$this, 'getOperationalQuarterPlanAccomp']),




        ];
    }

    function getPrincipalSelectSuitable($principalOffice)
    {

        $req = General::getPrincipalSelectSuitable($this->entityManager, $principalOffice);
        return ($req);
    }
    function getOperationalCascading($principalOffice)
    {

        $req = General::getOperationalCascading($this->entityManager, $principalOffice);
        return ($req);
    }
    function getPlanningApproved($principalOffice)
    {

        $req = General::getPlanningApproved($this->entityManager, $principalOffice);
        return ($req);
    }


    function getTaskStatus($id, $office,$quarter)
    {

        $req = General::getTaskStatus($this->entityManager, $id, $office,$quarter);
        return ($req);
    }
    function getTaskStatusAssigned($id, $office,$quarter)
    {

        $req = General::getTaskStatusAssigned($this->entityManager, $id, $office,$quarter);
        return ($req);
    }
    function getTaskStatusSend($id, $office,$quarter)
    {

        $req = General::getTaskStatusSend($this->entityManager, $id, $office,$quarter);
        return ($req);
    }
    function getTaskList($office)
    {
        // dd(1);
        $req = General::getTaskList($this->entityManager, $office);
        return ($req);
    }
    function getProgress($initiative, $yearId)
    {
        $previous_year = $this->getYearId($yearId);
        $year = $this->entityManager->getRepository(PlanningYear::class)->find($yearId);
        if (!$previous_year)
            return "no plan in previous year";
        $current_plan = $this->entityManager->getRepository(QuarterPlanAchievement::class)->getYearlyPlanByInitiative($initiative, $year);
        $current_accomp = $this->entityManager->getRepository(QuarterPlanAchievement::class)->getYearlyPlanAccompByInitiative($initiative, $year);
        $previous_accomp = $this->entityManager->getRepository(QuarterPlanAchievement::class)->getYearlyPlanAccompByInitiative($initiative, $previous_year);
        if ($current_plan == 0 && $previous_accomp == 0)
            return "not planed";
        $progress = (($current_accomp - $previous_accomp) / ($current_plan - $previous_accomp)) * 100;
        return $progress;
    }
    function getYearId($id)
    {
        $years = $this->entityManager->getRepository(PlanningYear::class)->findAll();
        $ids = [];
        if (count($years) <= 1) {
            return null;
        }


        foreach ($years as $key => $year) {
            $ids[$key] = $year->getId();
        }
        $id_index = array_search($id, $ids);
        if ($id_index < 1)
            return null;
        $year = $this->entityManager->getRepository(PlanningYear::class)->find($ids[$id_index - 1]);

        return $year;
    }
    public  function getQuarterPlanAccomp($suitable, $quarter)
    {
        if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {
            $plan = [];
            foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                $plan[$social->getName()] = $this->entityManager->getRepository(PlanningAccomplishment::class)->findQuarterPlanAccomp($suitable, $social, $suitable->getInitiative()->getInitiativeBehaviour()->getCode());
            }

            $plans =   implode(" ", array_map(function ($key, $val) {
                if (!$val)
                    $val = "__";
                return substr(strtoupper($key), 0, 1) . ":" . $val;
            }, array_keys($plan), $plan));


            return $plans ? $plans : '_';
        } else
            $plan = $this->entityManager->getRepository(PlanningAccomplishment::class)->findQuarterPlanAccomp($suitable, null, $quarter);
        // dd($plan);

        return $plan ? $plan : '_';
    }
    public  function getQuarterPlan($suitable, $quarter)
    {
        if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {

            $plan = [];
            foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                $plan[$social->getName()] = $this->entityManager->getRepository(PlanningAccomplishment::class)->findQuarterPlan($suitable, $social, $quarter);
            }
            $plans =   implode(" ", array_map(function ($key, $val) {

                if (!$val)
                    $val = "__";

                return substr(strtoupper($key), 0, 1) . ":" . $val;
            }, array_keys($plan), $plan));


            return $plans ? $plans : '_';
        } else

            $plan = $this->entityManager->getRepository(PlanningAccomplishment::class)->findQuarterPlan($suitable, null, $quarter);


        return $plan ? $plan : '_';
    }
    public  function getYearlyPlanAccomp($suitable)
    {
        if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {
            $plan = [];
            foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                $plan[$social->getName()] = $this->entityManager->getRepository(PlanningAccomplishment::class)->findYearlyPlanAccomp($suitable, $social, $suitable->getInitiative()->getInitiativeBehaviour()->getCode());
            }
            $plans =   implode(" ", array_map(function ($key, $val) {

                if (!$val)
                    $val = "__";

                return substr(strtoupper($key), 0, 1) . ":" . $val;
            }, array_keys($plan), $plan));


            return $plans ? $plans : '_';
        } else
            $plan = $this->entityManager->getRepository(PlanningAccomplishment::class)->findYearlyPlanAccomp($suitable, null, $suitable->getInitiative()->getInitiativeBehaviour()->getCode());

        return $plan ? $plan : '_';
    }

    public  function getYearlyPlan($suitable)
    {


        $yearlplan = 0;
        if (count($suitable->getPlanningAccomplishments()) > 0) {

            if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {
                $plan = [];
                foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                    $plan[$social->getName()] = $this->entityManager->getRepository(PlanningAccomplishment::class)->findYearlyPlan($suitable, $social, $suitable->getInitiative()->getInitiativeBehaviour()->getCode());
                }
                $plans =   implode(" ", array_map(function ($key, $val) {

                    if (!$val)
                        $val = "__";

                    return substr(strtoupper($key), 0, 1) . ":" . $val;
                }, array_keys($plan), $plan));


                return $plans ? $plans : '_';
            } else {
                $plan = $this->entityManager->getRepository(PlanningAccomplishment::class)->findYearlyPlan($suitable, null, $suitable->getInitiative()->getInitiativeBehaviour()->getCode());
                return $plan;

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
            }
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

    function getOperationalYearlyPlan($suitable, $office)
    {

        $yearlplan = 0;
        if (count($suitable->getPlanningAccomplishments()) > 0) {

            if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {
                $plan = [];
                foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                    $plan[$social->getName()] = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findYearlyPlan($suitable, $social, $suitable->getInitiative()->getInitiativeBehaviour()->getCode(), $office);
                }
                $plans =   implode(" ", array_map(function ($key, $val) {

                    if (!$val)
                        $val = "__";

                    return substr(strtoupper($key), 0, 1) . ":" . $val;
                }, array_keys($plan), $plan));


                return $plans ? $plans : '_';
            } else
                $plan = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findYearlyPlan($suitable, null, $suitable->getInitiative()->getInitiativeBehaviour()->getCode(), $office);
            return $plan;
        } else return "-";
    }
    function getOperationalQuarterPlan($suitable,  $quarter, $office)
    {
        if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {

            $plan = [];
            foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                $plan[$social->getName()] = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findQuarterPlan($suitable, $social, $quarter, $office);
            }
            $plans =   implode(" ", array_map(function ($key, $val) {

                if (!$val)
                    $val = "__";

                return substr(strtoupper($key), 0, 1) . ":" . $val;
            }, array_keys($plan), $plan));


            return $plans ? $plans : '_';
        } else

            $plan = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findQuarterPlan($suitable, null, $quarter, $office);


        return $plan ? $plan : '_';
    }
    function getOperationalQuarterPlanAccomp($suitable, $office, $quarter)
    {
        if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {

            $plan = [];
            foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                $plan[$social->getName()] = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findQuarterPlanAccomp($suitable, $social, $quarter, $office);
            }
            $plans =   implode(" ", array_map(function ($key, $val) {

                if (!$val)
                    $val = "____";

                return substr(strtoupper($key), 0, 1) . ":" . $val;
            }, array_keys($plan), $plan));


            return $plans ? $plans : '_';
        } else

            $plan = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findQuarterPlanAccomp($suitable, null, $quarter, $office);


        return $plan ? $plan : '_';
    }
    function getOperationalYearlyPlanAccomp($suitable, $office)
    {
        $yearlplan = 0;
        if (count($suitable->getPlanningAccomplishments()) > 0) {

            if (count($suitable->getInitiative()->getSocialAtrribute()) > 0) {
                $plan = [];
                foreach ($suitable->getInitiative()->getSocialAtrribute() as $social) {
                    $plan[$social->getName()] = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findYearlyPlanAccomp($suitable, $social, $suitable->getInitiative()->getInitiativeBehaviour()->getCode(), $office);
                }
                $plans =   implode(" ", array_map(function ($key, $val) {

                    if (!$val)
                        $val = "____";

                    return substr(strtoupper($key), 0, 1) . ":" . $val;
                }, array_keys($plan), $plan));


                return $plans ? $plans : '_';
            } else
                $plan = $this->entityManager->getRepository(OperationalPlanningAccomplishment::class)->findYearlyPlanAccomp($suitable, null, $suitable->getInitiative()->getInitiativeBehaviour()->getCode(), $office);
            return $plan;
        } else return "-";
    }
}
