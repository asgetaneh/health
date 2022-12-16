<?php

namespace App\Entity;

use App\Repository\KeyPerformanceIndicatorBudgetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KeyPerformanceIndicatorBudgetRepository::class)
 */
class KeyPerformanceIndicatorBudget
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   

    /**
     * @ORM\ManyToOne(targetEntity=KeyPerformanceIndicator::class, inversedBy="keyPerformanceIndicatorBudgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $key_performance_indicator;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="keyPerformanceIndicatorBudgets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $plan_year;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adjusted_budget_amount;
    
      public function getId(): ?int
    {
        return $this->id;
    }

    public function getKeyPerformanceIndicator(): ?KeyPerformanceIndicator
    {
        return $this->key_performance_indicator;
    }

    public function setKeyPerformanceIndicator(?KeyPerformanceIndicator $key_performance_indicator): self
    {
        $this->key_performance_indicator = $key_performance_indicator;

        return $this;
    }

    public function getPlanYear(): ?PlanningYear
    {
        return $this->plan_year;
    }

    public function setPlanYear(?PlanningYear $plan_year): self
    {
        $this->plan_year = $plan_year;

        return $this;
    }

    public function getAdjustedBudgetAmount(): ?string
    {
        return $this->adjusted_budget_amount;
    }

    public function setAdjustedBudgetAmount(string $adjusted_budget_amount): self
    {
        $this->adjusted_budget_amount = $adjusted_budget_amount;

        return $this;
    }

   
}
