<?php

namespace App\Entity;

use App\Repository\TaskAccomplishmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TaskAccomplishmentRepository::class)
 */
class TaskAccomplishment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

   

    /**
     * @ORM\ManyToOne(targetEntity=TaskMeasurement::class, inversedBy="taskAccomplishments")
     */
    private $measurement;

    /**
     * @ORM\Column(type="integer")
     */
    private $expectedValue;

    /**
     * @ORM\Column(type="integer",nullable=true)
     */
    private $accomplishmentValue;

    

    /**
     * @ORM\ManyToOne(targetEntity=TaskUser::class, inversedBy="taskAccomplishments")
     */
    private $taskUser;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $measureDescription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reportedValue;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reportedAt;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="taskAccomplishment")
     */
    private $evaluations;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $narrative;

    public function __construct()
    {
        $this->evaluations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

  

    public function getMeasurement(): ?TaskMeasurement
    {
        return $this->measurement;
    }

    public function setMeasurement(?TaskMeasurement $measurement): self
    {
        $this->measurement = $measurement;

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

    public function getAccomplishmentValue(): ?int
    {
        return $this->accomplishmentValue;
    }

    public function setAccomplishmentValue(int $accomplishmentValue): self
    {
        $this->accomplishmentValue = $accomplishmentValue;

        return $this;
    }

   

    public function getTaskUser(): ?TaskUser
    {
        return $this->taskUser;
    }

    public function setTaskUser(?TaskUser $taskUser): self
    {
        $this->taskUser = $taskUser;

        return $this;
    }

    public function getMeasureDescription(): ?string
    {
        return $this->measureDescription;
    }

    public function setMeasureDescription(?string $measureDescription): self
    {
        $this->measureDescription = $measureDescription;

        return $this;
    }

    public function getReportedValue(): ?int
    {
        return $this->reportedValue;
    }

    public function setReportedValue(?int $reportedValue): self
    {
        $this->reportedValue = $reportedValue;

        return $this;
    }

    public function getReportedAt(): ?string
    {
        return $this->reportedAt;
    }

    public function setReportedAt(?string $reportedAt): self
    {
        $this->reportedAt = $reportedAt;

        return $this;
    }

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setTaskAccomplishment($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getTaskAccomplishment() === $this) {
                $evaluation->setTaskAccomplishment(null);
            }
        }

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
