<?php

namespace App\Entity;

use App\Repository\OperationalInitiativeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationalInitiativeRepository::class)
 */
class OperationalInitiative
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=SuitableInitiative::class, inversedBy="operationalInitiatives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $initiative;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalOffice::class, inversedBy="operationalInitiatives")
     * @ORM\JoinColumn(nullable=false)
     */
    private $office;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInitiative(): ?SuitableInitiative
    {
        return $this->initiative;
    }

    public function setInitiative(?SuitableInitiative $initiative): self
    {
        $this->initiative = $initiative;

        return $this;
    }

    public function getOffice(): ?OperationalOffice
    {
        return $this->office;
    }

    public function setOffice(?OperationalOffice $office): self
    {
        $this->office = $office;

        return $this;
    }
}
