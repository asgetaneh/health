<?php

namespace App\Entity;

use App\Repository\TaskAssignRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskAssignRepository::class)
 */
class TaskAssign
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalTask::class, inversedBy="taskAssigns")
     */
    private $operationalTask;

    /**
     * @ORM\ManyToOne(targetEntity=PerformerTask::class, inversedBy="taskAssigns")
     */
    private $PerformerTask;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="taskAssigns")
     */
    private $assignedBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $assignedAt;

    /**
     * @ORM\OneToMany(targetEntity=TaskAccomplishment::class, mappedBy="taskAssign")
     */
    private $taskAccomplishments;

    /**
     * @ORM\OneToMany(targetEntity=TaskMeasurement::class, mappedBy="taskAssign")
     */
    private $taskMeasurements;

   

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="taskAssignsTo")
     */
    private $assignedTo;

    /**
     * @ORM\OneToMany(targetEntity=TaskUser::class, mappedBy="taskAssign")
     */
    private $taskUsers;

    public function __construct()
    {
        $this->taskAccomplishments = new ArrayCollection();
        $this->taskMeasurements = new ArrayCollection();
        $this->taskUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPerformerTask(): ?PerformerTask
    {
        return $this->PerformerTask;
    }

    public function setPerformerTask(?PerformerTask $PerformerTask): self
    {
        $this->PerformerTask = $PerformerTask;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getAssignedBy(): ?User
    {
        return $this->assignedBy;
    }

    public function setAssignedBy(?User $assignedBy): self
    {
        $this->assignedBy = $assignedBy;

        return $this;
    }

    public function getAssignedAt(): ?\DateTimeInterface
    {
        return $this->assignedAt;
    }

    public function setAssignedAt(\DateTimeInterface $assignedAt): self
    {
        $this->assignedAt = $assignedAt;

        return $this;
    }

   

    
    public function getAssignedTo(): ?User
    {
        return $this->assignedTo;
    }

    public function setAssignedTo(?User $assignedTo): self
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    /**
     * @return Collection|TaskUser[]
     */
    public function getTaskUsers(): Collection
    {
        return $this->taskUsers;
    }

    public function addTaskUser(TaskUser $taskUser): self
    {
        if (!$this->taskUsers->contains($taskUser)) {
            $this->taskUsers[] = $taskUser;
            $taskUser->setTaskAssign($this);
        }

        return $this;
    }

    public function removeTaskUser(TaskUser $taskUser): self
    {
        if ($this->taskUsers->removeElement($taskUser)) {
            // set the owning side to null (unless already changed)
            if ($taskUser->getTaskAssign() === $this) {
                $taskUser->setTaskAssign(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TaskAccomplishment[]
     */
    public function getTaskAccomplishments(): Collection
    {
        return $this->taskAccomplishments;
    }

    public function addTaskAccomplishment(TaskAccomplishment $taskAccomplishment): self
    {
        if (!$this->taskAccomplishments->contains($taskAccomplishment)) {
            $this->taskAccomplishments[] = $taskAccomplishment;
            $taskAccomplishment->setTaskAssign($this);
        }

        return $this;
    }

    public function removeTaskAccomplishment(TaskAccomplishment $taskAccomplishment): self
    {
        if ($this->taskAccomplishments->removeElement($taskAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($taskAccomplishment->getTaskAssign() === $this) {
                $taskAccomplishment->setTaskAssign(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|TaskMeasurement[]
     */
    public function getTaskMeasurements(): Collection
    {
        return $this->taskMeasurements;
    }

    public function addTaskMeasurement(TaskMeasurement $taskMeasurement): self
    {
        if (!$this->taskMeasurements->contains($taskMeasurement)) {
            $this->taskMeasurements[] = $taskMeasurement;
            $taskMeasurement->setTaskAssign($this);
        }

        return $this;
    }

    public function removeTaskMeasurement(TaskMeasurement $taskMeasurement): self
    {
        if ($this->taskMeasurements->removeElement($taskMeasurement)) {
            // set the owning side to null (unless already changed)
            if ($taskMeasurement->getTaskAssign() === $this) {
                $taskMeasurement->setTaskAssign(null);
            }
        }

        return $this;
    }

   
}
