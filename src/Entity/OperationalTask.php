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
     * @ORM\Column(type="date")
     */
    private $startDate;
  /**
     * @ORM\Column(type="date")
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $timeGap;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getTimeGap(): ?int
    {
        return $this->timeGap;
    }

    public function setTimeGap(int $timeGap): self
    {
        $this->timeGap = $timeGap;

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
}
