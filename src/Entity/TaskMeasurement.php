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

    /**
     * @ORM\Column(type="integer")
     */
    private $expectedValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $outPutValue;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $correctValue;

    /**
     * @ORM\OneToMany(targetEntity=TaskAssign::class, mappedBy="measurment")
     */
    private $taskAssigns;

    public function __construct()
    {
        $this->taskAccomplishments = new ArrayCollection();
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



    public function getExpectedValue(): ?int
    {
        return $this->expectedValue;
    }

    public function setExpectedValue(int $expectedValue): self
    {
        $this->expectedValue = $expectedValue;

        return $this;
    }

    public function getOutPutValue(): ?int
    {
        return $this->outPutValue;
    }

    public function setOutPutValue(?int $outPutValue): self
    {
        $this->outPutValue = $outPutValue;

        return $this;
    }

    public function getCorrectValue(): ?int
    {
        return $this->correctValue;
    }

    public function setCorrectValue(?int $correctValue): self
    {
        $this->correctValue = $correctValue;

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
            $taskAssign->setMeasurment($this);
        }

        return $this;
    }

    public function removeTaskAssign(TaskAssign $taskAssign): self
    {
        if ($this->taskAssigns->removeElement($taskAssign)) {
            // set the owning side to null (unless already changed)
            if ($taskAssign->getMeasurment() === $this) {
                $taskAssign->setMeasurment(null);
            }
        }

        return $this;
    }
}
