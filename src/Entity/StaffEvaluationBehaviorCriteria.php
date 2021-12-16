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

   

   
}
