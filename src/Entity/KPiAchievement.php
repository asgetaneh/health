<?php

namespace App\Entity;

use App\Repository\KPiAchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KPiAchievementRepository::class)
 */
class KPiAchievement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=KeyPerformanceIndicator::class, inversedBy="kPiAchievements")
     */
    private $kpi;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="kPiAchievements")
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
     * @ORM\OneToMany(targetEntity=QuarterPlanAchievement::class, mappedBy="kPiAchievement")
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

    public function getKpi(): ?KeyPerformanceIndicator
    {
        return $this->kpi;
    }

    public function setKpi(?KeyPerformanceIndicator $kpi): self
    {
        $this->kpi = $kpi;

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
            $quarterAchievement->setKPiAchievement($this);
        }

        return $this;
    }

    public function removeQuarterAchievement(QuarterPlanAchievement $quarterAchievement): self
    {
        if ($this->quarterAchievement->removeElement($quarterAchievement)) {
            // set the owning side to null (unless already changed)
            if ($quarterAchievement->getKPiAchievement() === $this) {
                $quarterAchievement->setKPiAchievement(null);
            }
        }

        return $this;
    }
}
