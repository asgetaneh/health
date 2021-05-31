<?php

namespace App\Entity;

use App\Repository\StaffEvaluationBehaviorCriteriaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StaffEvaluationBehaviorCriteriaRepository::class)
 */
class StaffEvaluationBehaviorCriteria
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
     * @ORM\Column(type="integer")
     */
    private $behavioralVariables;

    /**
     * @ORM\Column(type="integer")
     */
    private $total;

    /**
     * @ORM\ManyToOne(targetEntity=TaskUser::class, inversedBy="staffEvaluationBehaviorCriterias")
     */
    private $taskUser;

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

    public function getBehavioralVariables(): ?int
    {
        return $this->behavioralVariables;
    }

    public function setBehavioralVariables(int $behavioralVariables): self
    {
        $this->behavioralVariables = $behavioralVariables;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(int $total): self
    {
        $this->total = $total;

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
}
