<?php

namespace App\Entity;

use App\Repository\InitiativeAttributeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

/**
 * @ORM\Entity(repositoryClass=InitiativeAttributeRepository::class)
 */
class InitiativeAttribute implements TranslatableInterface
{
    use TranslatableTrait;
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

    
    
    public function __construct()
    {
        $this->behavioralPlanningAccomplishments = new ArrayCollection();
        $this->initiatives = new ArrayCollection();
        $this->planningAccomplishments = new ArrayCollection();
        $this->performerTasks = new ArrayCollection();
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
}
