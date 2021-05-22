<?php

namespace App\Entity;

use App\Repository\ObjectiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjectiveRepository::class)
 */
class Objective
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
     * @ORM\Column(type="string", length=255)
     */
    private $outPut;

    /**
     * @ORM\Column(type="text")
     */
    private $outCome;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="objectives")
     */
    private $CreatedBy;

    /**
     * @ORM\ManyToOne(targetEntity=Perspective::class, inversedBy="objectives")
     */
    private $perspective;

    /**
     * @ORM\ManyToOne(targetEntity=Goal::class, inversedBy="objectives")
     */
    private $goal;

    /**
     * @ORM\OneToMany(targetEntity=Strategy::class, mappedBy="objective")
     */
    private $strategies;

    public function __construct()
    {
        $this->strategies = new ArrayCollection();
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

    public function getOutPut(): ?string
    {
        return $this->outPut;
    }

    public function setOutPut(string $outPut): self
    {
        $this->outPut = $outPut;

        return $this;
    }

    public function getOutCome(): ?string
    {
        return $this->outCome;
    }

    public function setOutCome(string $outCome): self
    {
        $this->outCome = $outCome;

        return $this;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

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
        return $this->CreatedBy;
    }

    public function setCreatedBy(?User $CreatedBy): self
    {
        $this->CreatedBy = $CreatedBy;

        return $this;
    }

    public function getPerspective(): ?Perspective
    {
        return $this->perspective;
    }

    public function setPerspective(?Perspective $perspective): self
    {
        $this->perspective = $perspective;

        return $this;
    }

    public function getGoal(): ?Goal
    {
        return $this->goal;
    }

    public function setGoal(?Goal $goal): self
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * @return Collection|Strategy[]
     */
    public function getStrategies(): Collection
    {
        return $this->strategies;
    }

    public function addStrategy(Strategy $strategy): self
    {
        if (!$this->strategies->contains($strategy)) {
            $this->strategies[] = $strategy;
            $strategy->setObjective($this);
        }

        return $this;
    }

    public function removeStrategy(Strategy $strategy): self
    {
        if ($this->strategies->removeElement($strategy)) {
            // set the owning side to null (unless already changed)
            if ($strategy->getObjective() === $this) {
                $strategy->setObjective(null);
            }
        }

        return $this;
    }
}
