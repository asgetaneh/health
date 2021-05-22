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
     * @ORM\Column(type="integer")
     */
    private $accomplishmentValue;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accomplishmentNote;

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
}
