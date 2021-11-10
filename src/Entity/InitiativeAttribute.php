<?php

namespace App\Entity;

use App\Repository\InitiativeAttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InitiativeAttributeRepository::class)
 */
class InitiativeAttribute
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="initiativeAttributes")
     */
    private $createdBy;

    /**
     * @ORM\OneToMany(targetEntity=BehavioralPlanningAccomplishment::class, mappedBy="initiativeAttribute")
     */
    private $behavioralPlanningAccomplishments;

    /**
     * @ORM\ManyToMany(targetEntity=Initiative::class, mappedBy="socialAtrribute")
     */
    private $initiatives;

    /**
     * @ORM\OneToMany(targetEntity=PlanningAccomplishment::class, mappedBy="socialAttribute")
     */
    private $planningAccomplishments;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="social")
     */
    private $performerTasks;
    private $locale="en";

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $code;

    
      /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=OperationalPlanningAccomplishment::class, mappedBy="socialAttribute")
     */
    private $operationalPlanningAccomplishments;

    /**
     * @ORM\OneToMany(targetEntity=SocialAttributeAchievement::class, mappedBy="attribute")
     */
    private $socialAttributeAchievements;

    /**
     * @ORM\OneToMany(targetEntity=QuarterPlanAchievement::class, mappedBy="socialAttribute")
     */
    private $quarterPlanAchievements;

    /**
     * @ORM\OneToMany(targetEntity=InistuitionPlan::class, mappedBy="socialAttribute")
     */
    private $inistuitionPlans;

 
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
    public function __construct()
    {
        $this->behavioralPlanningAccomplishments = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
        $this->planningAccomplishments = new ArrayCollection();
        $this->performerTasks = new ArrayCollection();
        $this->operationalPlanningAccomplishments = new ArrayCollection();
        $this->socialAttributeAchievements = new ArrayCollection();
        $this->quarterPlanAchievements = new ArrayCollection();
        $this->inistuitionPlans = new ArrayCollection();
    }
    public function __call($method, $arguments)
    {
        return $this->proxyCurrentLocaleTranslation($method, $arguments);
    }
    public function getId(): ?int
    {
        return $this->id;
    }
   public function __toString()

    {
       
        return $this->getName();

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
     * @return Collection|BehavioralPlanningAccomplishment[]
     */
    public function getBehavioralPlanningAccomplishments(): Collection
    {
        return $this->behavioralPlanningAccomplishments;
    }

    public function addBehavioralPlanningAccomplishment(BehavioralPlanningAccomplishment $behavioralPlanningAccomplishment): self
    {
        if (!$this->behavioralPlanningAccomplishments->contains($behavioralPlanningAccomplishment)) {
            $this->behavioralPlanningAccomplishments[] = $behavioralPlanningAccomplishment;
            $behavioralPlanningAccomplishment->setInitiativeAttribute($this);
        }

        return $this;
    }

    public function removeBehavioralPlanningAccomplishment(BehavioralPlanningAccomplishment $behavioralPlanningAccomplishment): self
    {
        if ($this->behavioralPlanningAccomplishments->removeElement($behavioralPlanningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($behavioralPlanningAccomplishment->getInitiativeAttribute() === $this) {
                $behavioralPlanningAccomplishment->setInitiativeAttribute(null);
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
            $initiative->addSocialAtrribute($this);
        }

        return $this;
    }

    public function removeInitiative(Initiative $initiative): self
    {
        if ($this->initiatives->removeElement($initiative)) {
            $initiative->removeSocialAtrribute($this);
        }

        return $this;
    }

    /**
     * @return Collection|PlanningAccomplishment[]
     */
    public function getPlanningAccomplishments(): Collection
    {
        return $this->planningAccomplishments;
    }

    public function addPlanningAccomplishment(PlanningAccomplishment $planningAccomplishment): self
    {
        if (!$this->planningAccomplishments->contains($planningAccomplishment)) {
            $this->planningAccomplishments[] = $planningAccomplishment;
            $planningAccomplishment->setSocialAttribute($this);
        }

        return $this;
    }

    public function removePlanningAccomplishment(PlanningAccomplishment $planningAccomplishment): self
    {
        if ($this->planningAccomplishments->removeElement($planningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($planningAccomplishment->getSocialAttribute() === $this) {
                $planningAccomplishment->setSocialAttribute(null);
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
            $performerTask->setSocial($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getSocial() === $this) {
                $performerTask->setSocial(null);
            }
        }

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(?int $code): self
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return Collection|OperationalPlanningAccomplishment[]
     */
    public function getOperationalPlanningAccomplishments(): Collection
    {
        return $this->operationalPlanningAccomplishments;
    }

    public function addOperationalPlanningAccomplishment(OperationalPlanningAccomplishment $operationalPlanningAccomplishment): self
    {
        if (!$this->operationalPlanningAccomplishments->contains($operationalPlanningAccomplishment)) {
            $this->operationalPlanningAccomplishments[] = $operationalPlanningAccomplishment;
            $operationalPlanningAccomplishment->setSocialAttribute($this);
        }

        return $this;
    }

    public function removeOperationalPlanningAccomplishment(OperationalPlanningAccomplishment $operationalPlanningAccomplishment): self
    {
        if ($this->operationalPlanningAccomplishments->removeElement($operationalPlanningAccomplishment)) {
            // set the owning side to null (unless already changed)
            if ($operationalPlanningAccomplishment->getSocialAttribute() === $this) {
                $operationalPlanningAccomplishment->setSocialAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SocialAttributeAchievement[]
     */
    public function getSocialAttributeAchievements(): Collection
    {
        return $this->socialAttributeAchievements;
    }

    public function addSocialAttributeAchievement(SocialAttributeAchievement $socialAttributeAchievement): self
    {
        if (!$this->socialAttributeAchievements->contains($socialAttributeAchievement)) {
            $this->socialAttributeAchievements[] = $socialAttributeAchievement;
            $socialAttributeAchievement->setAttribute($this);
        }

        return $this;
    }

    public function removeSocialAttributeAchievement(SocialAttributeAchievement $socialAttributeAchievement): self
    {
        if ($this->socialAttributeAchievements->removeElement($socialAttributeAchievement)) {
            // set the owning side to null (unless already changed)
            if ($socialAttributeAchievement->getAttribute() === $this) {
                $socialAttributeAchievement->setAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|QuarterPlanAchievement[]
     */
    public function getQuarterPlanAchievements(): Collection
    {
        return $this->quarterPlanAchievements;
    }

    public function addQuarterPlanAchievement(QuarterPlanAchievement $quarterPlanAchievement): self
    {
        if (!$this->quarterPlanAchievements->contains($quarterPlanAchievement)) {
            $this->quarterPlanAchievements[] = $quarterPlanAchievement;
            $quarterPlanAchievement->setSocialAttribute($this);
        }

        return $this;
    }

    public function removeQuarterPlanAchievement(QuarterPlanAchievement $quarterPlanAchievement): self
    {
        if ($this->quarterPlanAchievements->removeElement($quarterPlanAchievement)) {
            // set the owning side to null (unless already changed)
            if ($quarterPlanAchievement->getSocialAttribute() === $this) {
                $quarterPlanAchievement->setSocialAttribute(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|InistuitionPlan[]
     */
    public function getInistuitionPlans(): Collection
    {
        return $this->inistuitionPlans;
    }

    public function addInistuitionPlan(InistuitionPlan $inistuitionPlan): self
    {
        if (!$this->inistuitionPlans->contains($inistuitionPlan)) {
            $this->inistuitionPlans[] = $inistuitionPlan;
            $inistuitionPlan->setSocialAttribute($this);
        }

        return $this;
    }

    public function removeInistuitionPlan(InistuitionPlan $inistuitionPlan): self
    {
        if ($this->inistuitionPlans->removeElement($inistuitionPlan)) {
            // set the owning side to null (unless already changed)
            if ($inistuitionPlan->getSocialAttribute() === $this) {
                $inistuitionPlan->setSocialAttribute(null);
            }
        }

        return $this;
    }
}
