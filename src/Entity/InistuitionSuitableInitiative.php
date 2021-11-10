<?php

namespace App\Entity;

use App\Repository\InistuitionSuitableInitiativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InistuitionSuitableInitiativeRepository::class)
 */
class InistuitionSuitableInitiative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Initiative::class, inversedBy="inistuitionSuitableInitiatives")
     */
    private $initiative;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="inistuitionSuitableInitiatives")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity=PrincipalOfficeGroup::class, inversedBy="inistuitionSuitableInitiatives")
     */
    private $inistuition;

    /**
     * @ORM\OneToMany(targetEntity=InistuitionPlan::class, mappedBy="instuitionSuitable")
     */
    private $inistuitionPlans;

    /**
     * @ORM\OneToMany(targetEntity=SuitableInitiative::class, mappedBy="inistuitionSuitableInitiative")
     */
    private $principalSuitableInitiative;

    public function __construct()
    {
        $this->inistuitionPlans = new ArrayCollection();
        $this->principalSuitableInitiative = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getYear(): ?PlanningYear
    {
        return $this->year;
    }

    public function setYear(?PlanningYear $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getInistuition(): ?PrincipalOfficeGroup
    {
        return $this->inistuition;
    }

    public function setInistuition(?PrincipalOfficeGroup $inistuition): self
    {
        $this->inistuition = $inistuition;

        return $this;
    }

    /**
     * @return Collection|InistuitionPlan[]
     */
    public function getInistuitionPlans(): Collection
    {
        return $this->inistuitionPlans;
    }

    public function addInistuitionPlan(InistuitionPlan $inistuitionPlan): self
    {
        if (!$this->inistuitionPlans->contains($inistuitionPlan)) {
            $this->inistuitionPlans[] = $inistuitionPlan;
            $inistuitionPlan->setInstuitionSuitable($this);
        }

        return $this;
    }

    public function removeInistuitionPlan(InistuitionPlan $inistuitionPlan): self
    {
        if ($this->inistuitionPlans->removeElement($inistuitionPlan)) {
            // set the owning side to null (unless already changed)
            if ($inistuitionPlan->getInstuitionSuitable() === $this) {
                $inistuitionPlan->setInstuitionSuitable(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SuitableInitiative[]
     */
    public function getPrincipalSuitableInitiative(): Collection
    {
        return $this->principalSuitableInitiative;
    }

    public function addPrincipalSuitableInitiative(SuitableInitiative $principalSuitableInitiative): self
    {
        if (!$this->principalSuitableInitiative->contains($principalSuitableInitiative)) {
            $this->principalSuitableInitiative[] = $principalSuitableInitiative;
            $principalSuitableInitiative->setInistuitionSuitableInitiative($this);
        }

        return $this;
    }

    public function removePrincipalSuitableInitiative(SuitableInitiative $principalSuitableInitiative): self
    {
        if ($this->principalSuitableInitiative->removeElement($principalSuitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($principalSuitableInitiative->getInistuitionSuitableInitiative() === $this) {
                $principalSuitableInitiative->setInistuitionSuitableInitiative(null);
            }
        }

        return $this;
    }
}
