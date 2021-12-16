<?php

namespace App\Entity;

use App\Repository\GoalAchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoalAchievementRepository::class)
 */
class GoalAchievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Goal::class, inversedBy="goalAchievements")
     */
    private $goal;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="goalAchievements")
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
     * @ORM\OneToMany(targetEntity=QuarterPlanAchievement::class, mappedBy="goalAchievement")
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

    public function getGoal(): ?Goal
    {
        return $this->goal;
    }

    public function setGoal(?Goal $goal): self
    {
        $this->goal = $goal;

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
            $quarterAchievement->setGoalAchievement($this);
        }

        return $this;
    }

    public function removeQuarterAchievement(QuarterPlanAchievement $quarterAchievement): self
    {
        if ($this->quarterAchievement->removeElement($quarterAchievement)) {
            // set the owning side to null (unless already changed)
            if ($quarterAchievement->getGoalAchievement() === $this) {
                $quarterAchievement->setGoalAchievement(null);
            }
        }

        return $this;
    }
}
