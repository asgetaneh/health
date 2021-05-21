<?php

namespace App\Entity;

use App\Repository\TaskMeasurementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskMeasurementRepository::class)
 */
class TaskMeasurement
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
     * @ORM\OneToMany(targetEntity=TaskAccomplishment::class, mappedBy="measurement")
     */
    private $taskAccomplishments;

    public function __construct()
    {
        $this->taskAccomplishments = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $taskAccomplishment->setMeasurement($this);
        }

        return $this;
    }

    public function removeTaskAccomplishment(TaskAccomplishment $taskAccomplishment): self
    {
        if ($this->taskAccomplishments->removeElement($taskAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($taskAccomplishment->getMeasurement() === $this) {
                $taskAccomplishment->setMeasurement(null);
            }
        }

        return $this;
    }
}
