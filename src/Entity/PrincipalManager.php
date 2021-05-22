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
    private $isActive = 0;

    public function getId(): ?int
    {
        return $this->id;
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
