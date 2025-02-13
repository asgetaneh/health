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

    

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="operationalSuitableInitiatives")
     */
    private $social;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalPlanningAccomplishment::class, inversedBy="operationalSuitableInitiatives")
     */
    private $operationalPlanning;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operationalSuitableInitiatives")
     */
    private $reportedBy;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $reportedAt;

    

   

    public function getId(): ?int
    {
        return $this->id;
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


    public function getSocial(): ?InitiativeAttribute
    {
        return $this->social;
    }

    public function setSocial(?InitiativeAttribute $social): self
    {
        $this->social = $social;

        return $this;
    }

    public function getOperationalPlanning(): ?OperationalPlanningAccomplishment
    {
        return $this->operationalPlanning;
    }

    public function setOperationalPlanning(?OperationalPlanningAccomplishment $operationalPlanning): self
    {
        $this->operationalPlanning = $operationalPlanning;

        return $this;
    }

    public function getReportedBy(): ?User
    {
        return $this->reportedBy;
    }

    public function setReportedBy(?User $reportedBy): self
    {
        $this->reportedBy = $reportedBy;

        return $this;
    }

    public function getReportedAt(): ?\DateTimeInterface
    {
        return $this->reportedAt;
    }

    public function setReportedAt(?\DateTimeInterface $reportedAt): self
    {
        $this->reportedAt = $reportedAt;

        return $this;
    }


    
}
