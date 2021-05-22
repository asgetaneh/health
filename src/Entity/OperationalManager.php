<?php

namespace App\Entity;

use App\Repository\OperationalManagerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationalManagerRepository::class)
 */
class OperationalManager
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operationalManagers")
     */
    private $manager;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalOffice::class, inversedBy="operationalManagers")
     */
    private $operationalOffice;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getOperationalOffice(): ?OperationalOffice
    {
        return $this->operationalOffice;
    }

    public function setOperationalOffice(?OperationalOffice $operationalOffice): self
    {
        $this->operationalOffice = $operationalOffice;

        return $this;
    }
}
