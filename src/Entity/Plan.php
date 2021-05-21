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
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="plans")
     */
    private $planningYear;

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

    public function __construct()
    {
        $this->operationalTasks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlanningYear(): ?PlanningYear
    {
        return $this->planningYear;
    }

    public function setPlanningYear(?PlanningYear $planningYear): self
    {
        $this->planningYear = $planningYear;

        return $this;
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
}
