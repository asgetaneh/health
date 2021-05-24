<?php

namespace App\Entity;

use App\Repository\PlanningQuarterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningQuarterRepository::class)
 */
class PlanningQuarter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="planningQuarters")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToMany(targetEntity=PlanningPhase::class, mappedBy="quarter")
     */
    private $planningPhases;

    /**
     * @ORM\OneToMany(targetEntity=Plan::class, mappedBy="quarter")
     */
    private $plans;

    /**
     * @ORM\OneToMany(targetEntity=OperationalTask::class, mappedBy="quarter")
     */
    private $operationalTasks;

    public function __construct()
    {
        $this->planningPhases = new ArrayCollection();
        $this->plans = new ArrayCollection();
        $this->operationalTasks = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|PlanningPhase[]
     */
    public function getPlanningPhases(): Collection
    {
        return $this->planningPhases;
    }

    public function addPlanningPhase(PlanningPhase $planningPhase): self
    {
        if (!$this->planningPhases->contains($planningPhase)) {
            $this->planningPhases[] = $planningPhase;
            $planningPhase->addQuarter($this);
        }

        return $this;
    }

    public function removePlanningPhase(PlanningPhase $planningPhase): self
    {
        if ($this->planningPhases->removeElement($planningPhase)) {
            $planningPhase->removeQuarter($this);
        }

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlans(): Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans[] = $plan;
            $plan->setQuarter($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getQuarter() === $this) {
                $plan->setQuarter(null);
            }
        }

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
            $operationalTask->setQuarter($this);
        }

        return $this;
    }

    public function removeOperationalTask(OperationalTask $operationalTask): self
    {
        if ($this->operationalTasks->removeElement($operationalTask)) {
            // set the owning side to null (unless already changed)
            if ($operationalTask->getQuarter() === $this) {
                $operationalTask->setQuarter(null);
            }
        }

        return $this;
    }
}
