<?php

namespace App\Entity;

use App\Repository\PlanAchievementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanAchievementRepository::class)
 */
class PlanAchievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="planAchievements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity=Goal::class, inversedBy="planAchievements")
     */
    private $goal;

    /**
     * @ORM\ManyToOne(targetEntity=Objective::class, inversedBy="planAchievements")
     */
    private $Objective;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $accomplishmentValue;

    /**
     * @ORM\ManyToOne(targetEntity=KeyPerformanceIndicator::class, inversedBy="planAchievements")
     */
    private $kpi;

    /**
     * @ORM\ManyToOne(targetEntity=Initiative::class, inversedBy="planAchievements")
     */
    private $initiative;

    /**
     * @ORM\ManyToOne(targetEntity=Strategy::class, inversedBy="planAchievements")
     */
    private $strategy;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?PlanningYear
    {
        return $this->year;
    }

    public function setYear(?PlanningYear $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getGoal(): ?Goal
    {
        return $this->goal;
    }

    public function setGoal(?Goal $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->Objective;
    }

    public function setObjective(?Objective $Objective): self
    {
        $this->Objective = $Objective;

        return $this;
    }

    public function getAccomplishmentValue(): ?string
    {
        return $this->accomplishmentValue;
    }

    public function setAccomplishmentValue(string $accomplishmentValue): self
    {
        $this->accomplishmentValue = $accomplishmentValue;

        return $this;
    }

    public function getKpi(): ?KeyPerformanceIndicator
    {
        return $this->kpi;
    }

    public function setKpi(?KeyPerformanceIndicator $kpi): self
    {
        $this->kpi = $kpi;

        return $this;
    }

    public function getInitiative(): ?Initiative
    {
        return $this->initiative;
    }

    public function setInitiative(?Initiative $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getStrategy(): ?Strategy
    {
        return $this->strategy;
    }

    public function setStrategy(?Strategy $strategy): self
    {
        $this->strategy = $strategy;

        return $this;
    }
}
