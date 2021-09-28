<?php

namespace App\Entity;

use App\Repository\PrincipalOfficeGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrincipalOfficeGroupRepository::class)
 */
class PrincipalOfficeGroup
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PrincipalOffice::class, mappedBy="officeGroup")
     */
    private $principalOffices;

    public function __construct()
    {
        $this->principalOffices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
 public function __toString()
  {
      return $this->name;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|PrincipalOffice[]
     */
    public function getPrincipalOffices(): Collection
    {
        return $this->principalOffices;
    }

    public function addPrincipalOffice(PrincipalOffice $principalOffice): self
    {
        if (!$this->principalOffices->contains($principalOffice)) {
            $this->principalOffices[] = $principalOffice;
            $principalOffice->setOfficeGroup($this);
        }

        return $this;
    }

    public function removePrincipalOffice(PrincipalOffice $principalOffice): self
    {
        if ($this->principalOffices->removeElement($principalOffice)) {
            // set the owning side to null (unless already changed)
            if ($principalOffice->getOfficeGroup() === $this) {
                $principalOffice->setOfficeGroup(null);
            }
        }

        return $this;
    }
}
