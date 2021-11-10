<?php

namespace App\Entity;

use App\Repository\InitiativeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=InitiativeRepository::class)
 * @UniqueEntity(fields = {"initiativeNumber"},message ="This initiative Number is already in use on that initiatives"),
 * 
 */
class Initiative implements TranslatableInterface
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
    private $maximumValue = 1000000;

    /**
     * @ORM\Column(type="float")
     */
    private $minimumValue = 0;

    

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
    private $isActive=1;

    /**
     * @ORM\OneToMany(targetEntity=SuitableInitiative::class, mappedBy="initiative")
     */
    private $suitableInitiatives;

    /**
     * @ORM\ManyToMany(targetEntity=InitiativeAttribute::class, inversedBy="initiatives")
     */
    private $socialAtrribute;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeBehaviour::class, inversedBy="initiatives")
     */
    private $initiativeBehaviour;
    private $locale="en";

    /**
     * @ORM\OneToMany(targetEntity=PlanAchievement::class, mappedBy="initiative")
     */
    private $planAchievements;



    /**
     * 
     * 
     * @ORM\Column(type="integer", nullable=true,unique=false)
     */
    private $initiativeNumber;


    
     /** 
     * @ORM\Column(type="float", nullable=true)
     */
    private $weight;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $measurement;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeCategory::class, inversedBy="initiatives")
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity=InitiativeAchievement::class, mappedBy="initiative")
     */
    private $initiativeAchievements;

    /**
     * @ORM\OneToMany(targetEntity=InistuitionSuitableInitiative::class, mappedBy="initiative")
     */
    private $inistuitionSuitableInitiatives;

   
     
     const NUMERICAL=0;
     const RATIO=1;
     const PERCENT=2;
     

   


    public function __construct()
    {
        $this->plans = new ArrayCollection();
        $this->principalOffice = new ArrayCollection();
        $this->suitableInitiatives = new ArrayCollection();
        $this->socialAtrribute = new ArrayCollection();
        // $this->initiativeBehaviour = new ArrayCollection();
        $this->planAchievements = new ArrayCollection();
        $this->initiativeAchievements = new ArrayCollection();
        $this->inistuitionSuitableInitiatives = new ArrayCollection();
       
    }
    public function __toString()
    {
        return $this->getName();
    }
     public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }


    public function getId(): ?int
    {
        return $this->id;
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
            $suitableInitiative->setInitiative($this);
        }

        return $this;
    }

    public function removeSuitableInitiative(SuitableInitiative $suitableInitiative): self
    {
        if ($this->suitableInitiatives->removeElement($suitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($suitableInitiative->getInitiative() === $this) {
                $suitableInitiative->setInitiative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InitiativeAttribute[]
     */
    public function getSocialAtrribute(): Collection
    {
        return $this->socialAtrribute;
    }

    public function addSocialAtrribute(InitiativeAttribute $socialAtrribute): self
    {
        if (!$this->socialAtrribute->contains($socialAtrribute)) {
            $this->socialAtrribute[] = $socialAtrribute;
        }

        return $this;
    }

    public function removeSocialAtrribute(InitiativeAttribute $socialAtrribute): self
    {
        $this->socialAtrribute->removeElement($socialAtrribute);

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
            $planAchievement->setInitiative($this);
        }

        return $this;
    }

    public function removePlanAchievement(PlanAchievement $planAchievement): self
    {
        if ($this->planAchievements->removeElement($planAchievement)) {
            // set the owning side to null (unless already changed)
            if ($planAchievement->getInitiative() === $this) {
                $planAchievement->setInitiative(null);
            }
        }

        return $this;
    }


    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): self
    {
        $this->weight = $weight;

        return $this;
    }



    public function getInitiativeNumber(): ?int
    {
        return $this->initiativeNumber;
    }

    public function setInitiativeNumber(?int $initiativeNumber): self
    {
        $this->initiativeNumber = $initiativeNumber;

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

    public function getMeasurement(): ?int
    {
        return $this->measurement;
    }

    public function setMeasurement(?int $measurement): self
    {
        $this->measurement = $measurement;

        return $this;
    }

    public function getCategory(): ?InitiativeCategory
    {
        return $this->category;
    }

    public function setCategory(?InitiativeCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|InitiativeAchievement[]
     */
    public function getInitiativeAchievements(): Collection
    {
        return $this->initiativeAchievements;
    }

    public function addInitiativeAchievement(InitiativeAchievement $initiativeAchievement): self
    {
        if (!$this->initiativeAchievements->contains($initiativeAchievement)) {
            $this->initiativeAchievements[] = $initiativeAchievement;
            $initiativeAchievement->setInitiative($this);
        }

        return $this;
    }

    public function removeInitiativeAchievement(InitiativeAchievement $initiativeAchievement): self
    {
        if ($this->initiativeAchievements->removeElement($initiativeAchievement)) {
            // set the owning side to null (unless already changed)
            if ($initiativeAchievement->getInitiative() === $this) {
                $initiativeAchievement->setInitiative(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InistuitionSuitableInitiative[]
     */
    public function getInistuitionSuitableInitiatives(): Collection
    {
        return $this->inistuitionSuitableInitiatives;
    }

    public function addInistuitionSuitableInitiative(InistuitionSuitableInitiative $inistuitionSuitableInitiative): self
    {
        if (!$this->inistuitionSuitableInitiatives->contains($inistuitionSuitableInitiative)) {
            $this->inistuitionSuitableInitiatives[] = $inistuitionSuitableInitiative;
            $inistuitionSuitableInitiative->setInitiative($this);
        }

        return $this;
    }

    public function removeInistuitionSuitableInitiative(InistuitionSuitableInitiative $inistuitionSuitableInitiative): self
    {
        if ($this->inistuitionSuitableInitiatives->removeElement($inistuitionSuitableInitiative)) {
            // set the owning side to null (unless already changed)
            if ($inistuitionSuitableInitiative->getInitiative() === $this) {
                $inistuitionSuitableInitiative->setInitiative(null);
            }
        }

        return $this;
    }


   
    

    
}
