<?php

namespace App\Entity;

use App\Repository\KeyPerformanceIndicatorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=KeyPerformanceIndicatorRepository::class)
 */
class KeyPerformanceIndicator implements TranslatableInterface
{
    use TranslatableTrait;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    
    /**
     * @ORM\Column(type="boolean")
     */
    private $isActive=0;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity=Strategy::class, inversedBy="keyPerformanceIndicators")
     */
    private $strategy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="keyPerformanceIndicators")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=Initiative::class, mappedBy="keyPerformanceIndicator")
     */
    private $initiatives;
   private  $locale="en";

   /**
    * @ORM\OneToMany(targetEntity=PlanAchievement::class, mappedBy="kpi")
    */
   private $planAchievements;

   /**
    * @Assert\Unique
    * @Assert\Positive
    * @ORM\Column(type="integer", nullable=true)
    *
    */
   private $kpiNumber;

   /**
    * @ORM\OneToMany(targetEntity=KPiAchievement::class, mappedBy="kpi")
    */
   private $kPiAchievements;

   /**
    * @ORM\ManyToOne(targetEntity=Objective::class, inversedBy="keyPerformanceIndicators")
    */
   private $objective;

   /**
    * @ORM\OneToMany(targetEntity=OfficeKpiPlan::class, mappedBy="kpi")
    */
   private $officeKpiPlans;

   /**
    * @ORM\OneToMany(targetEntity=KeyPerformanceIndicatorBudget::class, mappedBy="key_performance_indicator", orphanRemoval=true)
    */
   private $keyPerformanceIndicatorBudgets;

   
    public function __toString()
    {
        return $this->getName();
    }
     public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }


    public function __construct()
    {
        $this->initiatives = new ArrayCollection();
        $this->planAchievements = new ArrayCollection();
        $this->kPiAchievements = new ArrayCollection();
        $this->officeKpiPlans = new ArrayCollection();
        $this->keyPerformanceIndicatorBudgets = new ArrayCollection();
       
    }

    
    public function getId(): ?int
    {
        return $this->id;
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

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getStrategy(): ?Strategy
    {
        return $this->strategy;
    }

    public function setStrategy(?Strategy $strategy): self
    {
        $this->strategy = $strategy;

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
            $initiative->setKeyPerformanceIndicator($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->removeElement($initiative)) {
            // set the owning side to null (unless already changed)
            if ($initiative->getKeyPerformanceIndicator() === $this) {
                $initiative->setKeyPerformanceIndicator(null);
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
            $planAchievement->setKpi($this);
        }

        return $this;
    }

    public function removePlanAchievement(PlanAchievement $planAchievement): self
    {
        if ($this->planAchievements->removeElement($planAchievement)) {
            // set the owning side to null (unless already changed)
            if ($planAchievement->getKpi() === $this) {
                $planAchievement->setKpi(null);
            }
        }

        return $this;
    }

    public function getKpiNumber(): ?int
    {
        return $this->kpiNumber;
    }

    public function setKpiNumber(?int $kpiNumber): self
    {
        $this->kpiNumber = $kpiNumber;

        return $this;
    }

    /**
     * @return Collection|KPiAchievement[]
     */
    public function getKPiAchievements(): Collection
    {
        return $this->kPiAchievements;
    }

    public function addKPiAchievement(KPiAchievement $kPiAchievement): self
    {
        if (!$this->kPiAchievements->contains($kPiAchievement)) {
            $this->kPiAchievements[] = $kPiAchievement;
            $kPiAchievement->setKpi($this);
        }

        return $this;
    }

    public function removeKPiAchievement(KPiAchievement $kPiAchievement): self
    {
        if ($this->kPiAchievements->removeElement($kPiAchievement)) {
            // set the owning side to null (unless already changed)
            if ($kPiAchievement->getKpi() === $this) {
                $kPiAchievement->setKpi(null);
            }
        }

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

    /**
     * @return Collection|OfficeKpiPlan[]
     */
    public function getOfficeKpiPlans(): Collection
    {
        return $this->officeKpiPlans;
    }

    public function addOfficeKpiPlan(OfficeKpiPlan $officeKpiPlan): self
    {
        if (!$this->officeKpiPlans->contains($officeKpiPlan)) {
            $this->officeKpiPlans[] = $officeKpiPlan;
            $officeKpiPlan->setKpi($this);
        }

        return $this;
    }

    public function removeOfficeKpiPlan(OfficeKpiPlan $officeKpiPlan): self
    {
        if ($this->officeKpiPlans->removeElement($officeKpiPlan)) {
            // set the owning side to null (unless already changed)
            if ($officeKpiPlan->getKpi() === $this) {
                $officeKpiPlan->setKpi(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, KeyPerformanceIndicatorBudget>
     */
    public function getKeyPerformanceIndicatorBudgets(): Collection
    {
        return $this->keyPerformanceIndicatorBudgets;
    }

    public function addKeyPerformanceIndicatorBudget(KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget): self
    {
        if (!$this->keyPerformanceIndicatorBudgets->contains($keyPerformanceIndicatorBudget)) {
            $this->keyPerformanceIndicatorBudgets[] = $keyPerformanceIndicatorBudget;
            $keyPerformanceIndicatorBudget->setKeyPerformanceIndicator($this);
        }

        return $this;
    }

    public function removeKeyPerformanceIndicatorBudget(KeyPerformanceIndicatorBudget $keyPerformanceIndicatorBudget): self
    {
        if ($this->keyPerformanceIndicatorBudgets->removeElement($keyPerformanceIndicatorBudget)) {
            // set the owning side to null (unless already changed)
            if ($keyPerformanceIndicatorBudget->getKeyPerformanceIndicator() === $this) {
                $keyPerformanceIndicatorBudget->setKeyPerformanceIndicator(null);
            }
        }

        return $this;
    }


   
}
