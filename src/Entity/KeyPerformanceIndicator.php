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
    * @ORM\Column(type="integer", nullable=true,unique=true)
    */
   private $kpiNumber;
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
}
