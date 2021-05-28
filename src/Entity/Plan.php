<?php

namespace App\Entity;

use App\Repository\PlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanRepository::class)
 */
class Plan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\ManyToOne(targetEntity=PlanningPhase::class, inversedBy="plans")
     */
    private $planningPhase;

    /**
     * @ORM\ManyToOne(targetEntity=Initiative::class, inversedBy="plans")
     */
    private $initiative;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="plans")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=OperationalTask::class, mappedBy="plan")
     */
    private $operationalTasks;

    /**
     * @ORM\OneToMany(targetEntity=BehavioralPlanningAccomplishment::class, mappedBy="plan")
     */
    private $behavioralPlanningAccomplishments;

    /**
     * @ORM\ManyToOne(targetEntity=PrincipalOffice::class, inversedBy="plans")
     */
    private $office;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="plans")
     */
    private $quarter;

    /**

     * @ORM\Column(type="boolean")
     */
    private $isActive=0;

    /**
     * @ORM\ManyToOne(targetEntity=SuitableInitiative::class, inversedBy="plans")
     */
    private $suitableInitiative;
      /*
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="plan")
     */
    private $performerTasks;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;


    public function __construct()
    {
        $this->operationalTasks = new ArrayCollection();
        $this->behavioralPlanningAccomplishments = new ArrayCollection();
        $this->performerTasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    

    public function getPlanningPhase(): ?PlanningPhase
    {
        return $this->planningPhase;
    }

    public function setPlanningPhase(?PlanningPhase $planningPhase): self
    {
        $this->planningPhase = $planningPhase;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection|OperationalTask[]
     */
    public function getOperationalTasks(): Collection
    {
        return $this->operationalTasks;
    }

    public function addOperationalTask(OperationalTask $operationalTask): self
    {
        if (!$this->operationalTasks->contains($operationalTask)) {
            $this->operationalTasks[] = $operationalTask;
            $operationalTask->setPlan($this);
        }

        return $this;
    }

    public function removeOperationalTask(OperationalTask $operationalTask): self
    {
        if ($this->operationalTasks->removeElement($operationalTask)) {
            // set the owning side to null (unless already changed)
            if ($operationalTask->getPlan() === $this) {
                $operationalTask->setPlan(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|BehavioralPlanningAccomplishment[]
     */
    public function getBehavioralPlanningAccomplishments(): Collection
    {
        return $this->behavioralPlanningAccomplishments;
    }

    public function addBehavioralPlanningAccomplishment(BehavioralPlanningAccomplishment $behavioralPlanningAccomplishment): self
    {
        if (!$this->behavioralPlanningAccomplishments->contains($behavioralPlanningAccomplishment)) {
            $this->behavioralPlanningAccomplishments[] = $behavioralPlanningAccomplishment;
            $behavioralPlanningAccomplishment->setPlan($this);
        }

        return $this;
    }

    public function removeBehavioralPlanningAccomplishment(BehavioralPlanningAccomplishment $behavioralPlanningAccomplishment): self
    {
        if ($this->behavioralPlanningAccomplishments->removeElement($behavioralPlanningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($behavioralPlanningAccomplishment->getPlan() === $this) {
                $behavioralPlanningAccomplishment->setPlan(null);
            }
        }

        return $this;
    }

    public function getOffice(): ?PrincipalOffice
    {
        return $this->office;
    }

    public function setOffice(?PrincipalOffice $office): self
    {
        $this->office = $office;

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


    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
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
            $performerTask->setPlan($this);
        }
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

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getPlan() === $this) {
                $performerTask->setPlan(null);
            }
        }

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
