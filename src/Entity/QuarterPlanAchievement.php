<?php

namespace App\Entity;

use App\Repository\QuarterPlanAchievementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuarterPlanAchievementRepository::class)
 */
class QuarterPlanAchievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="quarterPlanAchievements")
     */
    private $quarter;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAttribute::class, inversedBy="quarterPlanAchievements")
     */
    private $socialAttribute;

    /**
     * @ORM\Column(type="float")
     */
    private $plan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accomp;

    /**
     * @ORM\ManyToOne(targetEntity=InitiativeAchievement::class, inversedBy="quarterAchievement")
     */
    private $initiativeAchievement;

    /**
     * @ORM\ManyToOne(targetEntity=KPiAchievement::class, inversedBy="quarterAchievement")
     */
    private $kPiAchievement;

    /**
     * @ORM\ManyToOne(targetEntity=ObjectiveAchievement::class, inversedBy="quarterAchievement")
     */
    private $objectiveAchievement;

    /**
     * @ORM\ManyToOne(targetEntity=GoalAchievement::class, inversedBy="quarterAchievement")
     */
    private $goalAchievement;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPlan(): ?float
    {
        return $this->plan;
    }

    public function setPlan(float $plan): self
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

    public function getInitiativeAchievement(): ?InitiativeAchievement
    {
        return $this->initiativeAchievement;
    }

    public function setInitiativeAchievement(?InitiativeAchievement $initiativeAchievement): self
    {
        $this->initiativeAchievement = $initiativeAchievement;

        return $this;
    }

    public function getKPiAchievement(): ?KPiAchievement
    {
        return $this->kPiAchievement;
    }

    public function setKPiAchievement(?KPiAchievement $kPiAchievement): self
    {
        $this->kPiAchievement = $kPiAchievement;

        return $this;
    }

    public function getObjectiveAchievement(): ?ObjectiveAchievement
    {
        return $this->objectiveAchievement;
    }

    public function setObjectiveAchievement(?ObjectiveAchievement $objectiveAchievement): self
    {
        $this->objectiveAchievement = $objectiveAchievement;

        return $this;
    }

    public function getGoalAchievement(): ?GoalAchievement
    {
        return $this->goalAchievement;
    }

    public function setGoalAchievement(?GoalAchievement $goalAchievement): self
    {
        $this->goalAchievement = $goalAchievement;

        return $this;
    }
}
