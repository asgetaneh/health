<?php

namespace App\Entity;

use App\Repository\InitiativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InitiativeRepository::class)
 */
class Initiative
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
     * @ORM\Column(type="float")
     */
    private $maximumValue;

    /**
     * @ORM\Column(type="float")
     */
    private $minimumValue;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeBehaviour::class, inversedBy="initiatives")
     */
    private $initiativeBehaviour;

    /**
     * @ORM\ManyToOne(targetEntity=KeyPerformanceIndicator::class, inversedBy="initiatives")
     */
    private $keyPerformanceIndicator;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="initiatives")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Plan::class, mappedBy="initiative")
     */
    private $plans;

    /**
     * @ORM\ManyToMany(targetEntity=PrincipalOffice::class, inversedBy="initiatives")
     */
    private $principalOffice;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isActive;

    public function __construct()
    {
        $this->plans = new ArrayCollection();
        $this->principalOffice = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getMaximumValue(): ?float
    {
        return $this->maximumValue;
    }

    public function setMaximumValue(float $maximumValue): self
    {
        $this->maximumValue = $maximumValue;

        return $this;
    }

    public function getMinimumValue(): ?float
    {
        return $this->minimumValue;
    }

    public function setMinimumValue(float $minimumValue): self
    {
        $this->minimumValue = $minimumValue;

        return $this;
    }

    public function getInitiativeBehaviour(): ?InitiativeBehaviour
    {
        return $this->initiativeBehaviour;
    }

    public function setInitiativeBehaviour(?InitiativeBehaviour $initiativeBehaviour): self
    {
        $this->initiativeBehaviour = $initiativeBehaviour;

        return $this;
    }

    public function getKeyPerformanceIndicator(): ?KeyPerformanceIndicator
    {
        return $this->keyPerformanceIndicator;
    }

    public function setKeyPerformanceIndicator(?KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        $this->keyPerformanceIndicator = $keyPerformanceIndicator;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $plan->setInitiative($this);
        }

        return $this;
    }

    public function removePlan(Plan $plan): self
    {
        if ($this->plans->removeElement($plan)) {
            // set the owning side to null (unless already changed)
            if ($plan->getInitiative() === $this) {
                $plan->setInitiative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrincipalOffice[]
     */
    public function getPrincipalOffice(): Collection
    {
        return $this->principalOffice;
    }

    public function addPrincipalOffice(PrincipalOffice $principalOffice): self
    {
        if (!$this->principalOffice->contains($principalOffice)) {
            $this->principalOffice[] = $principalOffice;
        }

        return $this;
    }

    public function removePrincipalOffice(PrincipalOffice $principalOffice): self
    {
        $this->principalOffice->removeElement($principalOffice);

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(?bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }
}
