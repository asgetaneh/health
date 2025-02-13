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

    /**
     * @ORM\OneToMany(targetEntity=OperationalInitiative::class, mappedBy="initiative")
     */
    private $operationalInitiatives;

    /**

     * @ORM\Column(type="float", nullable=true)
     */
    private $yearlyAccomplishment;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=OperationalSuitableInitiative::class, mappedBy="suitableInitiative")
     */
    private $operationalSuitableInitiatives;

    /**
     * @ORM\OneToMany(targetEntity=SuitableOperational::class, mappedBy="suitableInitiative")
     */
    private $suitableOperationals;

    /**
     * @ORM\ManyToOne(targetEntity=InistuitionSuitableInitiative::class, inversedBy="principalSuitableInitiative")
     */
    private $inistuitionSuitableInitiative;

   
    


    public function __construct()
    {
        $this->plans = new ArrayCollection();
        $this->planningAccomplishments = new ArrayCollection();
        $this->behavioralPlanningAccomplishments = new ArrayCollection();
        $this->operationalInitiatives = new ArrayCollection();
        $this->operationalSuitableInitiatives = new ArrayCollection();
        $this->suitableOperationals = new ArrayCollection();
      
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

    /**
     * @return Collection|OperationalInitiative[]
     */
    public function getOperationalInitiatives(): Collection
    {
        return $this->operationalInitiatives;
    }

    public function addOperationalInitiative(OperationalInitiative $operationalInitiative): self
    {
        if (!$this->operationalInitiatives->contains($operationalInitiative)) {
            $this->operationalInitiatives[] = $operationalInitiative;
            $operationalInitiative->setInitiative($this);
        }

        return $this;
    }

    public function removeOperationalInitiative(OperationalInitiative $operationalInitiative): self
    {
        if ($this->operationalInitiatives->removeElement($operationalInitiative)) {
            // set the owning side to null (unless already changed)
            if ($operationalInitiative->getInitiative() === $this) {
                $operationalInitiative->setInitiative(null);
            }
        }

        return $this;
    }


    public function getYearlyAccomplishment(): ?float
    {
        return $this->yearlyAccomplishment;
    }

    public function setYearlyAccomplishment(?float $yearlyAccomplishment): self
    {
        $this->yearlyAccomplishment = $yearlyAccomplishment;
                return $this;

    }
    


    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;
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
            $operationalSuitableInitiative->setSuitableInitiative($this);
        }

        return $this;
    }

    public function removeOperationalSuitableInitiative(OperationalSuitableInitiative $operationalSuitableInitiative): self
    {
        if ($this->operationalSuitableInitiatives->removeElement($operationalSuitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($operationalSuitableInitiative->getSuitableInitiative() === $this) {
                $operationalSuitableInitiative->setSuitableInitiative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SuitableOperational[]
     */
    public function getSuitableOperationals(): Collection
    {
        return $this->suitableOperationals;
    }

    public function addSuitableOperational(SuitableOperational $suitableOperational): self
    {
        if (!$this->suitableOperationals->contains($suitableOperational)) {
            $this->suitableOperationals[] = $suitableOperational;
            $suitableOperational->setSuitableInitiative($this);
        }

        return $this;
    }

    public function removeSuitableOperational(SuitableOperational $suitableOperational): self
    {
        if ($this->suitableOperationals->removeElement($suitableOperational)) {
            // set the owning side to null (unless already changed)
            if ($suitableOperational->getSuitableInitiative() === $this) {
                $suitableOperational->setSuitableInitiative(null);
            }
        }

        return $this;
    }

    public function getInistuitionSuitableInitiative(): ?InistuitionSuitableInitiative
    {
        return $this->inistuitionSuitableInitiative;
    }

    public function setInistuitionSuitableInitiative(?InistuitionSuitableInitiative $inistuitionSuitableInitiative): self
    {
        $this->inistuitionSuitableInitiative = $inistuitionSuitableInitiative;

        return $this;
    }

    

}
