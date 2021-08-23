<?php

namespace App\Entity;

use App\Repository\PlanAchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="decimal", precision=10, scale=2,nullable=true)
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
     * @ORM\OneToMany(targetEntity=QuarterAccomplishment::class, mappedBy="yearPlan")
     */
    private $quarterAccomplishments;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0,nullable=true)
     */
    private $plan;

    public function __construct()
    {
        $this->quarterAccomplishments = new ArrayCollection();
    }

    

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

    /**
     * @return Collection|QuarterAccomplishment[]
     */
    public function getQuarterAccomplishments(): Collection
    {
        return $this->quarterAccomplishments;
    }

    public function addQuarterAccomplishment(QuarterAccomplishment $quarterAccomplishment): self
    {
        if (!$this->quarterAccomplishments->contains($quarterAccomplishment)) {
            $this->quarterAccomplishments[] = $quarterAccomplishment;
            $quarterAccomplishment->setYearPlan($this);
        }

        return $this;
    }

    public function removeQuarterAccomplishment(QuarterAccomplishment $quarterAccomplishment): self
    {
        if ($this->quarterAccomplishments->removeElement($quarterAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($quarterAccomplishment->getYearPlan() === $this) {
                $quarterAccomplishment->setYearPlan(null);
            }
        }

        return $this;
    }

    public function getPlan(): ?float
    {
        return $this->plan;
    }

    public function setPlan(float $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    
}
