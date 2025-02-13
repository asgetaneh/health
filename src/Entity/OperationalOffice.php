<?php

namespace App\Entity;

use App\Repository\OperationalOfficeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OperationalOfficeRepository::class)
 */
class OperationalOffice
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
     * @ORM\ManyToOne(targetEntity=PrincipalOffice::class, inversedBy="operationalOffices")
     */
    private $principalOffice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="operationalOffices")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive=1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=OperationalManager::class, mappedBy="operationalOffice")
     */
    private $operationalManagers;

    /**
     * @ORM\OneToMany(targetEntity=Performer::class, mappedBy="operationalOffice")
     */
    private $performers;

    // /**
    //  * @ORM\ManyToMany(targetEntity=Initiative::class, mappedBy="operationalOffice")
    //  */
    // private $initiatives;

    /**
     * @ORM\OneToMany(targetEntity=OperationalInitiative::class, mappedBy="office")
     */
    private $operationalInitiatives;

    /**
     * @ORM\OneToMany(targetEntity=OperationalSuitableInitiative::class, mappedBy="operationalOffice")
     */
    private $operationalSuitableInitiatives;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="operationalOffice")
     */
    private $performerTasks;

    /**
     * @ORM\ManyToOne(targetEntity=College::class, inversedBy="operationalOffices")
     */
    private $college;

    /**
     * @ORM\OneToMany(targetEntity=SuitableOperational::class, mappedBy="operationalOffice")
     */
    private $suitableOperationals;
    
    public function __construct()
    {
        $this->operationalManagers = new ArrayCollection();
        $this->performers = new ArrayCollection();
        // $this->initiatives = new ArrayCollection();
        $this->operationalInitiatives = new ArrayCollection();
        $this->operationalSuitableInitiatives = new ArrayCollection();
        $this->performerTasks = new ArrayCollection();
        $this->suitableOperationals = new ArrayCollection();
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

    public function getPrincipalOffice(): ?PrincipalOffice
    {
        return $this->principalOffice;
    }

    public function setPrincipalOffice(?PrincipalOffice $principalOffice): self
    {
        $this->principalOffice = $principalOffice;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

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
     * @return Collection|OperationalManager[]
     */
    public function getOperationalManagers(): Collection
    {
        return $this->operationalManagers;
    }

    public function addOperationalManager(OperationalManager $operationalManager): self
    {
        if (!$this->operationalManagers->contains($operationalManager)) {
            $this->operationalManagers[] = $operationalManager;
            $operationalManager->setOperationalOffice($this);
        }

        return $this;
    }

    public function removeOperationalManager(OperationalManager $operationalManager): self
    {
        if ($this->operationalManagers->removeElement($operationalManager)) {
            // set the owning side to null (unless already changed)
            if ($operationalManager->getOperationalOffice() === $this) {
                $operationalManager->setOperationalOffice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Performer[]
     */
    public function getPerformers(): Collection
    {
        return $this->performers;
    }

    public function addPerformer(Performer $performer): self
    {
        if (!$this->performers->contains($performer)) {
            $this->performers[] = $performer;
            $performer->setOperationalOffice($this);
        }

        return $this;
    }

    public function removePerformer(Performer $performer): self
    {
        if ($this->performers->removeElement($performer)) {
            // set the owning side to null (unless already changed)
            if ($performer->getOperationalOffice() === $this) {
                $performer->setOperationalOffice(null);
            }
        }

        return $this;
    }

    // /**
    //  * @return Collection|Initiative[]
    //  */
    // public function getInitiatives(): Collection
    // {
    //     return $this->initiatives;
    // }

    // public function addInitiative(Initiative $initiative): self
    // {
    //     if (!$this->initiatives->contains($initiative)) {
    //         $this->initiatives[] = $initiative;
    //         $initiative->addOperationalOffice($this);
    //     }

    //     return $this;
    // }

    // public function removeInitiative(Initiative $initiative): self
    // {
    //     if ($this->initiatives->removeElement($initiative)) {
    //         $initiative->removeOperationalOffice($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection|OperationalInitiative[]
     */
    public function getOperationalInitiatives(): Collection
    {
        return $this->operationalInitiatives;
    }

    public function addOperationalInitiative(OperationalInitiative $operationalInitiative): self
    {
        if (!$this->operationalInitiatives->contains($operationalInitiative)) {
            $this->operationalInitiatives[] = $operationalInitiative;
            $operationalInitiative->setOffice($this);
        }

        return $this;
    }

    public function removeOperationalInitiative(OperationalInitiative $operationalInitiative): self
    {
        if ($this->operationalInitiatives->removeElement($operationalInitiative)) {
            // set the owning side to null (unless already changed)
            if ($operationalInitiative->getOffice() === $this) {
                $operationalInitiative->setOffice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OperationalSuitableInitiative[]
     */
    public function getOperationalSuitableInitiatives(): Collection
    {
        return $this->operationalSuitableInitiatives;
    }

    public function addOperationalSuitableInitiative(OperationalSuitableInitiative $operationalSuitableInitiative): self
    {
        if (!$this->operationalSuitableInitiatives->contains($operationalSuitableInitiative)) {
            $this->operationalSuitableInitiatives[] = $operationalSuitableInitiative;
            $operationalSuitableInitiative->setOperationalOffice($this);
        }

        return $this;
    }

    public function removeOperationalSuitableInitiative(OperationalSuitableInitiative $operationalSuitableInitiative): self
    {
        if ($this->operationalSuitableInitiatives->removeElement($operationalSuitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($operationalSuitableInitiative->getOperationalOffice() === $this) {
                $operationalSuitableInitiative->setOperationalOffice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PerformerTask[]
     */
    public function getPerformerTasks(): Collection
    {
        return $this->performerTasks;
    }

    public function addPerformerTask(PerformerTask $performerTask): self
    {
        if (!$this->performerTasks->contains($performerTask)) {
            $this->performerTasks[] = $performerTask;
            $performerTask->setOperationalOffice($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getOperationalOffice() === $this) {
                $performerTask->setOperationalOffice(null);
            }
        }

        return $this;
    }

    public function getCollege(): ?College
    {
        return $this->college;
    }

    public function setCollege(?College $college): self
    {
        $this->college = $college;

        return $this;
    }

    /**
     * @return Collection|SuitableOperational[]
     */
    public function getSuitableOperationals(): Collection
    {
        return $this->suitableOperationals;
    }

    public function addSuitableOperational(SuitableOperational $suitableOperational): self
    {
        if (!$this->suitableOperationals->contains($suitableOperational)) {
            $this->suitableOperationals[] = $suitableOperational;
            $suitableOperational->setOperationalOffice($this);
        }

        return $this;
    }

    public function removeSuitableOperational(SuitableOperational $suitableOperational): self
    {
        if ($this->suitableOperationals->removeElement($suitableOperational)) {
            // set the owning side to null (unless already changed)
            if ($suitableOperational->getOperationalOffice() === $this) {
                $suitableOperational->setOperationalOffice(null);
            }
        }

        return $this;
    }

    
}
