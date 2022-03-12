<?php

namespace App\Entity;

use App\Repository\TaskCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskCategoryRepository::class)
 */
class TaskCategory
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfTask;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isCore;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="taskCategory")
     */
    private $performerTasks;

    public function __construct()
    {
        $this->performerTasks = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNumberOfTask(): ?int
    {
        return $this->numberOfTask;
    }

    public function setNumberOfTask(int $numberOfTask): self
    {
        $this->numberOfTask = $numberOfTask;

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

    public function getIsCore(): ?bool
    {
        return $this->isCore;
    }

    public function setIsCore(bool $isCore): self
    {
        $this->isCore = $isCore;

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
            $performerTask->setTaskCategory($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getTaskCategory() === $this) {
                $performerTask->setTaskCategory(null);
            }
        }

        return $this;
    }

   
}
