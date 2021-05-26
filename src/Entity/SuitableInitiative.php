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

    public function __construct()
    {
        $this->plans = new ArrayCollection();
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
}
