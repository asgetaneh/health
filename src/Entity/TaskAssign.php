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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="taskAssignsDelegate")
     */
    private $delegate;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expectedValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expectedValueSocial;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $rejectReason;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $challenge;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $narrative;

    public function __construct()
    {
        $this->taskAccomplishments = new ArrayCollection();
        $this->taskMeasurements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

        return $this;}
    public function getStartDate(): ?string
    {
        return $this->startDate;
    }

    public function setStartDate(string $startDate): self
    {
        $this->startDate = $startDate;

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

    public function getDelegate(): ?User
    {
        return $this->delegate;
    }

    public function setDelegate(?User $delegate): self
    {
        $this->delegate = $delegate;

        return $this;
    }

    public function getExpectedValue(): ?int
    {
        return $this->expectedValue;
    }

    public function setExpectedValue(?int $expectedValue): self
    {
        $this->expectedValue = $expectedValue;

        return $this;
    }

    public function getExpectedValueSocial(): ?int
    {
        return $this->expectedValueSocial;
    }

    public function setExpectedValueSocial(?int $expectedValueSocial): self
    {
        $this->expectedValueSocial = $expectedValueSocial;

        return $this;
    }

    public function getRejectReason(): ?string
    {
        return $this->rejectReason;
    }

    public function setRejectReason(?string $rejectReason): self
    {
        $this->rejectReason = $rejectReason;

        return $this;
    }

    public function getChallenge(): ?string
    {
        return $this->challenge;
    }

    public function setChallenge(?string $challenge): self
    {
        $this->challenge = $challenge;

        return $this;
    }

    public function getNarrative(): ?string
    {
        return $this->narrative;
    }

    public function setNarrative(?string $narrative): self
    {
        $this->narrative = $narrative;

        return $this;
    }

   
}
