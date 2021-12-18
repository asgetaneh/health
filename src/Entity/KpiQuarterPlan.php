<?php

namespace App\Entity;

use App\Repository\KpiQuarterPlanRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=KpiQuarterPlanRepository::class)
 */
class KpiQuarterPlan
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $plan;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $accomp;

    /**
     * @ORM\ManyToOne(targetEntity=OfficeKpiPlan::class, inversedBy="kpiQuarterPlans")
     */
    private $officeKpi;

    /**
     * @ORM\ManyToOne(targetEntity=PlanningQuarter::class, inversedBy="kpiQuarterPlans")
     */
    private $quarter;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getOfficeKpi(): ?OfficeKpiPlan
    {
        return $this->officeKpi;
    }

    public function setOfficeKpi(?OfficeKpiPlan $officeKpi): self
    {
        $this->officeKpi = $officeKpi;

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
}
