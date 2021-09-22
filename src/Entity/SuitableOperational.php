<?php

namespace App\Entity;

use App\Repository\SuitableOperationalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuitableOperationalRepository::class)
 */
class SuitableOperational
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SuitableInitiative::class, inversedBy="suitableOperationals")
     */
    private $suitableInitiative;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalOffice::class, inversedBy="suitableOperationals")
     */
    private $operationalOffice;

    /**
     * @ORM\OneToMany(targetEntity=OperationalPlanningAccomplishment::class, mappedBy="operationalSuitable")
     */
    private $planValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $denimonator;

    public function __construct()
    {
        $this->planValue = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOperationalOffice(): ?OperationalOffice
    {
        return $this->operationalOffice;
    }

    public function setOperationalOffice(?OperationalOffice $operationalOffice): self
    {
        $this->operationalOffice = $operationalOffice;

        return $this;
    }

    /**
     * @return Collection|OperationalPlanningAccomplishment[]
     */
    public function getPlanValue(): Collection
    {
        return $this->planValue;
    }

    public function addPlanValue(OperationalPlanningAccomplishment $planValue): self
    {
        if (!$this->planValue->contains($planValue)) {
            $this->planValue[] = $planValue;
            $planValue->setOperationalSuitable($this);
        }

        return $this;
    }

    public function removePlanValue(OperationalPlanningAccomplishment $planValue): self
    {
        if ($this->planValue->removeElement($planValue)) {
            // set the owning side to null (unless already changed)
            if ($planValue->getOperationalSuitable() === $this) {
                $planValue->setOperationalSuitable(null);
            }
        }

        return $this;
    }

    public function getDenimonator(): ?int
    {
        return $this->denimonator;
    }

    public function setDenimonator(?int $denimonator): self
    {
        $this->denimonator = $denimonator;

        return $this;
    }
}
