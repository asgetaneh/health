<?php

namespace App\Entity;

use App\Repository\QuarterAccomplishmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuarterAccomplishmentRepository::class)
 */
class QuarterAccomplishment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="quarterAccomplishments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $quarter;

    /**
     * @ORM\Column(type="float",nullable=true)
     */
    private $achievementValue;

    

    

    /**
     * @ORM\ManyToOne(targetEntity=PlanAchievement::class, inversedBy="quarterAccomplishments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $yearPlan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $quarterPlan;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuarter(): ?PlanningQuarter
    {
        return $this->quarter;
    }

    public function setQuarter(?PlanningQuarter $quarter): self
    {
        $this->quarter = $quarter;

        return $this;
    }

    

   
    public function getAchievementValue(): ?float
    {
        return $this->achievementValue;
    }

    public function setAchievementValue(float $achievementValue): self
    {
        $this->achievementValue = $achievementValue;

        return $this;
    }

    

    public function getYearPlan(): ?PlanAchievement
    {
        return $this->yearPlan;
    }

    public function setYearPlan(?PlanAchievement $yearPlan): self
    {
        $this->yearPlan = $yearPlan;

        return $this;
    }

    public function getQuarterPlan(): ?float
    {
        return $this->quarterPlan;
    }

    public function setQuarterPlan(?float $quarterPlan): self
    {
        $this->quarterPlan = $quarterPlan;

        return $this;
    }
}
