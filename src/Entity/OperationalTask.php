<?php

namespace App\Entity;

use App\Repository\OperationalTaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationalTaskRepository::class)
 */
class OperationalTask
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
    private $taskName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Plan::class, inversedBy="operationalTasks")
     */
    private $plan;

   

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="operationalTask")
     */
    private $performerTasks;

    /**
     * @ORM\OneToMany(targetEntity=TaskAssign::class, mappedBy="operationalTask")
     */
    private $taskAssigns;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operationalTasks")
     */
    private $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="operationalTasks")
     */
    private $quarter;
    public function __toString()
    {
        return $this->taskName;
    }
    public function __construct()
    {
        $this->performerTasks = new ArrayCollection();
        $this->taskAssigns = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskName(): ?string
    {
        return $this->taskName;
    }

    public function setTaskName(string $taskName): self
    {
        $this->taskName = $taskName;

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

    public function getPlan(): ?Plan
    {
        return $this->plan;
    }

    public function setPlan(?Plan $plan): self
    {
        $this->plan = $plan;

        return $this;
    }


    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

  

    /**
     * @return Collection|TaskAssign[]
     */
    public function getTaskAssigns(): Collection
    {
        return $this->taskAssigns;
    }

    public function addTaskAssign(TaskAssign $taskAssign): self
    {
        if (!$this->taskAssigns->contains($taskAssign)) {
            $this->taskAssigns[] = $taskAssign;
            $taskAssign->setOperationalTask($this);
        }

        return $this;
    }

    public function removeTaskAssign(TaskAssign $taskAssign): self
    {
        if ($this->taskAssigns->removeElement($taskAssign)) {
            // set the owning side to null (unless already changed)
            if ($taskAssign->getOperationalTask() === $this) {
                $taskAssign->setOperationalTask(null);
            }
        }

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

    public function getQuarter(): ?PlanningQuarter
    {
        return $this->quarter;
    }

    public function setQuarter(?PlanningQuarter $quarter): self
    {
        $this->quarter = $quarter;

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
            $performerTask->setOperationalTask($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getOperationalTask() === $this) {
                $performerTask->setOperationalTask(null);
            }
        }

        return $this;
    }
}
