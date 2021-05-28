<?php

namespace App\Entity;

use App\Repository\BehavioralPlanningAccomplishmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BehavioralPlanningAccomplishmentRepository::class)
 */
class BehavioralPlanningAccomplishment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="behavioralPlanningAccomplishments")
     */
    private $initiativeAttribute;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="behavioralPlanningAccomplishments")
     */
    private $plan;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $accomplishmentValue;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accomplishmentNote;

    /**
     * @ORM\Column(type="integer")
     */
    private $planValue;

    /**
     * @ORM\ManyToOne(targetEntity=SuitableInitiative::class, inversedBy="behavioralPlanningAccomplishments")
     */
    private $suitableInitiative;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="behavioralPlanningAccomplishments")
     */
    private $quarter;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitiativeAttribute(): ?InitiativeAttribute
    {
        return $this->initiativeAttribute;
    }

    public function setInitiativeAttribute(?InitiativeAttribute $initiativeAttribute): self
    {
        $this->initiativeAttribute = $initiativeAttribute;

        return $this;
    }

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getAccomplishmentValue(): ?int
    {
        return $this->accomplishmentValue;
    }

    public function setAccomplishmentValue(int $accomplishmentValue): self
    {
        $this->accomplishmentValue = $accomplishmentValue;

        return $this;
    }

    public function getAccomplishmentNote(): ?string
    {
        return $this->accomplishmentNote;
    }

    public function setAccomplishmentNote(?string $accomplishmentNote): self
    {
        $this->accomplishmentNote = $accomplishmentNote;

        return $this;
    }

    public function getPlanValue(): ?int
    {
        return $this->planValue;
    }

    public function setPlanValue(int $planValue): self
    {
        $this->planValue = $planValue;

        return $this;
    }

    public function getSuitableInitiative(): ?SuitableInitiative
    {
        return $this->suitableInitiative;
    }

    public function setSuitableInitiative(?SuitableInitiative $suitableInitiative): self
    {
        $this->suitableInitiative = $suitableInitiative;

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

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }
}
