<?php

namespace App\Entity;

use App\Repository\PlanningYearRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningYearRepository::class)
 */
class PlanningYear
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $year;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive=1;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="planningYears")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=PlanningPhase::class, mappedBy="planningYear")
     */
    private $planningPhases;

    

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity=SuitableInitiative::class, mappedBy="planningYear")
     */
    private $suitableInitiatives;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfQuarter;

    /**
     * @ORM\OneToMany(targetEntity=PlanAchievement::class, mappedBy="year")
     */
    private $planAchievements;

    /**
     * @ORM\OneToMany(targetEntity=QuarterAccomplishment::class, mappedBy="year")
     */
    private $quarterAccomplishments;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ethYear;

    public function __construct()
    {
        $this->planningPhases = new ArrayCollection();
      
        $this->suitableInitiatives = new ArrayCollection();
        $this->planAchievements = new ArrayCollection();
        $this->quarterAccomplishments = new ArrayCollection();
    }
    public function __toString()
    {
        
        return date_format($this->year,"Y");
        
        
    }
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getYear(): ?\DateTimeInterface
    {
        return $this->year;
    }

    public function setYear(\DateTimeInterface $year): self
    {
        $this->year = $year;

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
     * @return Collection|PlanningPhase[]
     */
    public function getPlanningPhases(): Collection
    {
        return $this->planningPhases;
    }

    public function addPlanningPhase(PlanningPhase $planningPhase): self
    {
        if (!$this->planningPhases->contains($planningPhase)) {
            $this->planningPhases[] = $planningPhase;
            $planningPhase->setPlanningYear($this);
        }

        return $this;
    }

    public function removePlanningPhase(PlanningPhase $planningPhase): self
    {
        if ($this->planningPhases->removeElement($planningPhase)) {
            // set the owning side to null (unless already changed)
            if ($planningPhase->getPlanningYear() === $this) {
                $planningPhase->setPlanningYear(null);
            }
        }

        return $this;
    }

    
  

    

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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
            $suitableInitiative->setPlanningYear($this);
        }

        return $this;
    }

    public function removeSuitableInitiative(SuitableInitiative $suitableInitiative): self
    {
        if ($this->suitableInitiatives->removeElement($suitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($suitableInitiative->getPlanningYear() === $this) {
                $suitableInitiative->setPlanningYear(null);
            }
        }

        return $this;
    }

    public function getNumberOfQuarter(): ?int
    {
        return $this->numberOfQuarter;
    }

    public function setNumberOfQuarter(?int $numberOfQuarter): self
    {
        $this->numberOfQuarter = $numberOfQuarter;

        return $this;
    }

    /**
     * @return Collection|PlanAchievement[]
     */
    public function getPlanAchievements(): Collection
    {
        return $this->planAchievements;
    }

    public function addPlanAchievement(PlanAchievement $planAchievement): self
    {
        if (!$this->planAchievements->contains($planAchievement)) {
            $this->planAchievements[] = $planAchievement;
            $planAchievement->setYear($this);
        }

        return $this;
    }

    public function removePlanAchievement(PlanAchievement $planAchievement): self
    {
        if ($this->planAchievements->removeElement($planAchievement)) {
            // set the owning side to null (unless already changed)
            if ($planAchievement->getYear() === $this) {
                $planAchievement->setYear(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|QuarterAccomplishment[]
     */
    public function getQuarterAccomplishments(): Collection
    {
        return $this->quarterAccomplishments;
    }

    public function addQuarterAccomplishment(QuarterAccomplishment $quarterAccomplishment): self
    {
        if (!$this->quarterAccomplishments->contains($quarterAccomplishment)) {
            $this->quarterAccomplishments[] = $quarterAccomplishment;
            $quarterAccomplishment->setYear($this);
        }

        return $this;
    }

    public function removeQuarterAccomplishment(QuarterAccomplishment $quarterAccomplishment): self
    {
        if ($this->quarterAccomplishments->removeElement($quarterAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($quarterAccomplishment->getYear() === $this) {
                $quarterAccomplishment->setYear(null);
            }
        }

        return $this;
    }

    public function getEthYear(): ?string
    {
        return $this->ethYear;
    }

    public function setEthYear(string $ethYear): self
    {
        $this->ethYear = $ethYear;

        return $this;
    }
}
