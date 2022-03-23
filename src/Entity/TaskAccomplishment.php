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
     * @ORM\Column(type="text", nullable=true)
     */
    private $measureDescription;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reportedValue;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $reportedAt;

    /**
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="taskAccomplishment")
     */
    private $evaluations;

  

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $expectedValueSocial;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $reportedValueSocial;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accomplishmentValueSocial;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $type;

  

    /**
     * @ORM\OneToOne(targetEntity=TaskAssign::class, cascade={"persist", "remove"})
     */
    private $taskAssign;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $taskDoneDescription;


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



   

    public function getMeasureDescription(): ?string
    {
        return $this->measureDescription;
    }

    public function setMeasureDescription(?string $measureDescription): self
    {
        $this->measureDescription = $measureDescription;

        return $this;
    }

    public function getReportedValue(): ?string
    {
        return $this->reportedValue;
    }

    public function setReportedValue(?string $reportedValue): self
    {
        $this->reportedValue = $reportedValue;

        return $this;
    }

    public function getReportedAt(): ?\DateTimeInterface
    {
        return $this->reportedAt;
    }

    public function setReportedAt(\DateTimeInterface $reportedAt): self
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

   

    public function getExpectedValueSocial(): ?int
    {
        return $this->expectedValueSocial;
    }

    public function setExpectedValueSocial(?int $expectedValueSocial): self
    {
        $this->expectedValueSocial = $expectedValueSocial;

        return $this;
    }

    public function getReportedValueSocial(): ?int
    {
        return $this->reportedValueSocial;
    }

    public function setReportedValueSocial(?int $reportedValueSocial): self
    {
        $this->reportedValueSocial = $reportedValueSocial;

        return $this;
    }

    public function getAccomplishmentValueSocial(): ?int
    {
        return $this->accomplishmentValueSocial;
    }

    public function setAccomplishmentValueSocial(?int $accomplishmentValueSocial): self
    {
        $this->accomplishmentValueSocial = $accomplishmentValueSocial;

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

 

  
    public function getTaskAssign(): ?TaskAssign
    {
        return $this->taskAssign;
    }

    public function setTaskAssign(?TaskAssign $taskAssign): self
    {
        $this->taskAssign = $taskAssign;

        return $this;
    }

    public function getTaskDoneDescription(): ?string
    {
        return $this->taskDoneDescription;
    }

    public function setTaskDoneDescription(?string $taskDoneDescription): self
    {
        $this->taskDoneDescription = $taskDoneDescription;

        return $this;
    }

  
}
