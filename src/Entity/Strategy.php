<?php

namespace App\Entity;

use App\Repository\StrategyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StrategyRepository::class)
 */
class Strategy
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
    private $isActive;

    /**
     * @ORM\ManyToOne(targetEntity=Objective::class, inversedBy="strategies")
     */
    private $objective;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="strategies")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=KeyPerformanceIndicator::class, mappedBy="strategy")
     */
    private $keyPerformanceIndicators;
    public function __toString()
    {
        return $this->name;
    }
    public function __construct()
    {
        $this->keyPerformanceIndicators = new ArrayCollection();
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    public function getObjective(): ?Objective
    {
        return $this->objective;
    }

    public function setObjective(?Objective $objective): self
    {
        $this->objective = $objective;

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

    /**
     * @return Collection|KeyPerformanceIndicator[]
     */
    public function getKeyPerformanceIndicators(): Collection
    {
        return $this->keyPerformanceIndicators;
    }

    public function addKeyPerformanceIndicator(KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        if (!$this->keyPerformanceIndicators->contains($keyPerformanceIndicator)) {
            $this->keyPerformanceIndicators[] = $keyPerformanceIndicator;
            $keyPerformanceIndicator->setStrategy($this);
        }

        return $this;
    }

    public function removeKeyPerformanceIndicator(KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        if ($this->keyPerformanceIndicators->removeElement($keyPerformanceIndicator)) {
            // set the owning side to null (unless already changed)
            if ($keyPerformanceIndicator->getStrategy() === $this) {
                $keyPerformanceIndicator->setStrategy(null);
            }
        }

        return $this;
    }
}
