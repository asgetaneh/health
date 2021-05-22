<?php

namespace App\Entity;

use App\Repository\PerformerTaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerformerTaskRepository::class)
 */
class PerformerTask
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
     * @ORM\ManyToOne(targetEntity=OperationalTask::class, inversedBy="performerTasks")
     */
    private $operationalTask;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $startDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $endDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $timeGap;

    /**
     * @ORM\OneToMany(targetEntity=TaskAssign::class, mappedBy="PerformerTask")
     */
    private $taskAssigns;

    public function __construct()
    {
        $this->taskAssigns = new ArrayCollection();
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

    public function getOperationalTask(): ?OperationalTask
    {
        return $this->operationalTask;
    }

    public function setOperationalTask(?OperationalTask $operationalTask): self
    {
        $this->operationalTask = $operationalTask;

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

    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function setEndDate(string $endDate): self
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
            $taskAssign->setPerformerTask($this);
        }

        return $this;
    }

    public function removeTaskAssign(TaskAssign $taskAssign): self
    {
        if ($this->taskAssigns->removeElement($taskAssign)) {
            // set the owning side to null (unless already changed)
            if ($taskAssign->getPerformerTask() === $this) {
                $taskAssign->setPerformerTask(null);
            }
        }

        return $this;
    }
}
