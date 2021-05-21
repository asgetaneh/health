<?php

namespace App\Entity;

use App\Repository\TaskAssignRepository;
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
}
