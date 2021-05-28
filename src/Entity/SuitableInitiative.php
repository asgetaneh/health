<?php

namespace App\Entity;

use App\Repository\SuitableInitiativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuitableInitiativeRepository::class)
 */
class SuitableInitiative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PrincipalOffice::class, inversedBy="suitableInitiatives")
     */
    private $principalOffice;

    /**
     * @ORM\ManyToOne(targetEntity=Initiative::class, inversedBy="suitableInitiatives")
     */
    private $initiative;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="suitableInitiatives")
     */
    private $planningYear;

    /**
     * @ORM\OneToMany(targetEntity=Plan::class, mappedBy="suitableInitiative")
     */
    private $plans;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive=0;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $denominator;

    /**
     * @ORM\OneToMany(targetEntity=PlanningAccomplishment::class, mappedBy="suitableInitiative")
     */
    private $planningAccomplishments;

    /**
     * @ORM\OneToMany(targetEntity=BehavioralPlanningAccomplishment::class, mappedBy="suitableInitiative")
     */
    private $behavioralPlanningAccomplishments;

    public function __construct()
    {
        $this->plans = new ArrayCollection();
        $this->planningAccomplishments = new ArrayCollection();
        $this->behavioralPlanningAccomplishments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrincipalOffice(): ?PrincipalOffice
    {
        return $this->principalOffice;
    }

    public function setPrincipalOffice(?PrincipalOffice $principalOffice): self
    {
        $this->principalOffice = $principalOffice;

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

    public function getPlanningYear(): ?PlanningYear
    {
        return $this->planningYear;
    }

    public function setPlanningYear(?PlanningYear $planningYear): self
    {
        $this->planningYear = $planningYear;

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
            $plan->setSuitableInitiative($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getSuitableInitiative() === $this) {
                $plan->setSuitableInitiative(null);
            }
        }

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

    public function getDenominator(): ?int
    {
        return $this->denominator;
    }

    public function setDenominator(?int $denominator): self
    {
        $this->denominator = $denominator;

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
            $planningAccomplishment->setSuitableInitiative($this);
        }

        return $this;
    }

    public function removePlanningAccomplishment(PlanningAccomplishment $planningAccomplishment): self
    {
        if ($this->planningAccomplishments->removeElement($planningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($planningAccomplishment->getSuitableInitiative() === $this) {
                $planningAccomplishment->setSuitableInitiative(null);
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
            $behavioralPlanningAccomplishment->setSuitableInitiative($this);
        }

        return $this;
    }

    public function removeBehavioralPlanningAccomplishment(BehavioralPlanningAccomplishment $behavioralPlanningAccomplishment): self
    {
        if ($this->behavioralPlanningAccomplishments->removeElement($behavioralPlanningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($behavioralPlanningAccomplishment->getSuitableInitiative() === $this) {
                $behavioralPlanningAccomplishment->setSuitableInitiative(null);
            }
        }

        return $this;
    }
}
