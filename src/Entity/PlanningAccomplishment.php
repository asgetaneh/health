<?php

namespace App\Entity;

use App\Repository\PlanningAccomplishmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PlanningAccomplishmentRepository::class)
 */
class PlanningAccomplishment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $accompValue;

   

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $accomplishNote;

    /**
     * @ORM\Column(type="integer")
     */
    private $planValue;

    /**
     * @ORM\ManyToOne(targetEntity=SuitableInitiative::class, inversedBy="planningAccomplishments")
     */
    private $suitableInitiative;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="planningAccomplishments")
     */
    private $quarter;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="planningAccomplishments")
     */
    private $socialAttribute;

    /**
     * @ORM\OneToMany(targetEntity=PerformerTask::class, mappedBy="PlanAcomplishment")
     */
    private $performerTasks;

    public function __construct()
    {
        $this->performerTasks = new ArrayCollection();
    }

   

    public function getId(): ?int
    {
        return $this->id;
    }

   

    public function getAccompValue(): ?int
    {
        return $this->accompValue;
    }

    public function setAccompValue(int $accompValue): self
    {
        $this->accompValue = $accompValue;

        return $this;
    }

   

    public function getAccomplishNote(): ?string
    {
        return $this->accomplishNote;
    }

    public function setAccomplishNote(?string $accomplishNote): self
    {
        $this->accomplishNote = $accomplishNote;

        return $this;
    }

    public function getPlanValue(): ?int
    {
        return $this->planValue;
    }

    public function setPlanValue(int $planValue): self
    {
        $this->planValue = $planValue;

        return $this;
    }

    public function getSuitableInitiative(): ?SuitableInitiative
    {
        return $this->suitableInitiative;
    }

    public function setSuitableInitiative(?SuitableInitiative $suitableInitiative): self
    {
        $this->suitableInitiative = $suitableInitiative;

        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getQuarter(): ?PlanningQuarter
    {
        return $this->quarter;
    }

    public function setQuarter(?PlanningQuarter $quarter): self
    {
        $this->quarter = $quarter;

        return $this;
    }

    public function getSocialAttribute(): ?InitiativeAttribute
    {
        return $this->socialAttribute;
    }

    public function setSocialAttribute(?InitiativeAttribute $socialAttribute): self
    {
        $this->socialAttribute = $socialAttribute;

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
            $performerTask->setPlanAcomplishment($this);
        }

        return $this;
    }

    public function removePerformerTask(PerformerTask $performerTask): self
    {
        if ($this->performerTasks->removeElement($performerTask)) {
            // set the owning side to null (unless already changed)
            if ($performerTask->getPlanAcomplishment() === $this) {
                $performerTask->setPlanAcomplishment(null);
            }
        }

        return $this;
    }

   
}
