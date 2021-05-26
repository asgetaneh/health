<?php

namespace App\Entity;

use App\Repository\SuitableInitiativeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuitableInitiativeRepository::class)
 */
class SuitableInitiative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PrincipalOffice::class, inversedBy="suitableInitiatives")
     */
    private $principalOffice;

    /**
     * @ORM\ManyToOne(targetEntity=Initiative::class, inversedBy="suitableInitiatives")
     */
    private $initiative;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="suitableInitiatives")
     */
    private $planningYear;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrincipalOffice(): ?PrincipalOffice
    {
        return $this->principalOffice;
    }

    public function setPrincipalOffice(?PrincipalOffice $principalOffice): self
    {
        $this->principalOffice = $principalOffice;

        return $this;
    }

    public function getInitiative(): ?Initiative
    {
        return $this->initiative;
    }

    public function setInitiative(?Initiative $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getPlanningYear(): ?PlanningYear
    {
        return $this->planningYear;
    }

    public function setPlanningYear(?PlanningYear $planningYear): self
    {
        $this->planningYear = $planningYear;

        return $this;
    }
}
