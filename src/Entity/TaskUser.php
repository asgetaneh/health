<?php

namespace App\Entity;

use App\Repository\TaskUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskUserRepository::class)
 */
class TaskUser
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=TaskAssign::class, inversedBy="taskUsers")
     */
    private $taskAssign;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="taskUsers")
     */
    private $assignedTo;

    /**
     * @ORM\OneToMany(targetEntity=TaskAccomplishment::class, mappedBy="taskUser")
     */
    private $taskAccomplishments;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity=StaffEvaluationBehaviorCriteria::class, mappedBy="taskUser")
     */
    private $staffEvaluationBehaviorCriterias;

    public function __construct()
    {
        $this->taskAccomplishments = new ArrayCollection();
        $this->staffEvaluationBehaviorCriterias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTaskAssign(): ?TaskAssign
    {
        return $this->taskAssign;
    }

    public function setTaskAssign(?TaskAssign $taskAssign): self
    {
        $this->taskAssign = $taskAssign;

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
            $taskAccomplishment->setTaskUser($this);
        }

        return $this;
    }

    public function removeTaskAccomplishment(TaskAccomplishment $taskAccomplishment): self
    {
        if ($this->taskAccomplishments->removeElement($taskAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($taskAccomplishment->getTaskUser() === $this) {
                $taskAccomplishment->setTaskUser(null);
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

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getType(): ?int
    {
        return $this->type;
    }

    public function setType(?int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|StaffEvaluationBehaviorCriteria[]
     */
    public function getStaffEvaluationBehaviorCriterias(): Collection
    {
        return $this->staffEvaluationBehaviorCriterias;
    }

    public function addStaffEvaluationBehaviorCriteria(StaffEvaluationBehaviorCriteria $staffEvaluationBehaviorCriteria): self
    {
        if (!$this->staffEvaluationBehaviorCriterias->contains($staffEvaluationBehaviorCriteria)) {
            $this->staffEvaluationBehaviorCriterias[] = $staffEvaluationBehaviorCriteria;
            $staffEvaluationBehaviorCriteria->setTaskUser($this);
        }

        return $this;
    }

    public function removeStaffEvaluationBehaviorCriteria(StaffEvaluationBehaviorCriteria $staffEvaluationBehaviorCriteria): self
    {
        if ($this->staffEvaluationBehaviorCriterias->removeElement($staffEvaluationBehaviorCriteria)) {
            // set the owning side to null (unless already changed)
            if ($staffEvaluationBehaviorCriteria->getTaskUser() === $this) {
                $staffEvaluationBehaviorCriteria->setTaskUser(null);
            }
        }

        return $this;
    }
}
