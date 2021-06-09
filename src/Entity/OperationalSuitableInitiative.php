<?php

namespace App\Entity;

use App\Repository\OperationalSuitableInitiativeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationalSuitableInitiativeRepository::class)
 */
class OperationalSuitableInitiative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SuitableInitiative::class, inversedBy="operationalSuitableInitiatives")
     */
    private $suitable;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalOffice::class, inversedBy="operationalSuitableInitiatives")
     */
    private $operationalOffice;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accomplishedValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="operationalSuitableInitiatives")
     */
    private $quarter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSuitable(): ?SuitableInitiative
    {
        return $this->suitable;
    }

    public function setSuitable(?SuitableInitiative $suitable): self
    {
        $this->suitable = $suitable;

        return $this;
    }

    public function getOperationalOffice(): ?OperationalOffice
    {
        return $this->operationalOffice;
    }

    public function setOperationalOffice(?OperationalOffice $operationalOffice): self
    {
        $this->operationalOffice = $operationalOffice;

        return $this;
    }

    public function getAccomplishedValue(): ?float
    {
        return $this->accomplishedValue;
    }

    public function setAccomplishedValue(?float $accomplishedValue): self
    {
        $this->accomplishedValue = $accomplishedValue;

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

    public function getQuarter(): ?PlanningQuarter
    {
        return $this->quarter;
    }

    public function setQuarter(?PlanningQuarter $quarter): self
    {
        $this->quarter = $quarter;

        return $this;
    }
}
