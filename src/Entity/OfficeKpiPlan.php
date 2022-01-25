<?php

namespace App\Entity;

use App\Repository\OfficeKpiPlanRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OfficeKpiPlanRepository::class)
 */
class OfficeKpiPlan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=KeyPerformanceIndicator::class, inversedBy="officeKpiPlans")
     */
    private $kpi;

    /**
     * @ORM\ManyToOne(targetEntity=PrincipalOffice::class, inversedBy="officeKpiPlans")
     */
    private $office;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningYear::class, inversedBy="officeKpiPlans")
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity=KpiQuarterPlan::class, mappedBy="officeKpi")
     */
    private $kpiQuarterPlans;

    public function __construct()
    {
        $this->kpiQuarterPlans = new ArrayCollection();
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

    public function getOffice(): ?PrincipalOffice
    {
        return $this->office;
    }

    public function setOffice(?PrincipalOffice $office): self
    {
        $this->office = $office;

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

    /**
     * @return Collection|KpiQuarterPlan[]
     */
    public function getKpiQuarterPlans(): Collection
    {
        return $this->kpiQuarterPlans;
    }

    public function addKpiQuarterPlan(KpiQuarterPlan $kpiQuarterPlan): self
    {
        if (!$this->kpiQuarterPlans->contains($kpiQuarterPlan)) {
            $this->kpiQuarterPlans[] = $kpiQuarterPlan;
            $kpiQuarterPlan->setOfficeKpi($this);
        }

        return $this;
    }

    public function removeKpiQuarterPlan(KpiQuarterPlan $kpiQuarterPlan): self
    {
        if ($this->kpiQuarterPlans->removeElement($kpiQuarterPlan)) {
            // set the owning side to null (unless already changed)
            if ($kpiQuarterPlan->getOfficeKpi() === $this) {
                $kpiQuarterPlan->setOfficeKpi(null);
            }
        }

        return $this;
    }
}
