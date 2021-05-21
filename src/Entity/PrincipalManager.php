<?php

namespace App\Entity;

use App\Repository\PrincipalManagerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrincipalManagerRepository::class)
 */
class PrincipalManager
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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="principalManagers")
     */
    private $principal;

    /**
     * @ORM\ManyToOne(targetEntity=PrincipalOffice::class, inversedBy="principalManagers")
     */
    private $principalOffice;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

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

    public function getPrincipal(): ?User
    {
        return $this->principal;
    }

    public function setPrincipal(?User $principal): self
    {
        $this->principal = $principal;

        return $this;
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
