<?php

namespace App\Entity;

use App\Repository\ObjectiveAchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ObjectiveAchievementRepository::class)
 */
class ObjectiveAchievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Objective::class, inversedBy="objectiveAchievements")
     */
    private $objective;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="objectiveAchievements")
     */
    private $year;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $plan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accomp;

    /**
     * @ORM\OneToMany(targetEntity=QuarterPlanAchievement::class, mappedBy="objectiveAchievement")
     */
    private $quarterAchievement;

    public function __construct()
    {
        $this->quarterAchievement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getYear(): ?PlanningYear
    {
        return $this->year;
    }

    public function setYear(?PlanningYear $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPlan(): ?float
    {
        return $this->plan;
    }

    public function setPlan(?float $plan): self
    {
        $this->plan = $plan;

        return $this;
    }

    public function getAccomp(): ?float
    {
        return $this->accomp;
    }

    public function setAccomp(?float $accomp): self
    {
        $this->accomp = $accomp;

        return $this;
    }

    /**
     * @return Collection|QuarterPlanAchievement[]
     */
    public function getQuarterAchievement(): Collection
    {
        return $this->quarterAchievement;
    }

    public function addQuarterAchievement(QuarterPlanAchievement $quarterAchievement): self
    {
        if (!$this->quarterAchievement->contains($quarterAchievement)) {
            $this->quarterAchievement[] = $quarterAchievement;
            $quarterAchievement->setObjectiveAchievement($this);
        }

        return $this;
    }

    public function removeQuarterAchievement(QuarterPlanAchievement $quarterAchievement): self
    {
        if ($this->quarterAchievement->removeElement($quarterAchievement)) {
            // set the owning side to null (unless already changed)
            if ($quarterAchievement->getObjectiveAchievement() === $this) {
                $quarterAchievement->setObjectiveAchievement(null);
            }
        }

        return $this;
    }
}
