<?php

namespace App\Entity;

use App\Repository\PlanningYearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningYearRepository::class)
 */
class PlanningYear
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive=1;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="planningYears",cascade={"persist"})
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=PlanningPhase::class, mappedBy="planningYear")
     */
    private $planningPhases;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=SuitableInitiative::class, mappedBy="planningYear")
     */
    private $suitableInitiatives;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfQuarter;

    /**
     * @ORM\OneToMany(targetEntity=PlanAchievement::class, mappedBy="year")
     */
    private $planAchievements;

    /**
     * @ORM\OneToMany(targetEntity=QuarterAccomplishment::class, mappedBy="year")
     */
    private $quarterAccomplishments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ethYear;

    /**
     * @ORM\OneToMany(targetEntity=InitiativeAchievement::class, mappedBy="year")
     */
    private $initiativeAchievements;

    /**
     * @ORM\OneToMany(targetEntity=KPiAchievement::class, mappedBy="year")
     */
    private $kPiAchievements;

    /**
     * @ORM\OneToMany(targetEntity=ObjectiveAchievement::class, mappedBy="year")
     */
    private $objectiveAchievements;

    /**
     * @ORM\OneToMany(targetEntity=GoalAchievement::class, mappedBy="year")
     */
    private $goalAchievements;

    /**
     * @ORM\OneToMany(targetEntity=InistuitionSuitableInitiative::class, mappedBy="year")
     */
    private $inistuitionSuitableInitiatives;

    /**
     * @ORM\OneToMany(targetEntity=OfficeKpiPlan::class, mappedBy="year")
     */
    private $officeKpiPlans;

    /**
     * @ORM\OneToOne(targetEntity=KeyPerformanceIndicatorBudget::class, mappedBy="plan_year", cascade={"persist", "remove"})
     */
    private $keyPerformanceIndicatorBudget;

    /**
     * @ORM\OneToMany(targetEntity=KeyPerformanceIndicatorBudget::class, mappedBy="plan_year", orphanRemoval=true)
     */
    private $keyPerformanceIndicatorBudgets;

    public function __construct()
    {
        $this->planningPhases = new ArrayCollection();
      
        $this->suitableInitiatives = new ArrayCollection();
        $this->planAchievements = new ArrayCollection();
        $this->quarterAccomplishments = new ArrayCollection();
        $this->initiativeAchievements = new ArrayCollection();
        $this->kPiAchievements = new ArrayCollection();
        $this->objectiveAchievements = new ArrayCollection();
        $this->goalAchievements = new ArrayCollection();
        $this->inistuitionSuitableInitiatives = new ArrayCollection();
        $this->officeKpiPlans = new ArrayCollection();
        $this->keyPerformanceIndicatorBudgets = new ArrayCollection();
    }
    public function __toString()
    {
        
        return date_format($this->year,"Y");
        
        
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|PlanningPhase[]
     */
    public function getPlanningPhases(): Collection
    {
        return $this->planningPhases;
    }

    public function addPlanningPhase(PlanningPhase $planningPhase): self
    {
        if (!$this->planningPhases->contains($planningPhase)) {
            $this->planningPhases[] = $planningPhase;
            $planningPhase->setPlanningYear($this);
        }

        return $this;
    }

    public function removePlanningPhase(PlanningPhase $planningPhase): self
    {
        if ($this->planningPhases->removeElement($planningPhase)) {
            // set the owning side to null (unless already changed)
            if ($planningPhase->getPlanningYear() === $this) {
                $planningPhase->setPlanningYear(null);
            }
        }

        return $this;
    }

    
  

    

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Collection|SuitableInitiative[]
     */
    public function getSuitableInitiatives(): Collection
    {
        return $this->suitableInitiatives;
    }

    public function addSuitableInitiative(SuitableInitiative $suitableInitiative): self
    {
        if (!$this->suitableInitiatives->contains($suitableInitiative)) {
            $this->suitableInitiatives[] = $suitableInitiative;
            $suitableInitiative->setPlanningYear($this);
        }

        return $this;
    }

    public function removeSuitableInitiative(SuitableInitiative $suitableInitiative): self
    {
        if ($this->suitableInitiatives->removeElement($suitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($suitableInitiative->getPlanningYear() === $this) {
                $suitableInitiative->setPlanningYear(null);
            }
        }

        return $this;
    }

    public function getNumberOfQuarter(): ?int
    {
        return $this->numberOfQuarter;
    }

    public function setNumberOfQuarter(?int $numberOfQuarter): self
    {
        $this->numberOfQuarter = $numberOfQuarter;

        return $this;
    }

    /**
     * @return Collection|PlanAchievement[]
     */
    public function getPlanAchievements(): Collection
    {
        return $this->planAchievements;
    }

    public function addPlanAchievement(PlanAchievement $planAchievement): self
    {
        if (!$this->planAchievements->contains($planAchievement)) {
            $this->planAchievements[] = $planAchievement;
            $planAchievement->setYear($this);
        }

        return $this;
    }

    public function removePlanAchievement(PlanAchievement $planAchievement): self
    {
        if ($this->planAchievements->removeElement($planAchievement)) {
            // set the owning side to null (unless already changed)
            if ($planAchievement->getYear() === $this) {
                $planAchievement->setYear(null);
            }
        }

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
            $quarterAccomplishment->setYear($this);
        }

        return $this;
    }

    public function removeQuarterAccomplishment(QuarterAccomplishment $quarterAccomplishment): self
    {
        if ($this->quarterAccomplishments->removeElement($quarterAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($quarterAccomplishment->getYear() === $this) {
                $quarterAccomplishment->setYear(null);
            }
        }

        return $this;
    }

    public function getEthYear(): ?string
    {
        return $this->ethYear;
    }

    public function setEthYear(string $ethYear): self
    {
        $this->ethYear = $ethYear;

        return $this;
    }

    /**
     * @return Collection|InitiativeAchievement[]
     */
    public function getInitiativeAchievements(): Collection
    {
        return $this->initiativeAchievements;
    }

    public function addInitiativeAchievement(InitiativeAchievement $initiativeAchievement): self
    {
        if (!$this->initiativeAchievements->contains($initiativeAchievement)) {
            $this->initiativeAchievements[] = $initiativeAchievement;
            $initiativeAchievement->setYear($this);
        }

        return $this;
    }

    public function removeInitiativeAchievement(InitiativeAchievement $initiativeAchievement): self
    {
        if ($this->initiativeAchievements->removeElement($initiativeAchievement)) {
            // set the owning side to null (unless already changed)
            if ($initiativeAchievement->getYear() === $this) {
                $initiativeAchievement->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|KPiAchievement[]
     */
    public function getKPiAchievements(): Collection
    {
        return $this->kPiAchievements;
    }

    public function addKPiAchievement(KPiAchievement $kPiAchievement): self
    {
        if (!$this->kPiAchievements->contains($kPiAchievement)) {
            $this->kPiAchievements[] = $kPiAchievement;
            $kPiAchievement->setYear($this);
        }

        return $this;
    }

    public function removeKPiAchievement(KPiAchievement $kPiAchievement): self
    {
        if ($this->kPiAchievements->removeElement($kPiAchievement)) {
            // set the owning side to null (unless already changed)
            if ($kPiAchievement->getYear() === $this) {
                $kPiAchievement->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ObjectiveAchievement[]
     */
    public function getObjectiveAchievements(): Collection
    {
        return $this->objectiveAchievements;
    }

    public function addObjectiveAchievement(ObjectiveAchievement $objectiveAchievement): self
    {
        if (!$this->objectiveAchievements->contains($objectiveAchievement)) {
            $this->objectiveAchievements[] = $objectiveAchievement;
            $objectiveAchievement->setYear($this);
        }

        return $this;
    }

    public function removeObjectiveAchievement(ObjectiveAchievement $objectiveAchievement): self
    {
        if ($this->objectiveAchievements->removeElement($objectiveAchievement)) {
            // set the owning side to null (unless already changed)
            if ($objectiveAchievement->getYear() === $this) {
                $objectiveAchievement->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GoalAchievement[]
     */
    public function getGoalAchievements(): Collection
    {
        return $this->goalAchievements;
    }

    public function addGoalAchievement(GoalAchievement $goalAchievement): self
    {
        if (!$this->goalAchievements->contains($goalAchievement)) {
            $this->goalAchievements[] = $goalAchievement;
            $goalAchievement->setYear($this);
        }

        return $this;
    }

    public function removeGoalAchievement(GoalAchievement $goalAchievement): self
    {
        if ($this->goalAchievements->removeElement($goalAchievement)) {
            // set the owning side to null (unless already changed)
            if ($goalAchievement->getYear() === $this) {
                $goalAchievement->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InistuitionSuitableInitiative[]
     */
    public function getInistuitionSuitableInitiatives(): Collection
    {
        return $this->inistuitionSuitableInitiatives;
    }

    public function addInistuitionSuitableInitiative(InistuitionSuitableInitiative $inistuitionSuitableInitiative): self
    {
        if (!$this->inistuitionSuitableInitiatives->contains($inistuitionSuitableInitiative)) {
            $this->inistuitionSuitableInitiatives[] = $inistuitionSuitableInitiative;
            $inistuitionSuitableInitiative->setYear($this);
        }

        return $this;
    }

    public function removeInistuitionSuitableInitiative(InistuitionSuitableInitiative $inistuitionSuitableInitiative): self
    {
        if ($this->inistuitionSuitableInitiatives->removeElement($inistuitionSuitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($inistuitionSuitableInitiative->getYear() === $this) {
                $inistuitionSuitableInitiative->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OfficeKpiPlan[]
     */
    public function getOfficeKpiPlans(): Collection
    {
        return $this->officeKpiPlans;
    }

    public function addOfficeKpiPlan(OfficeKpiPlan $officeKpiPlan): self
    {
        if (!$this->officeKpiPlans->contains($officeKpiPlan)) {
            $this->officeKpiPlans[] = $officeKpiPlan;
            $officeKpiPlan->setYear($this);
        }

        return $this;
    }

    public function removeOfficeKpiPlan(OfficeKpiPlan $officeKpiPlan): self
    {
        if ($this->officeKpiPlans->removeElement($officeKpiPlan)) {
            // set the owning side to null (unless already changed)
            if ($officeKpiPlan->getYear() === $this) {
                $officeKpiPlan->setYear(null);
            }
        }

        return $this;
    }

    public function getKeyPerformanceIndicatorBudget(): ?KeyPerformanceIndicatorBudget
    {
        return $this->keyPerformanceIndicatorBudget;
    }

    public function setKeyPerformanceIndicatorBudget(KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget): self
    {
        // set the owning side of the relation if necessary
        if ($keyPerformanceIndicatorBudget->getPlanYear() !== $this) {
            $keyPerformanceIndicatorBudget->setPlanYear($this);
        }

        $this->keyPerformanceIndicatorBudget = $keyPerformanceIndicatorBudget;

        return $this;
    }

    /**
     * @return Collection<int, KeyPerformanceIndicatorBudget>
     */
    public function getKeyPerformanceIndicatorBudgets(): Collection
    {
        return $this->keyPerformanceIndicatorBudgets;
    }

    public function addKeyPerformanceIndicatorBudget(KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget): self
    {
        if (!$this->keyPerformanceIndicatorBudgets->contains($keyPerformanceIndicatorBudget)) {
            $this->keyPerformanceIndicatorBudgets[] = $keyPerformanceIndicatorBudget;
            $keyPerformanceIndicatorBudget->setPlanYear($this);
        }

        return $this;
    }

    public function removeKeyPerformanceIndicatorBudget(KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget): self
    {
        if ($this->keyPerformanceIndicatorBudgets->removeElement($keyPerformanceIndicatorBudget)) {
            // set the owning side to null (unless already changed)
            if ($keyPerformanceIndicatorBudget->getPlanYear() === $this) {
                $keyPerformanceIndicatorBudget->setPlanYear(null);
            }
        }

        return $this;
    }
}
