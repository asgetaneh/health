<?php

namespace App\Entity;

use App\Repository\ObjectiveRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity(repositoryClass=ObjectiveRepository::class)
 */
class Objective implements TranslatableInterface
{
    use TranslatableTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive = 0;

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

    private $locales = "en";

    /**
     * @ORM\OneToMany(targetEntity=PlanAchievement::class, mappedBy="Objective")
     */
    private $planAchievements;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $objectiveNumber;

    /**
     * @ORM\OneToMany(targetEntity=ObjectiveAchievement::class, mappedBy="objective")
     */
    private $objectiveAchievements;

    /**
     * @ORM\OneToMany(targetEntity=KeyPerformanceIndicator::class, mappedBy="objective")
     */
    private $keyPerformanceIndicators;

   

    public function __construct()
    {
        $this->strategies = new ArrayCollection();
        $this->planAchievements = new ArrayCollection();
        $this->objectiveAchievements = new ArrayCollection();
        $this->keyPerformanceIndicators = new ArrayCollection();
      
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
    public function __toString()
    {
        return $this->getName();
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
            $planAchievement->setObjective($this);
        }

        return $this;
    }

    public function removePlanAchievement(PlanAchievement $planAchievement): self
    {
        if ($this->planAchievements->removeElement($planAchievement)) {
            // set the owning side to null (unless already changed)
            if ($planAchievement->getObjective() === $this) {
                $planAchievement->setObjective(null);
            }
        }

        return $this;
    }

    public function getObjectiveNumber(): ?int
    {
        return $this->objectiveNumber;
    }

    public function setObjectiveNumber(?int $objectiveNumber): self
    {
        $this->objectiveNumber = $objectiveNumber;

        return $this;
    }

    /**
     * @return Collection|ObjectiveAchievement[]
     */
    public function getObjectiveAchievements(): Collection
    {
        return $this->objectiveAchievements;
    }

    public function addObjectiveAchievement(ObjectiveAchievement $objectiveAchievement): self
    {
        if (!$this->objectiveAchievements->contains($objectiveAchievement)) {
            $this->objectiveAchievements[] = $objectiveAchievement;
            $objectiveAchievement->setObjective($this);
        }

        return $this;
    }

    public function removeObjectiveAchievement(ObjectiveAchievement $objectiveAchievement): self
    {
        if ($this->objectiveAchievements->removeElement($objectiveAchievement)) {
            // set the owning side to null (unless already changed)
            if ($objectiveAchievement->getObjective() === $this) {
                $objectiveAchievement->setObjective(null);
            }
        }

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
            $keyPerformanceIndicator->setObjective($this);
        }

        return $this;
    }

    public function removeKeyPerformanceIndicator(KeyPerformanceIndicator $keyPerformanceIndicator): self
    {
        if ($this->keyPerformanceIndicators->removeElement($keyPerformanceIndicator)) {
            // set the owning side to null (unless already changed)
            if ($keyPerformanceIndicator->getObjective() === $this) {
                $keyPerformanceIndicator->setObjective(null);
            }
        }

        return $this;
    }

    
}
