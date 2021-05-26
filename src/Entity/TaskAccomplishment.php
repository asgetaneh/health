<?php

namespace App\Entity;

use App\Repository\TaskAccomplishmentRepository;
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
    private $OperationalValue;

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

    public function getOperationalValue(): ?int
    {
        return $this->OperationalValue;
    }

    public function setOperationalValue(?int $OperationalValue): self
    {
        $this->OperationalValue = $OperationalValue;

        return $this;
    }
}
