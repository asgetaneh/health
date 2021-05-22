<?php

namespace App\Entity;

use App\Repository\PlanningAccomplishmentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningAccomplishmentRepository::class)
 */
class PlanningAccomplishment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Plan::class, cascade={"persist", "remove"})
     */
    private $plan;

    /**
     * @ORM\Column(type="integer")
     */
    private $accompValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $denominator;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accomplishNote;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAccompValue(): ?int
    {
        return $this->accompValue;
    }

    public function setAccompValue(int $accompValue): self
    {
        $this->accompValue = $accompValue;

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

    public function getAccomplishNote(): ?string
    {
        return $this->accomplishNote;
    }

    public function setAccomplishNote(?string $accomplishNote): self
    {
        $this->accomplishNote = $accomplishNote;

        return $this;
    }
}
