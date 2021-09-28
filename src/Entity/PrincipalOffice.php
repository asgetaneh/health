<?php

namespace App\Entity;

use App\Repository\PrincipalOfficeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrincipalOfficeRepository::class)
 */
class PrincipalOffice
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
     * @ORM\Column(type="boolean")
     */
    private $isActive=1;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="principalOffices")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=OperationalOffice::class, mappedBy="principalOffice")
     */
    private $operationalOffices;

    /**
     * @ORM\OneToMany(targetEntity=PrincipalManager::class, mappedBy="principalOffice")
     */
    private $principalManagers;

    /**
     * @ORM\ManyToMany(targetEntity=Initiative::class, mappedBy="principalOffice")
     */
    private $initiatives;

    /**
     * @ORM\OneToMany(targetEntity=Plan::class, mappedBy="office")
     */
    private $plans;

    /**
     * @ORM\OneToMany(targetEntity=SuitableInitiative::class, mappedBy="principalOffice")
     */
    private $suitableInitiatives;

    /**
     * @ORM\ManyToOne(targetEntity=PrincipalOfficeGroup::class, inversedBy="principalOffices")
     */
    private $officeGroup;

    public function __construct()
    {
        $this->operationalOffices = new ArrayCollection();
        $this->principalManagers = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
        $this->plans = new ArrayCollection();
        $this->suitableInitiatives = new ArrayCollection();
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): self
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

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
     * @return Collection|OperationalOffice[]
     */
    public function getOperationalOffices(): Collection
    {
        return $this->operationalOffices;
    }

    public function addOperationalOffice(OperationalOffice $operationalOffice): self
    {
        if (!$this->operationalOffices->contains($operationalOffice)) {
            $this->operationalOffices[] = $operationalOffice;
            $operationalOffice->setPrincipalOffice($this);
        }

        return $this;
    }

    public function removeOperationalOffice(OperationalOffice $operationalOffice): self
    {
        if ($this->operationalOffices->removeElement($operationalOffice)) {
            // set the owning side to null (unless already changed)
            if ($operationalOffice->getPrincipalOffice() === $this) {
                $operationalOffice->setPrincipalOffice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrincipalManager[]
     */
    public function getPrincipalManagers(): Collection
    {
        return $this->principalManagers;
    }

    public function addPrincipalManager(PrincipalManager $principalManager): self
    {
        if (!$this->principalManagers->contains($principalManager)) {
            $this->principalManagers[] = $principalManager;
            $principalManager->setPrincipalOffice($this);
        }

        return $this;
    }

    public function removePrincipalManager(PrincipalManager $principalManager): self
    {
        if ($this->principalManagers->removeElement($principalManager)) {
            // set the owning side to null (unless already changed)
            if ($principalManager->getPrincipalOffice() === $this) {
                $principalManager->setPrincipalOffice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Initiative[]
     */
    public function getInitiatives(): Collection
    {
        return $this->initiatives;
    }

    public function addInitiative(Initiative $initiative): self
    {
        if (!$this->initiatives->contains($initiative)) {
            $this->initiatives[] = $initiative;
            $initiative->addPrincipalOffice($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->removeElement($initiative)) {
            $initiative->removePrincipalOffice($this);
        }

        return $this;
    }

    /**
     * @return Collection|Plan[]
     */
    public function getPlans(): Collection
    {
        return $this->plans;
    }

    public function addPlan(Plan $plan): self
    {
        if (!$this->plans->contains($plan)) {
            $this->plans[] = $plan;
            $plan->setOffice($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getOffice() === $this) {
                $plan->setOffice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SuitableInitiative[]
     */
    public function getSuitableInitiatives(): Collection
    {
        return $this->suitableInitiatives;
    }

    public function addSuitableInitiative(SuitableInitiative $suitableInitiative): self
    {
        if (!$this->suitableInitiatives->contains($suitableInitiative)) {
            $this->suitableInitiatives[] = $suitableInitiative;
            $suitableInitiative->setPrincipalOffice($this);
        }

        return $this;
    }

    public function removeSuitableInitiative(SuitableInitiative $suitableInitiative): self
    {
        if ($this->suitableInitiatives->removeElement($suitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($suitableInitiative->getPrincipalOffice() === $this) {
                $suitableInitiative->setPrincipalOffice(null);
            }
        }

        return $this;
    }

    public function getOfficeGroup(): ?PrincipalOfficeGroup
    {
        return $this->officeGroup;
    }

    public function setOfficeGroup(?PrincipalOfficeGroup $officeGroup): self
    {
        $this->officeGroup = $officeGroup;

        return $this;
    }
}
