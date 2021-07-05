<?php

namespace App\Entity;

use App\Repository\PerformerTaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PerformerTaskRepository::class)
 */
class PerformerTask
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
     * @ORM\Column(type="integer")
     */
    private $weight;

    

    /**
     * @ORM\OneToMany(targetEntity=TaskAssign::class, mappedBy="PerformerTask")
     */
    private $taskAssigns;

    
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="performerTasks")
     */
    private $createdBy;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="performerTasks")
     */
    private $quarter;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningAccomplishment::class, inversedBy="performerTasks")
     */
    private $PlanAcomplishment;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="performerTasks")
     */
    private $social;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="performerTaskDelegate")
     */
    private $deligateBy;

    /**
     * @ORM\ManyToOne(targetEntity=OperationalOffice::class, inversedBy="performerTasks")
     */
    private $operationalOffice;

    public function __toString()
    {
        return $this->getName();
    }
    

    public function __construct()
    {
        $this->taskAssigns = new ArrayCollection();
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

  

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

  
    /**
     * @return Collection|TaskAssign[]
     */
    public function getTaskAssigns(): Collection
    {
        return $this->taskAssigns;
    }

    public function addTaskAssign(TaskAssign $taskAssign): self
    {
        if (!$this->taskAssigns->contains($taskAssign)) {
            $this->taskAssigns[] = $taskAssign;
            $taskAssign->setPerformerTask($this);
        }

        return $this;
    }

    public function removeTaskAssign(TaskAssign $taskAssign): self
    {
        if ($this->taskAssigns->removeElement($taskAssign)) {
            // set the owning side to null (unless already changed)
            if ($taskAssign->getPerformerTask() === $this) {
                $taskAssign->setPerformerTask(null);
            }
        }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getPlanAcomplishment(): ?PlanningAccomplishment
    {
        return $this->PlanAcomplishment;
    }

    public function setPlanAcomplishment(?PlanningAccomplishment $PlanAcomplishment): self
    {
        $this->PlanAcomplishment = $PlanAcomplishment;

        return $this;
    }

    public function getSocial(): ?InitiativeAttribute
    {
        return $this->social;
    }

    public function setSocial(?InitiativeAttribute $social): self
    {
        $this->social = $social;

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

    public function getDeligateBy(): ?User
    {
        return $this->deligateBy;
    }

    public function setDeligateBy(?User $deligateBy): self
    {
        $this->deligateBy = $deligateBy;

        return $this;
    }

    public function getOperationalOffice(): ?OperationalOffice
    {
        return $this->operationalOffice;
    }

    public function setOperationalOffice(?OperationalOffice $operationalOffice): self
    {
        $this->operationalOffice = $operationalOffice;

        return $this;
    }

   

   
}
