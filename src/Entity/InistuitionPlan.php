<?php

namespace App\Entity;

use App\Repository\InistuitionPlanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InistuitionPlanRepository::class)
 */
class InistuitionPlan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InistuitionSuitableInitiative::class, inversedBy="inistuitionPlans")
     */
    private $instuitionSuitable;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="inistuitionPlans")
     */
    private $quarter;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="inistuitionPlans")
     */
    private $socialAttribute;

    /**
     * @ORM\Column(type="float")
     */
    private $plan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accomp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInstuitionSuitable(): ?InistuitionSuitableInitiative
    {
        return $this->instuitionSuitable;
    }

    public function setInstuitionSuitable(?InistuitionSuitableInitiative $instuitionSuitable): self
    {
        $this->instuitionSuitable = $instuitionSuitable;

        return $this;
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

    public function getSocialAttribute(): ?InitiativeAttribute
    {
        return $this->socialAttribute;
    }

    public function setSocialAttribute(?InitiativeAttribute $socialAttribute): self
    {
        $this->socialAttribute = $socialAttribute;

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

    public function getAccomp(): ?float
    {
        return $this->accomp;
    }

    public function setAccomp(?float $accomp): self
    {
        $this->accomp = $accomp;

        return $this;
    }
}
