<?php

namespace App\Entity;

use App\Repository\PlanningQuarterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningQuarterRepository::class)
 */
class PlanningQuarter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="planningQuarters")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=PlanningPhase::class, mappedBy="quarter")
     */
    private $planningPhases;

    /**
     * @ORM\OneToMany(targetEntity=Plan::class, mappedBy="quarter")
     */
    private $plans;

    /**
     * @ORM\OneToMany(targetEntity=OperationalTask::class, mappedBy="quarter")
     */
    private $operationalTasks;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="quarter")
     */
    private $performerTasks;

    /**
     * @ORM\OneToMany(targetEntity=PlanningAccomplishment::class, mappedBy="quarter")
     */
    private $planningAccomplishments;

    /**
     * @ORM\OneToMany(targetEntity=BehavioralPlanningAccomplishment::class, mappedBy="quarter")
     */
    private $behavioralPlanningAccomplishments;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\OneToMany(targetEntity=OperationalSuitableInitiative::class, mappedBy="quarter")
     */
    private $operationalSuitableInitiatives;

    /**
     * @ORM\OneToMany(targetEntity=QuarterAccomplishment::class, mappedBy="quarter")
     */
    private $quarterAccomplishments;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $startDay;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $startMonth;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $endDay;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $endMonth;

    /**
     * @ORM\OneToMany(targetEntity=OperationalPlanningAccomplishment::class, mappedBy="quarter")
     */
    private $operationalPlanningAccomplishments;

    /**
     * @ORM\OneToMany(targetEntity=QuarterPlanAchievement::class, mappedBy="quarter")
     */
    private $quarterPlanAchievements;

    public function __construct()
    {
        $this->planningPhases = new ArrayCollection();
        $this->plans = new ArrayCollection();
        $this->operationalTasks = new ArrayCollection();
        $this->performerTasks = new ArrayCollection();
        $this->planningAccomplishments = new ArrayCollection();
        $this->behavioralPlanningAccomplishments = new ArrayCollection();
        $this->operationalSuitableInitiatives = new ArrayCollection();
        $this->quarterAccomplishments = new ArrayCollection();
        $this->operationalPlanningAccomplishments = new ArrayCollection();
        $this->quarterPlanAchievements = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $planningPhase->addQuarter($this);
        }

        return $this;
    }

    public function removePlanningPhase(PlanningPhase $planningPhase): self
    {
        if ($this->planningPhases->removeElement($planningPhase)) {
            $planningPhase->removeQuarter($this);
        }

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlans(): Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans[] = $plan;
            $plan->setQuarter($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getQuarter() === $this) {
                $plan->setQuarter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OperationalTask[]
     */
    public function getOperationalTasks(): Collection
    {
        return $this->operationalTasks;
    }

    public function addOperationalTask(OperationalTask $operationalTask): self
    {
        if (!$this->operationalTasks->contains($operationalTask)) {
            $this->operationalTasks[] = $operationalTask;
            $operationalTask->setQuarter($this);
        }

        return $this;
    }

    public function removeOperationalTask(OperationalTask $operationalTask): self
    {
        if ($this->operationalTasks->removeElement($operationalTask)) {
            // set the owning side to null (unless already changed)
            if ($operationalTask->getQuarter() === $this) {
                $operationalTask->setQuarter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PerformerTask[]
     */
    public function getPerformerTasks(): Collection
    {
        return $this->performerTasks;
    }

    public function addPerformerTask(PerformerTask $performerTask): self
    {
        if (!$this->performerTasks->contains($performerTask)) {
            $this->performerTasks[] = $performerTask;
            $performerTask->setQuarter($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getQuarter() === $this) {
                $performerTask->setQuarter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PlanningAccomplishment[]
     */
    public function getPlanningAccomplishments(): Collection
    {
        return $this->planningAccomplishments;
    }

    public function addPlanningAccomplishment(PlanningAccomplishment $planningAccomplishment): self
    {
        if (!$this->planningAccomplishments->contains($planningAccomplishment)) {
            $this->planningAccomplishments[] = $planningAccomplishment;
            $planningAccomplishment->setQuarter($this);
        }

        return $this;
    }

    public function removePlanningAccomplishment(PlanningAccomplishment $planningAccomplishment): self
    {
        if ($this->planningAccomplishments->removeElement($planningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($planningAccomplishment->getQuarter() === $this) {
                $planningAccomplishment->setQuarter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BehavioralPlanningAccomplishment[]
     */
    public function getBehavioralPlanningAccomplishments(): Collection
    {
        return $this->behavioralPlanningAccomplishments;
    }

    public function addBehavioralPlanningAccomplishment(BehavioralPlanningAccomplishment $behavioralPlanningAccomplishment): self
    {
        if (!$this->behavioralPlanningAccomplishments->contains($behavioralPlanningAccomplishment)) {
            $this->behavioralPlanningAccomplishments[] = $behavioralPlanningAccomplishment;
            $behavioralPlanningAccomplishment->setQuarter($this);
        }

        return $this;
    }

    public function removeBehavioralPlanningAccomplishment(BehavioralPlanningAccomplishment $behavioralPlanningAccomplishment): self
    {
        if ($this->behavioralPlanningAccomplishments->removeElement($behavioralPlanningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($behavioralPlanningAccomplishment->getQuarter() === $this) {
                $behavioralPlanningAccomplishment->setQuarter(null);
            }
        }

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return Collection|OperationalSuitableInitiative[]
     */
    public function getOperationalSuitableInitiatives(): Collection
    {
        return $this->operationalSuitableInitiatives;
    }

    public function addOperationalSuitableInitiative(OperationalSuitableInitiative $operationalSuitableInitiative): self
    {
        if (!$this->operationalSuitableInitiatives->contains($operationalSuitableInitiative)) {
            $this->operationalSuitableInitiatives[] = $operationalSuitableInitiative;
            $operationalSuitableInitiative->setQuarter($this);
        }

        return $this;
    }

    public function removeOperationalSuitableInitiative(OperationalSuitableInitiative $operationalSuitableInitiative): self
    {
        if ($this->operationalSuitableInitiatives->removeElement($operationalSuitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($operationalSuitableInitiative->getQuarter() === $this) {
                $operationalSuitableInitiative->setQuarter(null);
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
            $quarterAccomplishment->setQuarter($this);
        }

        return $this;
    }

    public function removeQuarterAccomplishment(QuarterAccomplishment $quarterAccomplishment): self
    {
        if ($this->quarterAccomplishments->removeElement($quarterAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($quarterAccomplishment->getQuarter() === $this) {
                $quarterAccomplishment->setQuarter(null);
            }
        }

        return $this;
    }

    public function getStartDay(): ?int
    {
        return $this->startDay;
    }

    public function setStartDay(?int $startDay): self
    {
        $this->startDay = $startDay;

        return $this;
    }

    public function getStartMonth(): ?int
    {
        return $this->startMonth;
    }

    public function setStartMonth(?int $startMonth): self
    {
        $this->startMonth = $startMonth;

        return $this;
    }

    public function getEndDay(): ?int
    {
        return $this->endDay;
    }

    public function setEndDay(?int $endDay): self
    {
        $this->endDay = $endDay;

        return $this;
    }

    public function getEndMonth(): ?int
    {
        return $this->endMonth;
    }

    public function setEndMonth(?int $endMonth): self
    {
        $this->endMonth = $endMonth;

        return $this;
    }

    /**
     * @return Collection|OperationalPlanningAccomplishment[]
     */
    public function getOperationalPlanningAccomplishments(): Collection
    {
        return $this->operationalPlanningAccomplishments;
    }

    public function addOperationalPlanningAccomplishment(OperationalPlanningAccomplishment $operationalPlanningAccomplishment): self
    {
        if (!$this->operationalPlanningAccomplishments->contains($operationalPlanningAccomplishment)) {
            $this->operationalPlanningAccomplishments[] = $operationalPlanningAccomplishment;
            $operationalPlanningAccomplishment->setQuarter($this);
        }

        return $this;
    }

    public function removeOperationalPlanningAccomplishment(OperationalPlanningAccomplishment $operationalPlanningAccomplishment): self
    {
        if ($this->operationalPlanningAccomplishments->removeElement($operationalPlanningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($operationalPlanningAccomplishment->getQuarter() === $this) {
                $operationalPlanningAccomplishment->setQuarter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|QuarterPlanAchievement[]
     */
    public function getQuarterPlanAchievements(): Collection
    {
        return $this->quarterPlanAchievements;
    }

    public function addQuarterPlanAchievement(QuarterPlanAchievement $quarterPlanAchievement): self
    {
        if (!$this->quarterPlanAchievements->contains($quarterPlanAchievement)) {
            $this->quarterPlanAchievements[] = $quarterPlanAchievement;
            $quarterPlanAchievement->setQuarter($this);
        }

        return $this;
    }

    public function removeQuarterPlanAchievement(QuarterPlanAchievement $quarterPlanAchievement): self
    {
        if ($this->quarterPlanAchievements->removeElement($quarterPlanAchievement)) {
            // set the owning side to null (unless already changed)
            if ($quarterPlanAchievement->getQuarter() === $this) {
                $quarterPlanAchievement->setQuarter(null);
            }
        }

        return $this;
    }
}
