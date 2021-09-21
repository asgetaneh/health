<?php

namespace App\Entity;

use App\Repository\OperationalPlanningAccomplishmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationalPlanningAccomplishmentRepository::class)
 */
class OperationalPlanningAccomplishment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SuitableOperational::class, inversedBy="planValue")
     */
    private $operationalSuitable;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $planValue;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accompValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="operationalPlanningAcc")
     */
    private $performerTasks;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="operationalPlanningAccSocial")
     */
    private $performerTasksSocial;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="operationalPlanningAccomplishments")
     */
    private $quarter;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="operationalPlanningAccomplishments")
     */
    private $socialAttribute;

    public function __construct()
    {
        $this->performerTasks = new ArrayCollection();
        $this->performerTasksSocial = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOperationalSuitable(): ?SuitableOperational
    {
        return $this->operationalSuitable;
    }

    public function setOperationalSuitable(?SuitableOperational $operationalSuitable): self
    {
        $this->operationalSuitable = $operationalSuitable;

        return $this;
    }

    public function getPlanValue(): ?int
    {
        return $this->planValue;
    }

    public function setPlanValue(?int $planValue): self
    {
        $this->planValue = $planValue;

        return $this;
    }

    public function getAccompValue(): ?float
    {
        return $this->accompValue;
    }

    public function setAccompValue(?float $accompValue): self
    {
        $this->accompValue = $accompValue;

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
     * @return Collection|PerformerTask[]
     */
    public function getPerformerTasks(): Collection
    {
        return $this->performerTasks;
    }

    public function addPerformerTask(PerformerTask $performerTask): self
    {
        if (!$this->performerTasks->contains($performerTask)) {
            $this->performerTasks[] = $performerTask;
            $performerTask->setOperationalPlanningAcc($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getOperationalPlanningAcc() === $this) {
                $performerTask->setOperationalPlanningAcc(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PerformerTask[]
     */
    public function getPerformerTasksSocial(): Collection
    {
        return $this->performerTasksSocial;
    }

    public function addPerformerTasksSocial(PerformerTask $performerTasksSocial): self
    {
        if (!$this->performerTasksSocial->contains($performerTasksSocial)) {
            $this->performerTasksSocial[] = $performerTasksSocial;
            $performerTasksSocial->setOperationalPlanningAccSocial($this);
        }

        return $this;
    }

    public function removePerformerTasksSocial(PerformerTask $performerTasksSocial): self
    {
        if ($this->performerTasksSocial->removeElement($performerTasksSocial)) {
            // set the owning side to null (unless already changed)
            if ($performerTasksSocial->getOperationalPlanningAccSocial() === $this) {
                $performerTasksSocial->setOperationalPlanningAccSocial(null);
            }
        }

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
}
